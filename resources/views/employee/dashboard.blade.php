@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">
    
    <!-- Header Halaman -->
    <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Halaman Karyawan</h1>
            <p class="text-sm text-gray-600">Nama Karyawan / Barista: <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span></p>
        </div>
        <div class="text-xs sm:text-sm bg-emerald-50 text-emerald-800 px-3 py-1.5 rounded-full border border-emerald-200">
            Status: Aktif Bekerja
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Kiri: Presensi & Riwayat -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Kotak Presensi Hari Ini -->
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-lg font-medium text-gray-900">Presensi Hari Ini</h3>
                <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-md flex justify-between items-center">
                    <div>
                        <p class="text-xs text-amber-700 font-medium">Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <p class="text-sm font-semibold text-amber-900 mt-0.5">Status: Belum presensi pulang</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <button type="button" class="w-full bg-[#1b3b2b] hover:bg-[#132a1e] text-white py-2.5 px-4 rounded-md font-medium text-sm transition shadow-sm flex items-center justify-center gap-2">
                        Presensi Masuk
                    </button>
                    <button type="button" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2.5 px-4 rounded-md font-medium text-sm transition border border-gray-300 flex items-center justify-center gap-2">
                        Presensi Pulang
                    </button>
                </div>
            </div>

            <!-- Tabel Riwayat Presensi -->
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-lg font-medium text-gray-900">Riwayat Presensi</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-gray-500 font-semibold text-left">
                            <tr>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Masuk</th>
                                <th class="px-4 py-3">Pulang</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            <tr>
                                <td class="px-4 py-3">31/10/2026</td>
                                <td class="px-4 py-3">08:02</td>
                                <td class="px-4 py-3">17:00</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">30/10/2026</td>
                                <td class="px-4 py-3">08:00</td>
                                <td class="px-4 py-3">17:05</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Rincian Gaji Bulanan -->
        <div class="space-y-6">
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-6 space-y-6">
                <div class="border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-medium text-gray-900">Rincian Gaji Bulanan</h3>
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Gaji pokok:</span>
                        <span class="font-medium text-gray-900">Rp 1.200.000</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Hari potongan:</span>
                        <span class="font-medium text-gray-900">1 hari</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Potongan:</span>
                        <span class="font-medium text-red-600">Rp 40.000</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 bg-amber-50/50 -mx-6 -mb-6 p-6 rounded-b-lg">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji Bersih:</p>
                    <p class="text-2xl font-bold text-[#1b3b2b] mt-1">Rp 1.160.000</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection