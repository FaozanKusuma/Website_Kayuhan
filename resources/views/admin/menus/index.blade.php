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
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition">Dashboard</a>
                <a href="#" class="block px-4 py-2.5 rounded-lg bg-white/20 font-semibold text-amber-300 transition">Menu & Harga</a>
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
            <h1 class="text-lg font-semibold text-gray-800">Manajemen Panel</h1>
            <div class="flex items-center space-x-4 text-sm">
                <span class="text-gray-600">Nama pengguna (<span class="font-semibold text-gray-800">Owner/Admin</span>)</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Logout</button>
                </form>
            </div>
        </header>

        <!-- Content Body -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 space-y-6">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h2 class="text-xl font-bold text-gray-900">Kelola Menu & Harga</h2>
                <a href="{{ route('admin.menus.create') }}" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                    + Tambah menu
                </a>
            </div>

            <!-- Filter & Search Bar -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between gap-4">
                <input type="text" placeholder="Cari menu / filter kategori..." class="w-full sm:w-80 rounded-md border-gray-300 border p-2 text-sm focus:ring-[#1b3b2b] focus:border-[#1b3b2b]">
            </div>

            <!-- Table Menus -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-[#1b3b2b] text-white font-semibold text-left">
                        <tr>
                            <th class="px-6 py-3">Foto</th>
                            <th class="px-6 py-3">Nama menu</th>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        <tr>
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">[img]</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">Kopi Susu Kayuhan</td>
                            <td class="px-6 py-4">Coffee</td>
                            <td class="px-6 py-4 text-emerald-700 font-semibold">Rp 18.000</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="#" class="text-blue-600 hover:underline">Ubah</a>
                                <span class="text-gray-300">|</span>
                                <a href="#" class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">[img]</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">Americano</td>
                            <td class="px-6 py-4">Coffee</td>
                            <td class="px-6 py-4 text-emerald-700 font-semibold">Rp 15.000</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="#" class="text-blue-600 hover:underline">Ubah</a>
                                <span class="text-gray-300">|</span>
                                <a href="#" class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</div>
@endsection