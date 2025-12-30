@extends('admin.layout')

@section('title', 'Detail Buku')
@section('page-title', 'Detail Buku')

@section('content')
<div class="max-w-4xl">
    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Cover -->
            <div>
                @if($koleksi->cover_path)
                    @if(str_starts_with($koleksi->cover_path, 'http'))
                        <img src="{{ $koleksi->cover_path }}" alt="{{ $koleksi->judul }}" class="w-full rounded-lg border border-slate-200 object-cover">
                    @else
                        <img src="{{ Storage::url($koleksi->cover_path) }}" alt="{{ $koleksi->judul }}" class="w-full rounded-lg border border-slate-200 object-cover">
                    @endif
                @else
                    <div class="flex h-64 w-full items-center justify-center rounded-lg border border-slate-200 bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-16 w-16 text-slate-400">
                            <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Details -->
            <div class="lg:col-span-2 space-y-4">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">{{ $koleksi->judul }}</h2>
                    <p class="mt-1 text-sm text-slate-600">oleh {{ $koleksi->penulis }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs font-medium text-slate-500">Kategori</p>
                        <p class="mt-1 font-medium text-slate-900">{{ $koleksi->category->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Status</p>
                        @php
                            $statusColors = [
                                'tersedia' => 'bg-emerald-50 text-emerald-700',
                                'dipinjam' => 'bg-amber-50 text-amber-700',
                                'rusak' => 'bg-red-50 text-red-700',
                                'hilang' => 'bg-slate-50 text-slate-700',
                            ];
                        @endphp
                        <span class="mt-1 inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $statusColors[$koleksi->status] ?? 'bg-slate-50 text-slate-700' }}">
                            {{ ucfirst($koleksi->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">ISBN</p>
                        <p class="mt-1 font-medium text-slate-900">{{ $koleksi->isbn ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Tahun Terbit</p>
                        <p class="mt-1 font-medium text-slate-900">{{ $koleksi->tahun_terbit }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Penerbit</p>
                        <p class="mt-1 font-medium text-slate-900">{{ $koleksi->penerbit ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Ditambahkan</p>
                        <p class="mt-1 font-medium text-slate-900">{{ $koleksi->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                @if($koleksi->deskripsi)
                    <div>
                        <p class="text-xs font-medium text-slate-500 mb-1.5">Deskripsi</p>
                        <p class="text-sm text-slate-700 leading-relaxed">{{ $koleksi->deskripsi }}</p>
                    </div>
                @endif

                <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('admin.koleksi.edit', $koleksi) }}" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                            <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18.5 2.50023C18.8978 2.10243 19.4374 1.87891 20 1.87891C20.5626 1.87891 21.1022 2.10243 21.5 2.50023C21.8978 2.89804 22.1213 3.43762 22.1213 4.00023C22.1213 4.56284 21.8978 5.10243 21.5 5.50023L12 15.0002L8 16.0002L9 12.0002L18.5 2.50023Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Edit Buku
                    </a>
                    <a href="{{ route('admin.koleksi.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-slate-400">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

