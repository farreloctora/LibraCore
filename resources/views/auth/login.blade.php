<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Masuk Anggota &mdash; LibraCore</title>
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
                        href="{{ route('register') }}"
                        class="hidden text-xs font-medium text-emerald-700 hover:text-emerald-800 sm:inline-flex"
                    >
                        Belum punya akun? Daftar
                    </a>
                </div>
            </header>

            <!-- Konten -->
            <main class="flex flex-1 items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
                <div
                    class="w-full max-w-md rounded-3xl border border-slate-200 bg-white px-5 py-6 shadow-sm sm:px-7 sm:py-8"
                >
                    <h1 class="text-lg font-semibold tracking-tight text-slate-900">
                        Masuk Anggota
                    </h1>
                    <p class="mt-1 text-xs text-slate-600">
                        Masuk untuk mengajukan peminjaman dan melihat riwayat peminjaman buku fisik Anda.
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

                    <form class="mt-5 space-y-4" action="{{ route('login') }}" method="post">
                        @csrf
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
                            <div class="flex items-center justify-between text-xs">
                                <label
                                    for="password"
                                    class="font-medium text-slate-700"
                                >
                                    Kata sandi
                                </label>
                                <button
                                    type="button"
                                    class="text-[11px] font-medium text-emerald-700 hover:text-emerald-800"
                                >
                                    Lupa kata sandi?
                                </button>
                            </div>
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

                        <!-- Remember me -->
                        <div class="flex items-center justify-between text-xs">
                            <label class="inline-flex items-center gap-2 text-slate-600">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                />
                                <span>Ingat saya di perangkat ini</span>
                            </label>
                        </div>

                        <!-- Tombol -->
                        <button
                            type="submit"
                            class="mt-2 inline-flex w-full items-center justify-center rounded-full bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
                        >
                            Masuk
                        </button>
                    </form>

                    <p class="mt-4 text-center text-[11px] text-slate-500">
                        Belum punya akun?
                        <a
                            href="{{ route('register') }}"
                            class="font-medium text-emerald-700 hover:text-emerald-800"
                        >
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </main>
        </div>
    </body>
</html>
