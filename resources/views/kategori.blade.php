<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Kategori Buku &mdash; LibraCore</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <a href="{{ route('koleksi') }}" class="hover:text-emerald-700 transition-colors">Koleksi</a>
                    <a href="{{ route('kategori') }}" class="text-emerald-700 font-semibold">Kategori</a>
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
                    Kategori Buku
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Jelajahi koleksi berdasarkan kategori untuk memudahkan pencarian buku yang Anda butuhkan.
                </p>
            </div>

            <!-- Categories grid -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Category card 1 -->
                <a
                    href="{{ route('koleksi') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md"
                >
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-5 w-5"
                        >
                            <path
                                d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">
                        Buku Umum &amp; Fiksi
                    </h3>
                    <p class="mt-1 text-xs text-slate-600">
                        Novel, biografi, pengembangan diri, dan berbagai bacaan populer lainnya.
                    </p>
                    <p class="mt-2 text-[11px] font-medium text-emerald-700">
                        320+ buku
                    </p>
                </a>

                <!-- Category card 2 -->
                <a
                    href="{{ route('koleksi') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md"
                >
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-sky-50 text-sky-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-5 w-5"
                        >
                            <path
                                d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">
                        Referensi Pelajaran
                    </h3>
                    <p class="mt-1 text-xs text-slate-600">
                        Buku pelajaran sekolah, modul latihan, dan materi pendukung pembelajaran.
                    </p>
                    <p class="mt-2 text-[11px] font-medium text-emerald-700">
                        280+ buku
                    </p>
                </a>

                <!-- Category card 3 -->
                <a
                    href="{{ route('koleksi') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md"
                >
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-50 text-violet-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-5 w-5"
                        >
                            <path
                                d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">
                        Literatur Anak &amp; Keluarga
                    </h3>
                    <p class="mt-1 text-xs text-slate-600">
                        Cerita anak, buku bergambar, serta bacaan edukatif yang ramah keluarga.
                    </p>
                    <p class="mt-2 text-[11px] font-medium text-emerald-700">
                        150+ buku
                    </p>
                </a>

                <!-- Category card 4 -->
                <a
                    href="{{ route('koleksi') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md"
                >
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-5 w-5"
                        >
                            <path
                                d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">
                        Teknik &amp; Ilmu Komputer
                    </h3>
                    <p class="mt-1 text-xs text-slate-600">
                        Buku tentang pemrograman, jaringan, basis data, dan teknologi informasi.
                    </p>
                    <p class="mt-2 text-[11px] font-medium text-emerald-700">
                        200+ buku
                    </p>
                </a>

                <!-- Category card 5 -->
                <a
                    href="{{ route('koleksi') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md"
                >
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-5 w-5"
                        >
                            <path
                                d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">
                        Sejarah &amp; Budaya
                    </h3>
                    <p class="mt-1 text-xs text-slate-600">
                        Buku sejarah Indonesia, budaya lokal, dan dokumentasi peristiwa penting.
                    </p>
                    <p class="mt-2 text-[11px] font-medium text-emerald-700">
                        120+ buku
                    </p>
                </a>

                <!-- Category card 6 -->
                <a
                    href="{{ route('koleksi') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md"
                >
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-sky-50 text-sky-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-5 w-5"
                        >
                            <path
                                d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17"
                                stroke="currentColor"
                                stroke-width="1.4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">
                        Sains &amp; Pengetahuan Umum
                    </h3>
                    <p class="mt-1 text-xs text-slate-600">
                        Buku sains populer, pengetahuan umum, dan eksplorasi dunia ilmu pengetahuan.
                    </p>
                    <p class="mt-2 text-[11px] font-medium text-emerald-700">
                        180+ buku
                    </p>
                </a>
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
