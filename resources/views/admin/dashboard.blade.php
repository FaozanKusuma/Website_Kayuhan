@extends('layouts.admin')

@section('title', 'Dashboard Utama')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Selamat Datang di Panel Admin Kayuhan Street Coffee</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola data menu, harga, presensi, serta operasional harian kedai dari satu tempat.</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2.5 rounded-lg text-sm font-medium transition shadow-sm shrink-0">
            + Tambah Menu Baru
        </a>
    </div>

    <!-- Grid Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Menu Tersedia</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalMenus ?? 24 }}</p>
            <p class="text-xs text-emerald-600 font-medium mt-1">Aktif dijual di kedai</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Karyawan / Barista</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalEmployees ?? 6 }}</p>
            <p class="text-xs text-gray-500 mt-1">Anggota aktif terdaftar</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Presensi Hari Ini</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $presentToday ?? 5 }} / {{ $totalEmployees ?? 6 }}</p>
            <p class="text-xs text-blue-600 font-medium mt-1">Barista sudah absen masuk</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Kategori Menu</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalCategories ?? 3 }}</p>
            <p class="text-xs text-gray-500 mt-1">Coffee, Non-Coffee, Snack</p>
        </div>
    </div>

    <!-- Aksi Cepat Manajemen -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-4">
        <h3 class="text-base font-bold text-gray-900">Aksi Cepat Manajemen</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.menus.index') }}" class="block p-5 rounded-lg border border-gray-200 hover:border-[#1b3b2b] hover:bg-emerald-50/30 transition group">
                <h4 class="font-bold text-gray-900 group-hover:text-[#1b3b2b] text-sm">Kelola Menu & Harga</h4>
                <p class="text-xs text-gray-500 mt-1">Tambah, ubah, atau hapus daftar produk makanan dan minuman.</p>
            </a>

            <a href="{{ Route::has('admin.payrolls.index') ? route('admin.payrolls.index') : '#' }}" class="block p-5 rounded-lg border border-gray-200 hover:border-[#1b3b2b] hover:bg-emerald-50/30 transition group">
                <h4 class="font-bold text-gray-900 group-hover:text-[#1b3b2b] text-sm">Rekap Gaji & Absensi</h4>
                <p class="text-xs text-gray-500 mt-1">Hitung gaji bulanan dan periksa potongan presensi karyawan.</p>
            </a>

            <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}" class="block p-5 rounded-lg border border-gray-200 hover:border-[#1b3b2b] hover:bg-emerald-50/30 transition group">
                <h4 class="font-bold text-gray-900 group-hover:text-[#1b3b2b] text-sm">Pengaturan Akun & Tim</h4>
                <p class="text-xs text-gray-500 mt-1">Kelola informasi profil staf, admin, serta data pemilik kedai.</p>
            </a>
        </div>
    </div>
@endsection