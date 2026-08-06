<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — {{ $schoolName ?? \App\Models\CMS\Setting::get('school_name', 'SMK Negeri 1 Sebulu') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { skblue: {
            50:'#EFF6FF',100:'#DBEAFE',200:'#BFDBFE',300:'#93C5FD',400:'#60A5FA',
            500:'#3B82F6',600:'#2563EB',700:'#1D4ED8',800:'#1E40AF',900:'#1E3A8A'
        }}}}}
    </script>
</head>
<body class="bg-skblue-50 text-slate-700">
@php
    $user = auth()->user();
    $isSuperAdmin = $user?->hasRole('super-admin') ?? false;
@endphp

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 shrink-0 bg-skblue-900 text-skblue-100 hidden md:flex flex-col">
        <div class="px-6 py-5 border-b border-skblue-800">
            <p class="font-bold text-white">Panel Admin</p>
            <p class="text-xs text-skblue-300">{{ $schoolName ?? \App\Models\CMS\Setting::get('school_name', 'SMK Negeri 1 Sebulu') }}</p>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 text-sm overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Dashboard</a>

            <p class="px-3 pt-4 pb-1 text-[10px] uppercase tracking-wider text-skblue-400">CMS</p>
            <a href="{{ route('admin.cms.gallery.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Galeri Foto</a>
            <a href="{{ route('admin.cms.news.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Berita</a>
            <a href="{{ route('admin.cms.pages.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Halaman</a>
            <a href="{{ route('admin.cms.announcements.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Pengumuman</a>
            @if($isSuperAdmin)
                <a href="{{ route('admin.cms.settings.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Pengaturan Situs</a>
            @endif

            <p class="px-3 pt-4 pb-1 text-[10px] uppercase tracking-wider text-skblue-400">PPDB</p>
            <a href="{{ route('admin.ppdb.applicants.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Pendaftar</a>
            <a href="{{ route('admin.ppdb.verification.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition">Verifikasi Berkas</a>

            {{-- Menu ini CUMA muncul untuk Super Admin --}}
            @if($isSuperAdmin)
                <p class="px-3 pt-4 pb-1 text-[10px] uppercase tracking-wider text-skblue-400">Khusus Super Admin</p>
                <a href="{{ route('admin.auth.users.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition flex items-center justify-between">
                    Kelola Pengguna
                    <svg class="w-3.5 h-3.5 text-skblue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </a>
                <a href="{{ route('admin.auth.roles.index') }}" class="block px-3 py-2 rounded-lg hover:bg-skblue-800 transition flex items-center justify-between">
                    Kelola Role &amp; Izin
                    <svg class="w-3.5 h-3.5 text-skblue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </a>
            @endif
        </nav>

        {{-- Info user + tombol logout --}}
        <div class="px-4 py-4 border-t border-skblue-800">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-skblue-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                    {{ strtoupper(substr($user->name ?? '?', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ $user->name ?? '-' }}</p>
                    <p class="text-[11px] text-skblue-400 truncate">{{ $isSuperAdmin ? 'Super Admin' : ($user?->role?->name ?? 'Admin') }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 text-xs font-semibold text-skblue-300 hover:text-white hover:bg-skblue-800 rounded-lg py-2 transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Content --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-skblue-100 px-6 py-4 flex items-center justify-between">
            <h1 class="font-bold text-lg text-skblue-900">@yield('title', 'Admin')</h1>
            <a href="{{ route('home') }}" target="_blank" class="text-xs font-medium text-skblue-500 hover:text-skblue-700 transition flex items-center gap-1">
                Lihat Situs
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </header>

        <main class="flex-1 p-6">
            @if(session('success'))
                <div class="mb-5 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>