<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the user's peminjaman.
     */
    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', Auth::id())
            ->with('koleksi.category')
            ->latest('tanggal_pinjam')
            ->paginate(15);

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Export peminjaman to PDF.
     */
    public function exportPdf(Request $request)
    {
        $query = Peminjaman::where('user_id', Auth::id())
            ->with('koleksi.category');

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('tanggal_pinjam', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('tanggal_pinjam', '<=', $request->end_date);
        }

        $peminjamans = $query->latest('tanggal_pinjam')->get();

        $pdf = Pdf::loadView('peminjaman.pdf', [
            'peminjamans' => $peminjamans,
            'user' => Auth::user(),
            'filters' => $request->only(['status', 'start_date', 'end_date']),
        ]);

        return $pdf->download('laporan-peminjaman-' . date('Y-m-d') . '.pdf');
    }
}
