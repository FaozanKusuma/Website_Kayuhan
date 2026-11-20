<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Admin') - Kayuhan Street Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-800">

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Desktop -->
    <aside class="w-64 bg-[#1b3b2b] text-white hidden md:flex flex-col justify-between shrink-0">
        <div>
            <div class="h-16 flex items-center px-6 font-bold text-lg border-b border-white/10 tracking-wide">
                Panel Kayuhan
            </div>
            <nav class="p-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') || request()->routeIs('dashboard') ? 'bg-white/20 font-semibold text-amber-300' : 'hover:bg-white/10' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.menus.index') }}"
                   class="block px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.menus.*') ? 'bg-white/20 font-semibold text-amber-300' : 'hover:bg-white/10' }}">
                    Menu & Harga
                </a>

                <a href="{{ Route::has('admin.teams.index') ? route('admin.teams.index') : '#' }}"
                   class="px-4 py-2.5 rounded-lg transition flex justify-between items-center {{ request()->routeIs('admin.teams.*') ? 'bg-white/20 font-semibold text-amber-300' : 'hover:bg-white/10' }}">
                    <span>Tim</span>
                    <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span>
                </a>

                <a href="{{ Route::has('admin.locations.index') ? route('admin.locations.index') : '#' }}"
                   class="px-4 py-2.5 rounded-lg transition flex justify-between items-center {{ request()->routeIs('admin.locations.*') ? 'bg-white/20 font-semibold text-amber-300' : 'hover:bg-white/10' }}">
                    <span>Lokasi & Jadwal</span>
                    <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span>
                </a>

                <a href="{{ Route::has('admin.packages.index') ? route('admin.packages.index') : '#' }}"
                   class="px-4 py-2.5 rounded-lg transition flex justify-between items-center {{ request()->routeIs('admin.packages.*') ? 'bg-white/20 font-semibold text-amber-300' : 'hover:bg-white/10' }}">
                    <span>Paket</span>
                    <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span>
                </a>

                <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                   class="px-4 py-2.5 rounded-lg transition flex justify-between items-center {{ request()->routeIs('admin.users.*') ? 'bg-white/20 font-semibold text-amber-300' : 'hover:bg-white/10' }}">
                    <span>Akun Admin</span>
                    <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-white/10 text-xs text-gray-300 flex items-center justify-between">
            <span>Kayuhan System v1.0</span>
            <a href="{{ url('/') }}" target="_blank" class="text-amber-300 hover:underline">Lihat Web &nearr;</a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Topbar Admin -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 shadow-sm shrink-0">
            <div class="flex items-center gap-3">
                <button id="admin-mobile-btn" type="button" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard Utama')</h1>
            </div>

            <div class="flex items-center space-x-4 text-sm">
                <span class="text-gray-600 font-medium">{{ Auth::user()->name ?? 'Administrator' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">Logout</button>
                </form>
            </div>
        </header>

        <!-- Navigasi Mobile Dropdown -->
        <div id="admin-mobile-menu" class="hidden md:hidden bg-[#1b3b2b] text-white px-4 py-3 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-white/10">Dashboard</a>
            <a href="{{ route('admin.menus.index') }}" class="block px-3 py-2 rounded-lg hover:bg-white/10">Menu & Harga</a>
            <a href="{{ Route::has('admin.teams.index') ? route('admin.teams.index') : '#' }}" class="block px-3 py-2 rounded-lg hover:bg-white/10">Tim</a>
            <a href="{{ Route::has('admin.locations.index') ? route('admin.locations.index') : '#' }}" class="block px-3 py-2 rounded-lg hover:bg-white/10">Lokasi & Jadwal</a>
            <a href="{{ Route::has('admin.packages.index') ? route('admin.packages.index') : '#' }}" class="block px-3 py-2 rounded-lg hover:bg-white/10">Paket</a>
            <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}" class="block px-3 py-2 rounded-lg hover:bg-white/10">Akun Admin</a>
        </div>

        <!-- Content Body -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 space-y-6">
            @yield('content')
        </main>

    </div>
</div>

<script>
    const adminMobileBtn = document.getElementById('admin-mobile-btn');
    const adminMobileMenu = document.getElementById('admin-mobile-menu');
    if (adminMobileBtn && adminMobileMenu) {
        adminMobileBtn.addEventListener('click', () => {
            adminMobileMenu.classList.toggle('hidden');
        });
    }
</script>

</body>
</html>