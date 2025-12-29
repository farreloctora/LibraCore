<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya &mdash; LibraCore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <!-- Header -->
    <header class="border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-600 text-sm font-semibold tracking-tight text-white shadow-sm">
                    LC
                </span>
                <div class="leading-tight">
                    <p class="text-sm font-semibold tracking-tight text-slate-900">LibraCore</p>
                    <p class="text-[11px] font-medium text-slate-500">Perpustakaan Digital Umum</p>
                </div>
            </a>

            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ url('/') }}" class="hover:text-emerald-700 transition-colors">Beranda</a>
                <a href="{{ route('koleksi') }}" class="hover:text-emerald-700 transition-colors">Koleksi</a>
                <a href="{{ route('kategori') }}" class="hover:text-emerald-700 transition-colors">Kategori</a>
                <a href="{{ route('peminjaman.index') }}" class="text-emerald-700 font-semibold">Peminjaman Saya</a>
            </nav>

            <div class="hidden items-center gap-3 md:flex">
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
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8 lg:pt-16">
        @if (session('success'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Peminjaman Saya</h1>
                <p class="mt-1 text-sm text-slate-600">Riwayat peminjaman buku Anda</p>
            </div>
            <a href="{{ route('peminjaman.export-pdf') }}" class="inline-flex items-center gap-2 rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4">
                    <path d="M7 5C7 4.44772 7.44772 4 8 4H16L19 7V19C19 19.5523 18.5523 20 18 20H8C7.44772 20 7 19.5523 7 19V5Z" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M14 4V8H18" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    <path d="M9 12H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M9 15H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                Export PDF
            </a>
        </div>

        @if($peminjamans->count() > 0)
            <div class="rounded-xl border border-slate-200 bg-white overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Judul Buku</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Tanggal Pinjam</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Batas Kembali</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Tanggal Kembali</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($peminjamans as $peminjaman)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if($peminjaman->koleksi->cover_path)
                                                <img src="{{ Storage::url($peminjaman->koleksi->cover_path) }}" alt="{{ $peminjaman->koleksi->judul }}" class="h-12 w-12 rounded object-cover">
                                            @else
                                                <div class="flex h-12 w-12 items-center justify-center rounded bg-slate-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-slate-400">
                                                        <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-xs font-semibold text-slate-900">{{ $peminjaman->koleksi->judul }}</p>
                                                <p class="text-[11px] text-slate-500">{{ $peminjaman->koleksi->penulis }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-slate-700">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-xs text-slate-700">{{ $peminjaman->batas_kembali->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-xs text-slate-700">
                                        {{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusColors = [
                                                'dibooking' => 'bg-blue-50 text-blue-700',
                                                'dipinjam' => 'bg-amber-50 text-amber-700',
                                                'dikembalikan' => 'bg-emerald-50 text-emerald-700',
                                                'terlambat' => 'bg-red-50 text-red-700',
                                            ];
                                        @endphp
                                        <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-medium {{ $statusColors[$peminjaman->status] ?? 'bg-slate-50 text-slate-700' }}">
                                            {{ ucfirst($peminjaman->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($peminjamans->hasPages())
                    <div class="border-t border-slate-200 px-4 py-3">
                        {{ $peminjamans->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="rounded-xl border border-slate-200 bg-white p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="mx-auto h-16 w-16 text-slate-400">
                    <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <p class="mt-4 text-sm font-medium text-slate-900">Belum ada peminjaman</p>
                <p class="mt-1 text-xs text-slate-500">Mulai pinjam buku dari koleksi perpustakaan</p>
                <a href="{{ route('koleksi') }}" class="mt-4 inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Lihat Koleksi Buku
                </a>
            </div>
        @endif
    </main>

    <footer class="border-t border-slate-200 bg-white/95 mt-16">
        <div class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} <span class="font-medium text-slate-700">LibraCore</span>. Perpustakaan Digital Umum.</p>
            <p class="text-[11px]">Dibangun dengan Laravel &amp; Tailwind CSS.</p>
        </div>
    </footer>
</body>
</html>

