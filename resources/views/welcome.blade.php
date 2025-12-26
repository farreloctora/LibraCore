<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>LibraCore &mdash; Sistem Peminjaman Buku Perpustakaan</title>
        <meta
            name="description"
            content="LibraCore adalah platform perpustakaan untuk peminjaman buku secara online, dengan pengelolaan koleksi, anggota, dan transaksi peminjaman buku fisik."
        />
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
                    <a href="{{ url('/') }}" class="text-emerald-700 font-semibold">Beranda</a>
                    <a href="{{ route('koleksi') }}" class="hover:text-emerald-700 transition-colors">Koleksi</a>
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

                <!-- Mobile title singkat -->
                <div class="flex items-center gap-2 md:hidden">
                    <span class="text-xs font-medium text-slate-700">LibraCore</span>
                </div>
            </div>
        </header>

        <main id="beranda" class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8 lg:pt-16">
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hero -->
            <section
                class="grid gap-10 rounded-3xl bg-white px-5 py-8 shadow-sm sm:px-8 sm:py-10 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] lg:items-center"
            >
                <div class="space-y-7">
                    <div
                        class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-medium text-emerald-800"
                    >
                        <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Pesan dan kelola peminjaman buku perpustakaan secara online.
                    </div>

                    <div class="space-y-4">
                        <h1
                            class="text-balance text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl"
                        >
                            Sistem Peminjaman Buku
                            <span class="block text-emerald-700">
                                yang membantu perpustakaan dan anggota bertemu.
                            </span>
                        </h1>
                        <p class="max-w-xl text-pretty text-sm text-slate-700 sm:text-base">
                            <span class="font-semibold text-emerald-700">LibraCore</span> membantu
                            perpustakaan umum mengelola data koleksi buku fisik, keanggotaan, dan riwayat
                            peminjaman. Anggota dapat mencari judul, memesan peminjaman secara online, lalu
                            mengambil buku di perpustakaan.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-4">
                        <a
                            href="/koleksi"
                            class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
                        >
                            Lihat Koleksi Buku
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-4 w-4"
                            >
                                <path
                                    d="M7 17L17 7M17 7H9M17 7V15"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </a>
                        <a
                            href="#fitur"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700"
                        >
                            Lihat Fitur Perpustakaan
                        </a>
                    </div>

                    <dl class="mt-4 grid max-w-xl grid-cols-3 gap-4 text-xs text-slate-600 sm:text-sm">
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                            <dt class="text-[11px] font-medium uppercase tracking-wide text-slate-500">
                                Koleksi Buku
                            </dt>
                            <dd class="mt-1 text-lg font-semibold text-emerald-700">1.200+</dd>
                            <dd class="text-[11px] text-slate-500">eksemplar buku fisik</dd>
                        </div>
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                            <dt class="text-[11px] font-medium uppercase tracking-wide text-slate-500">
                                Anggota Terdaftar
                            </dt>
                            <dd class="mt-1 text-lg font-semibold text-emerald-700">800+</dd>
                            <dd class="text-[11px] text-slate-500">pembaca aktif</dd>
                        </div>
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                            <dt class="text-[11px] font-medium uppercase tracking-wide text-slate-500">
                                Peminjaman / Bulan
                            </dt>
                            <dd class="mt-1 text-lg font-semibold text-emerald-700">300+</dd>
                            <dd class="text-[11px] text-slate-500">transaksi digital</dd>
                        </div>
                    </dl>
                </div>

                <!-- Hero visual: kartu pencarian & rak buku sederhana -->
                <div
                    class="relative mx-auto flex w-full max-w-md flex-col gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 shadow-sm sm:p-5"
                >
                    <!-- Search bar mock -->
                    <div class="rounded-xl border border-slate-200 bg-white p-3">
                        <p class="text-[11px] font-semibold text-slate-700">Pencarian Cepat</p>
                        <div class="mt-2 flex items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2">
                            <span class="text-slate-400">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    class="h-4 w-4"
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
                            <span class="text-[11px] text-slate-500">
                                Cari judul buku, penulis, atau kategori...
                            </span>
                        </div>
                    </div>

                    <!-- Buku Populer dari Koleksi -->
                    <div class="grid gap-3 sm:grid-cols-2">
                        @forelse($books as $book)
                            <div class="rounded-xl border border-slate-200 bg-white p-3">
                                <p class="text-[11px] font-semibold text-slate-800">
                                    {{ $book->judul }}
                                </p>
                                <p class="mt-1 text-[11px] text-slate-500">
                                    {{ $book->penulis }} &bull; {{ $book->tahun_terbit }} &bull; {{ $book->category->name ?? 'Kategori Tidak Diketahui' }}
                                </p>
                                <span
                                    class="mt-2 inline-flex w-fit rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-medium text-emerald-700"
                                >
                                    {{ $book->status === 'tersedia' ? 'Tersedia' : 'Dipinjam' }}
                                </span>
                            </div>
                        @empty
                            <div class="rounded-xl border border-slate-200 bg-white p-3">
                                <p class="text-[11px] font-semibold text-slate-800">
                                    Tidak ada buku tersedia
                                </p>
                                <p class="mt-1 text-[11px] text-slate-500">
                                    Koleksi buku sedang dimuat.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- Fitur utama -->
            <section id="fitur" class="mt-16 space-y-8 lg:mt-20">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">
                            Fitur Utama
                        </p>
                        <h2 class="mt-1 text-xl font-semibold tracking-tight text-slate-900 sm:text-2xl">
                            Semua yang dibutuhkan perpustakaan digital umum.
                        </h2>
                        <p class="mt-2 max-w-2xl text-sm text-slate-700">
                            LibraCore dirancang untuk membantu pengelola perpustakaan dan anggota dalam
                            mengelola peminjaman buku fisik secara online: dari pencarian rak, pemesanan, hingga
                            pengambilan buku di lokasi perpustakaan.
                        </p>
                    </div>
                </div>

                <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                    <article class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700"
                        >
                            <!-- Icon buku -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-4 w-4"
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
                                <path
                                    d="M9 7.5H15"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M9 10H13"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900">Manajemen Koleksi Buku</h3>
                        <p class="text-xs text-slate-600">
                            Simpan informasi judul, penulis, kategori, tahun terbit, dan file digital dalam
                            satu sistem terpadu.
                        </p>
                    </article>

                    <article class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-50 text-sky-700"
                        >
                            <!-- Icon kategori -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-4 w-4"
                            >
                                <rect
                                    x="4"
                                    y="4"
                                    width="7"
                                    height="7"
                                    rx="1.5"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                />
                                <rect
                                    x="13"
                                    y="4"
                                    width="7"
                                    height="7"
                                    rx="1.5"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                />
                                <rect
                                    x="4"
                                    y="13"
                                    width="7"
                                    height="7"
                                    rx="1.5"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                />
                                <rect
                                    x="13"
                                    y="13"
                                    width="7"
                                    height="7"
                                    rx="1.5"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900">Kategori &amp; Tag</h3>
                        <p class="text-xs text-slate-600">
                            Kelompokkan koleksi berdasarkan kategori, tema, dan tag untuk memudahkan pencarian
                            dan penelusuran.
                        </p>
                    </article>

                    <article class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-violet-700"
                        >
                            <!-- Icon pengguna -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-4 w-4"
                            >
                                <circle
                                    cx="12"
                                    cy="8"
                                    r="3"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                />
                                <path
                                    d="M6 18C6.8 15.6 9.2 14 12 14C14.8 14 17.2 15.6 18 18"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900">Keanggotaan &amp; Hak Akses</h3>
                        <p class="text-xs text-slate-600">
                            Atur akun anggota, pustakawan, dan admin dengan tingkat hak akses yang berbeda
                            sesuai kebutuhan.
                        </p>
                    </article>

                    <article class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700"
                        >
                            <!-- Icon laporan -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-4 w-4"
                            >
                                <path
                                    d="M7 5C7 4.44772 7.44772 4 8 4H16L19 7V19C19 19.5523 18.5523 20 18 20H8C7.44772 20 7 19.5523 7 19V5Z"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                />
                                <path
                                    d="M14 4V8H18"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M9 12H15"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M9 15H13"
                                    stroke="currentColor"
                                    stroke-width="1.4"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900">Laporan Peminjaman</h3>
                        <p class="text-xs text-slate-600">
                            Hasilkan laporan peminjaman dalam bentuk ringkasan maupun PDF untuk kebutuhan
                            dokumentasi dan evaluasi.
                        </p>
                    </article>
                </div>
            </section>

            <!-- Koleksi contoh -->
            <section id="koleksi" class="mt-16 lg:mt-20">
                <div
                    class="rounded-3xl border border-slate-200 bg-white px-5 py-6 shadow-sm sm:px-8 sm:py-8"
                >
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700"
                            >
                                Contoh Koleksi
                            </p>
                            <h2
                                class="mt-1 text-xl font-semibold tracking-tight text-slate-900 sm:text-2xl"
                            >
                                Koleksi buku untuk berbagai kebutuhan.
                            </h2>
                            <p class="mt-2 max-w-2xl text-sm text-slate-700">
                                Perpustakaan dapat berisi buku umum, referensi pelajaran, literatur anak, hingga
                                bahan bacaan hobi. Berikut contoh kategorinya.
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 grid gap-4 md:grid-cols-3">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <h3 class="text-sm font-semibold text-slate-900">Buku Umum &amp; Fiksi</h3>
                            <p class="mt-1 text-xs text-slate-600">
                                Novel, biografi, pengembangan diri, dan berbagai bacaan populer lainnya.
                            </p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <h3 class="text-sm font-semibold text-slate-900">Referensi Pelajaran</h3>
                            <p class="mt-1 text-xs text-slate-600">
                                Buku pelajaran sekolah, modul latihan, dan materi pendukung pembelajaran.
                            </p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <h3 class="text-sm font-semibold text-slate-900">Literatur Anak &amp; Keluarga</h3>
                            <p class="mt-1 text-xs text-slate-600">
                                Cerita anak, buku bergambar, serta bacaan edukatif yang ramah keluarga.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cara kerja sederhana -->
            <section id="cara-kerja" class="mt-16 lg:mt-20">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">
                            Cara Kerja
                        </p>
                        <h2 class="mt-1 text-xl font-semibold tracking-tight text-slate-900 sm:text-2xl">
                            Alur sederhana penggunaan LibraCore.
                        </h2>
                    </div>
                </div>

                <ol
                    class="mt-5 grid gap-4 rounded-3xl border border-slate-200 bg-white p-5 text-sm text-slate-700 sm:grid-cols-2 lg:grid-cols-4"
                >
                    <li class="flex flex-col gap-2">
                        <div class="inline-flex items-center gap-2">
                            <span
                                class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-50 text-[11px] font-semibold text-emerald-700"
                            >
                                1
                            </span>
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-slate-900"
                            >
                                Daftar Anggota
                            </span>
                        </div>
                        <p class="text-xs text-slate-700">
                            Pengguna membuat akun anggota perpustakaan digital melalui halaman pendaftaran.
                        </p>
                    </li>
                    <li class="flex flex-col gap-2">
                        <div class="inline-flex items-center gap-2">
                            <span
                                class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-50 text-[11px] font-semibold text-emerald-700"
                            >
                                2
                            </span>
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-slate-900"
                            >
                                Jelajahi Koleksi
                            </span>
                        </div>
                        <p class="text-xs text-slate-700">
                            Anggota mencari buku berdasarkan judul, penulis, kategori, atau kata kunci.
                        </p>
                    </li>
                    <li class="flex flex-col gap-2">
                        <div class="inline-flex items-center gap-2">
                            <span
                                class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-50 text-[11px] font-semibold text-emerald-700"
                            >
                                3
                            </span>
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-slate-900"
                            >
                                Ajukan Peminjaman
                            </span>
                        </div>
                        <p class="text-xs text-slate-700">
                            Anggota mengajukan peminjaman buku secara online dan datang ke perpustakaan untuk
                            mengambil buku fisik sesuai ketentuan.
                        </p>
                    </li>
                    <li class="flex flex-col gap-2">
                        <div class="inline-flex items-center gap-2">
                            <span
                                class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-50 text-[11px] font-semibold text-emerald-700"
                            >
                                4
                            </span>
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-slate-900"
                            >
                                Pantau Laporan
                            </span>
                        </div>
                        <p class="text-xs text-slate-700">
                            Pustakawan dan admin dapat melihat ringkasan peminjaman untuk evaluasi layanan.
                        </p>
                    </li>
                </ol>
            </section>

            <!-- FAQ singkat -->
            <section id="faq" class="mt-16 lg:mt-20">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">
                            Pertanyaan Umum
                        </p>
                        <h2 class="mt-1 text-xl font-semibold tracking-tight text-slate-900 sm:text-2xl">
                            FAQ seputar LibraCore.
                        </h2>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <article class="rounded-2xl border border-slate-200 bg-white p-4">
                        <h3 class="text-sm font-semibold text-slate-900">
                            Apakah LibraCore digunakan untuk banyak perpustakaan?
                        </h3>
                        <p class="mt-2 text-xs text-slate-700">
                            Saat ini LibraCore difokuskan untuk <span class="font-semibold">satu perpustakaan</span>
                            saja, misalnya perpustakaan umum di suatu instansi atau daerah. Ke depannya, sistem
                            dapat dikembangkan agar mendukung lebih banyak cabang atau jenis perpustakaan.
                        </p>
                    </article>
                    <article class="rounded-2xl border border-slate-200 bg-white p-4">
                        <h3 class="text-sm font-semibold text-slate-900">
                            Apakah pengguna bisa mengakses buku dari rumah?
                        </h3>
                        <p class="mt-2 text-xs text-slate-700">
                            Ya. Anggota dapat melihat informasi koleksi dan mengajukan peminjaman buku melalui
                            website, kemudian datang ke perpustakaan untuk mengambil buku fisik sesuai jadwal
                            dan ketentuan yang berlaku.
                        </p>
                    </article>
                </div>
            </section>
        </main>

        <footer class="border-t border-slate-200 bg-white/95">
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
