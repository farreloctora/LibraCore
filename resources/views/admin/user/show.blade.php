@extends('admin.layout')

@section('title', 'Detail Pengguna')
@section('page-title', 'Detail Pengguna')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <div class="space-y-6">
            <!-- User Info -->
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-lg font-semibold text-emerald-700">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">{{ $user->name }}</h2>
                    <p class="text-sm text-slate-600">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Details -->
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-xs font-medium text-slate-500">Role</p>
                    <span class="mt-1 inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $user->role === 'admin' ? 'bg-amber-50 text-amber-700' : 'bg-slate-50 text-slate-700' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Terdaftar</p>
                    <p class="mt-1 font-medium text-slate-900">{{ $user->created_at->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Terakhir Diperbarui</p>
                    <p class="mt-1 font-medium text-slate-900">{{ $user->updated_at->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Email Terverifikasi</p>
                    <p class="mt-1 font-medium text-slate-900">{{ $user->email_verified_at ? $user->email_verified_at->format('d M Y') : 'Belum' }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.user.edit', $user) }}" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Edit Pengguna
                </a>
                <a href="{{ route('admin.user.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-slate-400">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

