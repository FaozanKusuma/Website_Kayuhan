@extends('layouts.admin')

@section('title', 'Kelola Lokasi, Jadwal & WhatsApp')

@section('content')
@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Bagian 1: Manajemen Lokasi & WhatsApp -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-5">
        <h2 class="text-base font-bold text-gray-900">
            {{ isset($location) ? 'Edit Lokasi & Kontak' : 'Tambah Lokasi & WhatsApp' }}
        </h2>

        <form action="{{ isset($location) ? route('admin.locations.update', $location->id) : route('admin.locations.store') }}" method="POST" class="space-y-3">
            @csrf
            @if(isset($location)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Nama Titik / Cabang</label>
                <input type="text" name="name" value="{{ old('name', $location->name ?? '') }}" placeholder="Contoh: Kayuhan Street Coffee - Kediri" required
                    class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Alamat Lengkap</label>
                <textarea name="address" rows="2" placeholder="Contoh: Jl. Dhoho No. 45, Kota Kediri, Jawa Timur" required
                    class="w-full rounded-lg border-gray-300 text-sm">{{ old('address', $location->address ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Nomor WhatsApp Admin</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $location->whatsapp ?? '') }}" placeholder="Contoh: 081234567890"
                    class="w-full rounded-lg border-gray-300 text-sm">
                <p class="text-[11px] text-gray-500 mt-1">Gunakan awalan 08 atau 628. Otomatis terhubung ke tombol konsultasi paket & kontak.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Link Google Maps / Kode Embed Iframe</label>
                <input type="text" name="maps_url" value="{{ old('maps_url', $location->maps_url ?? '') }}" placeholder="Tempel link Google Maps atau kode <iframe...>"
                    class="w-full rounded-lg border-gray-300 text-sm">
                <p class="text-[11px] text-gray-500 mt-1">Bisa diisi link share Google Maps biasa maupun URL embed.</p>
            </div>

            <div class="flex gap-2 pt-1">
                <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-semibold">
                    {{ isset($location) ? 'Perbarui Lokasi' : 'Simpan Lokasi' }}
                </button>
                @if(isset($location))
                    <a href="{{ route('admin.locations.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-sm">Batal</a>
                @endif
            </div>
        </form>

        <div class="border-t pt-4 space-y-2">
            @forelse ($locations as $loc)
                <div class="p-3.5 bg-gray-50 rounded-lg border flex items-start justify-between gap-3">
                    <div class="space-y-1">
                        <p class="font-bold text-sm text-gray-900">{{ $loc->name }}</p>
                        <p class="text-xs text-gray-600">{{ $loc->address }}</p>
                        @if(!empty($loc->whatsapp))
                            <p class="text-xs font-semibold text-emerald-700">WA: +{{ $loc->whatsapp }}</p>
                        @endif
                    </div>
                    <div class="flex gap-1.5 shrink-0">
                        <a href="{{ route('admin.locations.edit', $loc->id) }}" class="bg-amber-400 text-[#1b3b2b] px-2.5 py-1 rounded text-xs font-semibold">Edit</a>
                        <form action="{{ route('admin.locations.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Hapus lokasi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-2.5 py-1 rounded text-xs font-semibold">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-xs text-gray-500">Belum ada lokasi tersimpan.</p>
            @endforelse
        </div>
    </div>

    <!-- Bagian 2: Manajemen Jadwal Operasional -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-5 h-fit">
        <h2 class="text-base font-bold text-gray-900">Jadwal Operasional Kedai</h2>

        <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Hari Operasional</label>
                <input type="text" name="day" placeholder="Contoh: Senin - Jumat" required class="w-full rounded-lg border-gray-300 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Jam Buka - Tutup</label>
                <input type="text" name="hours" placeholder="Contoh: 15.00 - 22.00 WIB" required class="w-full rounded-lg border-gray-300 text-sm">
            </div>
            <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-semibold">
                + Tambah Jadwal
            </button>
        </form>

        <div class="border-t pt-4 space-y-2">
            @forelse ($schedules as $sch)
                <div class="p-3 bg-emerald-50/50 rounded-lg border border-emerald-100 flex items-center justify-between">
                    <div>
                        <p class="font-bold text-sm text-[#1b3b2b]">{{ $sch->day }}</p>
                        <p class="text-xs text-gray-700">{{ $sch->hours }}</p>
                    </div>
                    <form action="{{ route('admin.schedules.destroy', $sch->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2.5 py-1 rounded text-xs font-semibold">Hapus</button>
                    </form>
                </div>
            @empty
                <p class="text-xs text-gray-500">Belum ada jadwal operasional.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection