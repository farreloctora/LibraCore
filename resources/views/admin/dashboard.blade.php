@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Total Books -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Total Buku</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-900">{{ $stats['total_books'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-emerald-600">
                        <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        <path d="M9 7.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Available Books -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Buku Tersedia</p>
                    <p class="mt-1 text-2xl font-semibold text-emerald-700">{{ $stats['available_books'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-emerald-600">
                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Total Kategori</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-900">{{ $stats['total_categories'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-sky-600">
                        <rect x="4" y="4" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                        <rect x="13" y="4" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Total Pengguna</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-900">{{ $stats['total_users'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-violet-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-violet-600">
                        <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M6 18C6.8 15.6 9.2 14 12 14C14.8 14 17.2 15.6 18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Admins -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Admin</p>
                    <p class="mt-1 text-2xl font-semibold text-amber-700">{{ $stats['total_admins'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-amber-600">
                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Members -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Anggota</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-900">{{ $stats['total_members'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-slate-600">
                        <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M6 18C6.8 15.6 9.2 14 12 14C14.8 14 17.2 15.6 18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Books & Users -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Books -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-900">Buku Terbaru</h2>
                <a href="{{ route('admin.koleksi.index') }}" class="text-xs font-medium text-emerald-700 hover:text-emerald-800">
                    Lihat semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recent_books as $book)
                    <div class="flex items-center gap-3 rounded-lg border border-slate-100 p-3">
                        @if($book->cover_path)
                            @if(str_starts_with($book->cover_path, 'http'))
                                <img src="{{ $book->cover_path }}" alt="{{ $book->judul }}" class="h-12 w-12 rounded object-cover">
                            @else
                                <img src="{{ Storage::url($book->cover_path) }}" alt="{{ $book->judul }}" class="h-12 w-12 rounded object-cover">
                            @endif
                        @else
                            <div class="flex h-12 w-12 items-center justify-center rounded bg-slate-100">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-slate-400">
                                    <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-slate-900 truncate">{{ $book->judul }}</p>
                            <p class="text-[11px] text-slate-500">{{ $book->penulis }} • {{ $book->category->name }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 text-center py-4">Belum ada buku</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Users -->
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-900">Pengguna Terbaru</h2>
                <a href="{{ route('admin.user.index') }}" class="text-xs font-medium text-emerald-700 hover:text-emerald-800">
                    Lihat semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recent_users as $user)
                    <div class="flex items-center gap-3 rounded-lg border border-slate-100 p-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-xs font-semibold text-emerald-700">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-slate-900 truncate">{{ $user->name }}</p>
                            <p class="text-[11px] text-slate-500">{{ $user->email }}</p>
                        </div>
                        <span class="rounded-full px-2 py-0.5 text-[10px] font-medium {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 text-center py-4">Belum ada pengguna</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

