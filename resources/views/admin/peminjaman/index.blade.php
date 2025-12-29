@extends('admin.layout')

@section('title', 'Manajemen Peminjaman')
@section('page-title', 'Manajemen Peminjaman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Daftar Peminjaman</h2>
            <p class="mt-1 text-xs text-slate-500">Kelola semua peminjaman buku perpustakaan</p>
        </div>
        <a href="{{ route('admin.peminjaman.export-pdf') }}" class="inline-flex items-center gap-2 rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                <path d="M7 5C7 4.44772 7.44772 4 8 4H16L19 7V19C19 19.5523 18.5523 20 18 20H8C7.44772 20 7 19.5523 7 19V5Z" stroke="currentColor" stroke-width="1.5"/>
                <path d="M14 4V8H18" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M9 12H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M9 15H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            Export PDF
        </a>
    </div>

    <!-- Filters -->
    <div class="rounded-xl border border-slate-200 bg-white p-4">
        <form method="GET" action="{{ route('admin.peminjaman.index') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1.5">Status</label>
                <select name="status" class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs text-slate-900 shadow-sm outline-none focus:border-emerald-500 focus:ring-2">
                    <option value="">Semua Status</option>
                    <option value="dibooking" {{ request('status') == 'dibooking' ? 'selected' : '' }}>Dibooking</option>
                    <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1.5">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs text-slate-900 shadow-sm outline-none focus:border-emerald-500 focus:ring-2">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1.5">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs text-slate-900 shadow-sm outline-none focus:border-emerald-500 focus:ring-2">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="rounded-xl border border-slate-200 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Pengguna</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Buku</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Tanggal Pinjam</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Batas Kembali</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($peminjamans as $peminjaman)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3">
                                <p class="text-xs font-semibold text-slate-900">{{ $peminjaman->user->name }}</p>
                                <p class="text-[11px] text-slate-500">{{ $peminjaman->user->email }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-xs font-semibold text-slate-900">{{ $peminjaman->koleksi->judul }}</p>
                                <p class="text-[11px] text-slate-500">{{ $peminjaman->koleksi->penulis }}</p>
                            </td>
                            <td class="px-4 py-3 text-xs text-slate-700">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-xs text-slate-700">{{ $peminjaman->batas_kembali->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'dibooking' => 'bg-blue-50 text-blue-700',
                                        'dipinjam' => 'bg-amber-50 text-amber-700',
                                        'dikembalikan' => 'bg-emerald-50 text-emerald-700',
                                        'terlambat' => 'bg-red-50 text-red-700',
                                    ];
                                @endphp
                                <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-medium {{ $statusColors[$peminjaman->status] ?? 'bg-slate-50 text-slate-700' }}">
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($peminjaman->status === 'dibooking')
                                    <form action="{{ route('admin.peminjaman.update', $peminjaman) }}" method="POST" class="inline mr-2" onsubmit="return confirm('Konfirmasi peminjaman buku ini?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="dipinjam">
                                        <button type="submit" class="rounded-full bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">
                                            Konfirmasi
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.peminjaman.destroy', $peminjaman) }}" method="POST" class="inline" onsubmit="return confirm('Batalkan booking ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full bg-red-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
                                            Batal
                                        </button>
                                    </form>
                                @elseif($peminjaman->status === 'dipinjam')
                                    <form action="{{ route('admin.peminjaman.update', $peminjaman) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="dikembalikan">
                                        <button type="submit" class="rounded-full bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                                            Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-slate-500">
                                        {{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d M Y') : '-' }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-xs text-slate-500">
                                Belum ada peminjaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($peminjamans->hasPages())
            <div class="border-t border-slate-200 px-4 py-3">
                {{ $peminjamans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

