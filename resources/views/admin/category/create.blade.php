@extends('admin.layout')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf

            <div class="space-y-5">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-xs font-medium text-slate-700 mb-1.5">Nama Kategori *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="Masukkan nama kategori">
                    @error('name')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-xs font-medium text-slate-700 mb-1.5">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('description') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon Color -->
                <div>
                    <label for="icon_color" class="block text-xs font-medium text-slate-700 mb-1.5">Warna Icon</label>
                    <input type="text" id="icon_color" name="icon_color" value="{{ old('icon_color', 'emerald') }}"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('icon_color') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="emerald, sky, violet, amber, dll">
                    <p class="mt-1 text-[11px] text-slate-500">Contoh: emerald, sky, violet, amber, red, blue</p>
                    @error('icon_color')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.category.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-slate-400">
                    Batal
                </a>
                <button type="submit" class="rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

