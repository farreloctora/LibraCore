<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Koleksi Buku &mdash; LibraCore</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/koleksi.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
        <!-- Header -->
        <header class="border-b border-slate-200 bg-white/95">
            <div
                class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8"
            >
                <!-- Logo + brand -->
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-600 text-sm font-semibold tracking-tight text-white shadow-sm"
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

                <!-- Nav -->
                <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                    <a href="{{ url('/') }}" class="hover:text-emerald-700 transition-colors">Beranda</a>
                    <a href="{{ route('koleksi') }}" class="text-emerald-700 font-semibold">Koleksi</a>
                    <a href="{{ route('kategori') }}" class="hover:text-emerald-700 transition-colors">Kategori</a>
                    @auth
                        <a href="{{ route('peminjaman.index') }}" class="hover:text-emerald-700 transition-colors">Peminjaman Saya</a>
                    @endauth
                </nav>

                <!-- Auth buttons -->
                <div class="hidden items-center gap-3 md:flex">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="rounded-full bg-amber-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-700"
                            >
                                Admin Panel
                            </a>
                        @endif
                        <span class="text-xs font-medium text-slate-600">
                            Halo, {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button
                                type="submit"
                                class="rounded-full border border-slate-300 px-4 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-red-600 hover:text-red-700"
                            >
                                Keluar
                            </button>
                        </form>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-full border border-slate-300 px-4 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700"
                        >
                            Masuk Anggota
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="rounded-full bg-emerald-600 px-4 py-1.5 text-xs font-semibold text-white shadow hover:bg-emerald-700"
                        >
                            Daftar Anggota
                        </a>
                    @endauth
                </div>

                <!-- Mobile title -->
                <div class="flex items-center gap-2 md:hidden">
                    <span class="text-xs font-medium text-slate-700">LibraCore</span>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8 lg:pt-16">
            <!-- Header section -->
            <div class="mb-8">
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900 sm:text-3xl">
                    Koleksi Buku
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Jelajahi koleksi buku fisik yang tersedia untuk dipinjam di perpustakaan.
                </p>
            </div>

            <!-- Search bar -->
            <div class="mb-4 rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm sm:px-6 sm:py-5">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-5 w-5"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="5"
                                stroke="currentColor"
                                stroke-width="1.4"
                            />
                            <path
                                d="M15.5 15.5L19 19"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </span>
                    <input
                        id="search-input"
                        type="text"
                        placeholder="Cari judul buku, penulis, atau ISBN..."
                        class="w-full rounded-lg border border-slate-300 bg-white pl-11 pr-4 py-3 text-base text-slate-900 shadow-sm outline-none ring-emerald-500/30 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2"
                    />
                </div>
            </div>

            <!-- Category Filter bar -->
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm sm:px-6 sm:py-5">
                <div id="category-filter" class="flex items-center gap-2 flex-wrap">
                    <button
                        type="button"
                        data-category-id=""
                        class="category-filter-btn rounded-lg border border-emerald-600 bg-white px-3 py-2 text-xs font-medium text-emerald-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700"
                    >
                        Semua Kategori
                    </button>
                </div>
            </div>

            <!-- Results info -->
            <div class="mb-4 flex items-center justify-between text-xs text-slate-600">
                <p id="results-info">
                    Memuat data...
                </p>
                <div class="flex items-center gap-2">
                    <span>Urutkan:</span>
                    <select
                        id="sort-select"
                        class="rounded-lg border border-slate-300 bg-white px-2 py-1 text-xs text-slate-700 shadow-sm outline-none focus:border-emerald-500 focus:ring-2"
                    >
                        <option value="terbaru">Terbaru</option>
                        <option value="judul-az">Judul A-Z</option>
                        <option value="judul-za">Judul Z-A</option>
                        <option value="populer">Paling Populer</option>
                    </select>
                </div>
            </div>

            <!-- Book grid -->
            <div id="koleksi-grid" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <!-- Data akan dimuat secara dinamis dari API -->
                <div class="col-span-full text-center py-12">
                    <p class="text-sm text-slate-500">Memuat data koleksi...</p>
                </div>
            </div>

            <!-- Pagination -->
            <div id="pagination" class="mt-8 flex items-center justify-center gap-2 flex-wrap">
                <!-- Pagination akan dimuat secara dinamis -->
            </div>
        </main>

        <footer class="border-t border-slate-200 bg-white/95 mt-16">
            <div
                class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8"
            >
                <p>
                    &copy; {{ date('Y') }} <span class="font-medium text-slate-700">LibraCore</span>.
                    Perpustakaan Digital Umum.
                </p>
                <p class="text-[11px]">
                    Dibangun dengan Laravel &amp; Tailwind CSS.
                </p>
            </div>
        </footer>
    </body>
</html>
