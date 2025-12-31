@extends('admin.layout')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@section('content')
<div class="max-w-4xl">
    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-slate-900">{{ $category->name }}</h2>
            @if($category->description)
                <p class="mt-2 text-sm text-slate-600">{{ $category->description }}</p>
            @endif
        </div>

        <div class="mb-6">
            <p class="text-xs font-medium text-slate-500 mb-2">Jumlah Buku</p>
            <p class="text-2xl font-semibold text-slate-900">{{ $category->koleksis->count() }} buku</p>
        </div>

        @if($category->koleksis->count() > 0)
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-4">Daftar Buku</h3>
                <div class="space-y-3">
                    @foreach($category->koleksis as $koleksi)
                        <div class="flex items-center gap-3 rounded-lg border border-slate-100 p-3">
                            @if($koleksi->cover_path)
                                <img src="{{ Storage::url($koleksi->cover_path) }}" alt="{{ $koleksi->judul }}" class="h-12 w-12 rounded object-cover">
                            @else
                                <div class="flex h-12 w-12 items-center justify-center rounded bg-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-slate-400">
                                        <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-slate-900 truncate">{{ $koleksi->judul }}</p>
                                <p class="text-[11px] text-slate-500">{{ $koleksi->penulis }}</p>
                            </div>
                            <a href="{{ route('admin.koleksi.show', $koleksi) }}" class="text-xs font-medium text-emerald-700 hover:text-emerald-800">
                                Lihat →
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-6 flex items-center gap-3 pt-6 border-t border-slate-200">
            <a href="{{ route('admin.category.edit', $category) }}" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                Edit Kategori
            </a>
            <a href="{{ route('admin.category.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-slate-400">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection

