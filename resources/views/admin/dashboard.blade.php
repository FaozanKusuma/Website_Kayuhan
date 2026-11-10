@extends('layouts.admin')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    <!-- Sidebar Admin -->
    <aside class="w-64 bg-[#1b3b2b] text-white hidden md:flex flex-col justify-between">
        <div>
            <div class="h-16 flex items-center px-6 font-bold text-lg border-b border-white/10">
                Panel Kayuhan
            </div>
            <nav class="p-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-lg bg-white/20 font-semibold text-amber-300 transition">Dashboard</a>
                <a href="{{ route('admin.menus.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition">Menu & Harga</a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Tim <span class="text-xs bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Lokasi & Jadwal <span class="text-xs bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Paket <span class="text-xs bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Akun Admin <span class="text-xs bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
            </nav>
        </div>
        <div class="p-4 border-t border-white/10 text-xs text-gray-300">
            Kayuhan System v1.0
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Topbar Admin -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 shadow-sm">
            <h1 class="text-lg font-semibold text-gray-800">Dashboard Utama</h1>
            <div class="flex items-center space-x-4 text-sm">
                <span class="text-gray-600">Administrator</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Logout</button>
                </form>
            </div>
        </header>

        <!-- Content Body -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Selamat Datang di Panel Admin Kayuhan Street Coffee</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola data menu, harga, presensi, serta operasional harian kedai dari satu tempat.</p>
                </div>
                <a href="{{ route('admin.menus.create') }}" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                    + Tambah Menu Baru
                </a>
            </div>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Menu -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-2">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Menu Tersedia</p>
                    <p class="text-3xl font-bold text-[#1b3b2b]">24</p>
                    <p class="text-xs text-emerald-600 font-medium">Aktif dijual di kedai</p>
                </div>

                <!-- Total Karyawan -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-2">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Karyawan / Barista</p>
                    <p class="text-3xl font-bold text-[#1b3b2b]">6</p>
                    <p class="text-xs text-gray-500">Anggota aktif terdaftar</p>
                </div>

                <!-- Presensi Hari Ini -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-2">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Presensi Hari Ini</p>
                    <p class="text-3xl font-bold text-[#1b3b2b]">5 / 6</p>
                    <p class="text-xs text-blue-600 font-medium">Barista sudah absen masuk</p>
                </div>

                <!-- Kategori Menu -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-2">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Menu</p>
                    <p class="text-3xl font-bold text-[#1b3b2b]">3</p>
                    <p class="text-xs text-gray-500">Coffee, Non-Coffee, Snack</p>
                </div>
            </div>

            <!-- Aktivitas atau Pintasan Cepat -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat Manajemen</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{ route('admin.menus.index') }}" class="p-4 rounded-lg border border-gray-200 hover:border-[#1b3b2b] hover:bg-gray-50 transition space-y-1 block">
                        <h4 class="font-semibold text-[#1b3b2b]">Kelola Menu & Harga</h4>
                        <p class="text-xs text-gray-500">Tambah, ubah, atau hapus daftar produk makanan dan minuman.</p>
                    </a>
                    <div class="p-4 rounded-lg border border-gray-200 hover:border-[#1b3b2b] hover:bg-gray-50 transition space-y-1 cursor-pointer">
                        <h4 class="font-semibold text-[#1b3b2b]">Rekap Gaji & Absensi</h4>
                        <p class="text-xs text-gray-500">Hitung gaji bulanan dan periksa potongan presensi karyawan.</p>
                    </div>
                    <div class="p-4 rounded-lg border border-gray-200 hover:border-[#1b3b2b] hover:bg-gray-50 transition space-y-1 cursor-pointer">
                        <h4 class="font-semibold text-[#1b3b2b]">Pengaturan Akun & Tim</h4>
                        <p class="text-xs text-gray-500">Kelola informasi profil staf, admin, serta data pemilik kedai.</p>
                    </div>
                </div>
            </div>

        </main>
    </div>

</div>
@endsection