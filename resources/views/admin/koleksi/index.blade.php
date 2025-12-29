@extends('admin.layout')

@section('title', 'Manajemen Buku')
@section('page-title', 'Manajemen Buku')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Daftar Buku</h2>
            <p class="mt-1 text-xs text-slate-500">Kelola koleksi buku perpustakaan</p>
        </div>
        <a href="{{ route('admin.koleksi.create') }}" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Tambah Buku
        </a>
    </div>

    <!-- Table -->
    <div class="rounded-xl border border-slate-200 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Cover</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Penulis</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($koleksis as $koleksi)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3">
                                @if($koleksi->cover_path)
                                    @if(str_starts_with($koleksi->cover_path, 'http'))
                                        <img src="{{ $koleksi->cover_path }}" alt="{{ $koleksi->judul }}" class="h-12 w-12 rounded object-cover">
                                    @else
                                        <img src="{{ Storage::url($koleksi->cover_path) }}" alt="{{ $koleksi->judul }}" class="h-12 w-12 rounded object-cover">
                                    @endif
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded bg-slate-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-slate-400">
                                            <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-xs font-semibold text-slate-900">{{ $koleksi->judul }}</p>
                                <p class="text-[11px] text-slate-500">{{ $koleksi->isbn ?? 'Tidak ada ISBN' }}</p>
                            </td>
                            <td class="px-4 py-3 text-xs text-slate-700">{{ $koleksi->penulis }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-full bg-sky-50 px-2 py-0.5 text-[10px] font-medium text-sky-700">
                                    {{ $koleksi->category->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'tersedia' => 'bg-emerald-50 text-emerald-700',
                                        'dipinjam' => 'bg-amber-50 text-amber-700',
                                        'rusak' => 'bg-red-50 text-red-700',
                                        'hilang' => 'bg-slate-50 text-slate-700',
                                    ];
                                @endphp
                                <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-medium {{ $statusColors[$koleksi->status] ?? 'bg-slate-50 text-slate-700' }}">
                                    {{ ucfirst($koleksi->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.koleksi.show', $koleksi) }}" class="rounded-lg p-1.5 text-slate-600 hover:bg-slate-100 transition-colors" title="Lihat">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.koleksi.edit', $koleksi) }}" class="rounded-lg p-1.5 text-emerald-600 hover:bg-emerald-50 transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                                            <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.5 2.50023C18.8978 2.10243 19.4374 1.87891 20 1.87891C20.5626 1.87891 21.1022 2.10243 21.5 2.50023C21.8978 2.89804 22.1213 3.43762 22.1213 4.00023C22.1213 4.56284 21.8978 5.10243 21.5 5.50023L12 15.0002L8 16.0002L9 12.0002L18.5 2.50023Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.koleksi.destroy', $koleksi) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg p-1.5 text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                                                <path d="M3 6H5H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-xs text-slate-500">
                                Belum ada buku. <a href="{{ route('admin.koleksi.create') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Tambah buku pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($koleksis->hasPages())
            <div class="border-t border-slate-200 px-4 py-3">
                {{ $koleksis->links() }}
            </div>
        @endif
    </div>
</div>
@endsection