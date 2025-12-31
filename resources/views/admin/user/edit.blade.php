@extends('admin.layout')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.user.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-xs font-medium text-slate-700 mb-1.5">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-medium text-slate-700 mb-1.5">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                        placeholder="nama@contoh.com">
                    @error('email')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="password" class="block text-xs font-medium text-slate-700 mb-1.5">Kata Sandi Baru</label>
                        <input type="password" id="password" name="password"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('password') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                            placeholder="Kosongkan jika tidak ingin mengubah">
                        <p class="mt-1 text-[11px] text-slate-500">Kosongkan jika tidak ingin mengubah kata sandi</p>
                        @error('password')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2"
                            placeholder="Ulangi kata sandi baru">
                    </div>
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-xs font-medium text-slate-700 mb-1.5">Role *</label>
                    <select id="role" name="role" required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 focus:border-emerald-500 focus:ring-2 @error('role') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.user.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-slate-400">
                    Batal
                </a>
                <button type="submit" class="rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Perbarui Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

