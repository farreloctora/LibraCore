<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KoleksiController extends Controller
{
    /**
     * Display the specified koleksi.
     */
    public function show(Koleksi $koleksi)
    {
        $koleksi->load('category');
        
        // Check if user has active loan for this book
        $activeLoan = null;
        if (Auth::check()) {
            $activeLoan = Peminjaman::where('user_id', Auth::id())
                ->where('koleksi_id', $koleksi->id)
                ->whereIn('status', ['dipinjam', 'dibooking'])
                ->first();
        }

        return view('koleksi.show', compact('koleksi', 'activeLoan'));
    }

    /**
     * Store a new peminjaman.
     */
    public function pinjam(Request $request, Koleksi $koleksi)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu untuk meminjam buku.');
        }

        // Check if book is available
        if (!$koleksi->isAvailable()) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Check if user already has an active loan for this book
        $existingLoan = Peminjaman::where('user_id', Auth::id())
            ->where('koleksi_id', $koleksi->id)
            ->whereIn('status', ['dipinjam', 'dibooking'])
            ->first();

        if ($existingLoan) {
            $message = $existingLoan->status === 'dibooking' ? 'Buku telah anda booking.' : 'Anda sudah meminjam buku ini.';
            return back()->with('error', $message);
        }

        // Create peminjaman
        $batasKembali = now()->addDays(7); // 7 hari dari sekarang

        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'koleksi_id' => $koleksi->id,
            'tanggal_pinjam' => now(),
            'batas_kembali' => $batasKembali,
            'status' => 'dibooking',
        ]);

        // Update koleksi status to dibooking
        $koleksi->update(['status' => 'dibooking']);

        return back()->with('success', 'Booking buku berhasil! Tunggu konfirmasi dari admin. Batas pengembalian: ' . $batasKembali->format('d M Y'));
    }
}
