@extends('admin.layout')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')

@section('content')
<div class="max-w-3xl">
    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.koleksi.update', $koleksi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <!-- Cover Preview -->
                @if($koleksi->cover_path)
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1.5">Cover Saat Ini</label>
                        <div class="flex items-center gap-4">
                            @if(str_starts_with($koleksi->cover_path, 'http'))
                                <img src="{{ $koleksi->cover_path }}" alt="{{ $koleksi->judul }}" class="h-24 w-24 rounded object-cover border border-slate-200">
                            @else
                                <img src="{{ Storage::url($koleksi->cover_path) }}" alt="{{ $koleksi->judul }}" class="h-24 w-24 rounded object-cover border border-slate-200">
                            @endif
                            <div>
                                <p class="text-xs text-slate-600">Upload gambar baru untuk mengganti cover</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-xs font-medium text-slate-700 mb-1.5">Judul Buku *</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $koleksi->judul) }}" required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('judul') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="Masukkan judul buku">
                    @error('judul')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-xs font-medium text-slate-700 mb-1.5">Penulis *</label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $koleksi->penulis) }}" required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('penulis') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="Masukkan nama penulis">
                    @error('penulis')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ISBN & Tahun Terbit -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="isbn" class="block text-xs font-medium text-slate-700 mb-1.5">ISBN</label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $koleksi->isbn) }}"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('isbn') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                            placeholder="Masukkan ISBN">
                        @error('isbn')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tahun_terbit" class="block text-xs font-medium text-slate-700 mb-1.5">Tahun Terbit *</label>
                        <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $koleksi->tahun_terbit) }}" required min="1000" max="{{ date('Y') }}"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('tahun_terbit') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                            placeholder="Contoh: 2024">
                        @error('tahun_terbit')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Penerbit & Kategori -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="penerbit" class="block text-xs font-medium text-slate-700 mb-1.5">Penerbit</label>
                        <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit', $koleksi->penerbit) }}"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('penerbit') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                            placeholder="Masukkan nama penerbit">
                        @error('penerbit')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-medium text-slate-700 mb-1.5">Kategori *</label>
                        <select id="category_id" name="category_id" required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 focus:border-emerald-500 focus:ring-2 @error('category_id') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $koleksi->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status & Cover -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="status" class="block text-xs font-medium text-slate-700 mb-1.5">Status *</label>
                        <select id="status" name="status" required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 focus:border-emerald-500 focus:ring-2 @error('status') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror">
                            <option value="tersedia" {{ old('status', $koleksi->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dibooking" {{ old('status', $koleksi->status) == 'dibooking' ? 'selected' : '' }}>Dibooking</option>
                            <option value="dipinjam" {{ old('status', $koleksi->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="rusak" {{ old('status', $koleksi->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="hilang" {{ old('status', $koleksi->status) == 'hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cover" class="block text-xs font-medium text-slate-700 mb-1.5">Cover Buku Baru</label>
                        <input type="file" id="cover" name="cover" accept="image/jpeg,image/png,image/jpg,image/gif"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 focus:border-emerald-500 focus:ring-2 @error('cover') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror">
                        <p class="mt-1 text-[11px] text-slate-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                        @error('cover')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-xs font-medium text-slate-700 mb-1.5">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('deskripsi') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="Masukkan deskripsi buku">{{ old('deskripsi', $koleksi->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.koleksi.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-slate-400">
                    Batal
                </a>
                <button type="submit" class="rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Perbarui Buku
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

