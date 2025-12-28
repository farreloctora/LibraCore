<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Daftar Anggota &mdash; LibraCore</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
        <div class="flex min-h-screen flex-col">
            <!-- Header ringkas -->
            <header class="border-b border-slate-200 bg-white/95">
                <div
                    class="mx-auto flex max-w-4xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8"
                >
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <span
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-600 text-xs font-semibold tracking-tight text-white shadow-sm"
                        >
                            LC
                        </span>
                        <div class="leading-tight">
                            <p class="text-sm font-semibold tracking-tight text-slate-900">
                                LibraCore
                            </p>
                            <p class="text-[11px] font-medium text-slate-500">
                                Perpustakaan Digital Umum
                            </p>
                        </div>
                    </a>

                    <a
                        href="{{ route('login') }}"
                        class="hidden text-xs font-medium text-emerald-700 hover:text-emerald-800 sm:inline-flex"
                    >
                        Sudah punya akun? Masuk
                    </a>
                </div>
            </header>

            <!-- Konten -->
            <main class="flex flex-1 items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
                <div
                    class="w-full max-w-md rounded-3xl border border-slate-200 bg-white px-5 py-6 shadow-sm sm:px-7 sm:py-8"
                >
                    <h1 class="text-lg font-semibold tracking-tight text-slate-900">
                        Daftar Anggota Baru
                    </h1>
                    <p class="mt-1 text-xs text-slate-600">
                        Buat akun untuk mengajukan peminjaman dan mengelola daftar buku fisik yang Anda pinjam.
                    </p>

                    @if ($errors->any())
                        <div class="mt-4 rounded-lg border border-red-200 bg-red-50 p-3 text-xs text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-xs text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form class="mt-5 space-y-4" action="{{ route('register') }}" method="post">
                        @csrf
                        <!-- Nama lengkap -->
                        <div class="space-y-1.5">
                            <label
                                for="name"
                                class="block text-xs font-medium text-slate-700"
                            >
                                Nama lengkap
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                                placeholder="Nama lengkap Anda"
                                required
                            />
                            @error('name')
                                <p class="text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label
                                for="email"
                                class="block text-xs font-medium text-slate-700"
                            >
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                                placeholder="nama@contoh.com"
                                required
                            />
                            @error('email')
                                <p class="text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-1.5">
                            <label
                                for="password"
                                class="block text-xs font-medium text-slate-700"
                            >
                                Kata sandi
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 @error('password') border-red-300 focus:border-red-500 focus:ring-red-500/30 @enderror"
                                placeholder="Minimal 8 karakter"
                                required
                            />
                            @error('password')
                                <p class="text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="space-y-1.5">
                            <label
                                for="password_confirmation"
                                class="block text-xs font-medium text-slate-700"
                            >
                                Konfirmasi kata sandi
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2"
                                placeholder="Ulangi kata sandi"
                                required
                            />
                        </div>

                        <!-- Setuju syarat -->
                        <div class="flex items-start gap-2 text-xs text-slate-600">
                            <input
                                type="checkbox"
                                id="terms"
                                name="terms"
                                value="1"
                                class="mt-0.5 h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 @error('terms') border-red-300 @enderror"
                                required
                            />
                            <label for="terms">
                                Saya menyetujui ketentuan penggunaan dan kebijakan privasi LibraCore.
                            </label>
                        </div>
                        @error('terms')
                            <p class="text-[11px] text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Tombol -->
                        <button
                            type="submit"
                            class="mt-2 inline-flex w-full items-center justify-center rounded-full bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
                        >
                            Daftar
                        </button>
                    </form>

                    <p class="mt-4 text-center text-[11px] text-slate-500">
                        Sudah punya akun?
                        <a
                            href="{{ route('login') }}"
                            class="font-medium text-emerald-700 hover:text-emerald-800"
                        >
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </main>
        </div>
    </body>
</html>
