<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $koleksi->judul }} &mdash; LibraCore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <!-- Header -->
    <header class="border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <!-- Logo + brand -->
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-600 text-sm font-semibold tracking-tight text-white shadow-sm">
                    LC
                </span>
                <div class="leading-tight">
                    <p class="text-sm font-semibold tracking-tight text-slate-900">LibraCore</p>
                    <p class="text-[11px] font-medium text-slate-500">Perpustakaan Digital Umum</p>
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
                        <a href="{{ route('admin.dashboard') }}" class="rounded-full bg-amber-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-700">
                            Admin Panel
                        </a>
                    @endif
                    <span class="text-xs font-medium text-slate-600">Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="rounded-full border border-slate-300 px-4 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-red-600 hover:text-red-700">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-full border border-slate-300 px-4 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700">
                        Masuk Anggota
                    </a>
                    <a href="{{ route('register') }}" class="rounded-full bg-emerald-600 px-4 py-1.5 text-xs font-semibold text-white shadow hover:bg-emerald-700">
                        Daftar Anggota
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8 lg:pt-16">
        @if (session('success'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('koleksi') }}" class="inline-flex items-center gap-2 text-xs font-medium text-slate-600 hover:text-emerald-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                    <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke Koleksi
            </a>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Cover & Actions -->
            <div class="lg:col-span-1">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    @if($koleksi->cover_path)
                        @if(str_starts_with($koleksi->cover_path, 'http'))
                            <img src="{{ $koleksi->cover_path }}" alt="{{ $koleksi->judul }}" class="w-full rounded-lg border border-slate-200 object-cover">
                        @else
                            <img src="{{ Storage::url($koleksi->cover_path) }}" alt="{{ $koleksi->judul }}" class="w-full rounded-lg border border-slate-200 object-cover">
                        @endif
                    @else
                        <img src="{{ Storage::url('covers/placeholder.jpg') }}" alt="{{ $koleksi->judul }}" class="w-full rounded-lg border border-slate-200 object-cover">
                    @endif

                    <!-- Status Badge -->
                    <div class="mt-4">
                        @php
                            $statusColors = [
                                'tersedia' => 'bg-emerald-50 text-emerald-700',
                                'dipinjam' => 'bg-amber-50 text-amber-700',
                                'rusak' => 'bg-red-50 text-red-700',
                                'hilang' => 'bg-slate-50 text-slate-700',
                            ];
                        @endphp
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $statusColors[$koleksi->status] ?? 'bg-slate-50 text-slate-700' }}">
                            {{ ucfirst($koleksi->status) }}
                        </span>
                    </div>

                    <!-- Action Button -->
                    @if($koleksi->isAvailable())
                        @auth
                            @if($activeLoan)
                                <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 p-3 text-xs text-amber-700">
                                    <p class="font-medium">{{ $activeLoan->status === 'dibooking' ? 'Buku telah anda booking' : 'Anda sedang meminjam buku ini' }}</p>
                                    <p class="mt-1 text-[11px]">Batas pengembalian: {{ $activeLoan->batas_kembali->format('d M Y') }}</p>
                                </div>
                            @else
                                <form action="{{ route('koleksi.pinjam', $koleksi) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="w-full rounded-full bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                                        Pinjam Buku
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="mt-4">
                                <a href="{{ route('login') }}" class="block w-full rounded-full bg-emerald-600 px-4 py-2.5 text-center text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                                    Login untuk Meminjam
                                </a>
                            </div>
                        @endauth
                    @else
                        <div class="mt-4 rounded-lg border border-slate-200 bg-slate-50 p-3 text-xs text-slate-600">
                            <p>Buku tidak tersedia untuk dipinjam saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Details -->
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h1 class="text-2xl font-semibold text-slate-900">{{ $koleksi->judul }}</h1>
                    <p class="mt-2 text-sm text-slate-600">oleh {{ $koleksi->penulis }}</p>

                    <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Kategori</p>
                            <p class="mt-1 font-medium text-slate-900">{{ $koleksi->category->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500">Tahun Terbit</p>
                            <p class="mt-1 font-medium text-slate-900">{{ $koleksi->tahun_terbit }}</p>
                        </div>
                        @if($koleksi->isbn)
                            <div>
                                <p class="text-xs font-medium text-slate-500">ISBN</p>
                                <p class="mt-1 font-medium text-slate-900">{{ $koleksi->isbn }}</p>
                            </div>
                        @endif
                        @if($koleksi->penerbit)
                            <div>
                                <p class="text-xs font-medium text-slate-500">Penerbit</p>
                                <p class="mt-1 font-medium text-slate-900">{{ $koleksi->penerbit }}</p>
                            </div>
                        @endif
                    </div>

                    @if($koleksi->deskripsi)
                        <div class="mt-6">
                            <h2 class="text-sm font-semibold text-slate-900 mb-2">Deskripsi</h2>
                            <p class="text-sm text-slate-700 leading-relaxed">{{ $koleksi->deskripsi }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white/95 mt-16">
        <div class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} <span class="font-medium text-slate-700">LibraCore</span>. Perpustakaan Digital Umum.</p>
            <p class="text-[11px]">Dibangun dengan Laravel &amp; Tailwind CSS.</p>
        </div>
    </footer>
</body>
</html>

