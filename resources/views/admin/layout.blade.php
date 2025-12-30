<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') &mdash; LibraCore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col">
            <!-- Logo -->
            <div class="p-4 border-b border-slate-200">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-600 text-sm font-semibold tracking-tight text-white shadow-sm">
                        LC
                    </span>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold tracking-tight text-slate-900">LibraCore</p>
                        <p class="text-[11px] font-medium text-slate-500">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                        <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.koleksi.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.koleksi.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                        <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        <path d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 7.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 10H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Manajemen Buku
                </a>
                <a href="{{ route('admin.category.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.category.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                        <rect x="4" y="4" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                        <rect x="13" y="4" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                        <rect x="4" y="13" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                        <rect x="13" y="13" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                    Manajemen Kategori
                </a>
                <a href="{{ route('admin.user.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.user.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                        <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M6 18C6.8 15.6 9.2 14 12 14C14.8 14 17.2 15.6 18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Manajemen Pengguna
                </a>
                <a href="{{ route('admin.peminjaman.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.peminjaman.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                        <path d="M7 5C7 4.44772 7.44772 4 8 4H16L19 7V19C19 19.5523 18.5523 20 18 20H8C7.44772 20 7 19.5523 7 19V5Z" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M14 4V8H18" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        <path d="M9 12H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 15H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Manajemen Peminjaman
                </a>
            </nav>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-slate-200">
                <div class="mb-3 px-3 py-2 rounded-lg bg-slate-50">
                    <p class="text-xs font-medium text-slate-900">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-500">{{ Auth::user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 12H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-semibold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                    <a href="{{ url('/') }}" class="text-xs font-medium text-slate-600 hover:text-emerald-700 transition-colors">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>

