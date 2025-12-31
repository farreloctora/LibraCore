<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of all peminjaman.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'koleksi.category']);

        // Filter by status
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        // Filter by user
        $query->when($request->filled('user_id'), function ($q) use ($request) {
            $q->where('user_id', $request->user_id);
        });

        // Filter by date range
        $query->when($request->filled('start_date'), function ($q) use ($request) {
            $q->whereDate('tanggal_pinjam', '>=', $request->start_date);
        });

        $query->when($request->filled('end_date'), function ($q) use ($request) {
            $q->whereDate('tanggal_pinjam', '<=', $request->end_date);
        });

        $peminjamans = $query->latest('tanggal_pinjam')->paginate(15);

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Update peminjaman status (kembalikan buku or konfirmasi booking).
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
            'keterangan' => 'nullable|string',
        ]);

        $updateData = [
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ];

        if ($request->status === 'dikembalikan') {
            $updateData['tanggal_kembali'] = now();
            // Update koleksi status to tersedia
            $peminjaman->koleksi->update(['status' => 'tersedia']);
        } elseif ($request->status === 'dipinjam') {
            // Update koleksi status to dipinjam
            $peminjaman->koleksi->update(['status' => 'dipinjam']);
        }

        $peminjaman->update($updateData);

        $message = $request->status === 'dipinjam' ? 'Booking berhasil dikonfirmasi.' : 'Buku berhasil dikembalikan.';

        return back()->with('success', $message);
    }

    /**
     * Cancel booking (delete peminjaman with dibooking status).
     */
    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'dibooking') {
            return back()->with('error', 'Hanya booking yang bisa dibatalkan.');
        }

        // Update koleksi status back to tersedia
        $peminjaman->koleksi->update(['status' => 'tersedia']);

        $peminjaman->delete();

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
    public function exportPdf(Request $request)
    {
        $query = Peminjaman::with(['user', 'koleksi.category']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by user
        if ($request->has('user_id') && $request->user_id !== '') {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('tanggal_pinjam', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('tanggal_pinjam', '<=', $request->end_date);
        }

        $peminjamans = $query->latest('tanggal_pinjam')->get();

        $pdf = Pdf::loadView('admin.peminjaman.pdf', [
            'peminjamans' => $peminjamans,
            'filters' => $request->only(['status', 'user_id', 'start_date', 'end_date']),
        ]);

        return $pdf->download('laporan-peminjaman-admin-' . date('Y-m-d') . '.pdf');
    }
}
