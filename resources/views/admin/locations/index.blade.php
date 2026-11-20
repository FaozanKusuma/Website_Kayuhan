@extends('layouts.admin')

@section('title', 'Kelola Lokasi & Jadwal')

@section('content')
@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Bagian 1: Manajemen Lokasi -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-5">
        <h2 class="text-base font-bold text-gray-900">{{ isset($location) ? 'Edit Lokasi Mangkal' : 'Tambah Lokasi Operasional' }}</h2>

        <form action="{{ isset($location) ? route('admin.locations.update', $location->id) : route('admin.locations.store') }}" method="POST" class="space-y-3">
            @csrf
            @if(isset($location)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Nama Titik / Cabang</label>
                <input type="text" name="name" value="{{ old('name', $location->name ?? '') }}" placeholder="Contoh: Kedai Pusat Kediri" required
                    class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Alamat Lengkap</label>
                <textarea name="address" rows="2" required class="w-full rounded-lg border-gray-300 text-sm">{{ old('address', $location->address ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Link / Embed Google Maps (Opsional)</label>
                <input type="text" name="maps_url" value="{{ old('maps_url', $location->maps_url ?? '') }}" placeholder="https://maps.google.com/..."
                    class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div class="flex gap-2">
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
                <div class="p-3 bg-gray-50 rounded-lg border flex items-start justify-between gap-3">
                    <div>
                        <p class="font-bold text-sm text-gray-900">{{ $loc->name }}</p>
                        <p class="text-xs text-gray-600">{{ $loc->address }}</p>
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
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-5">
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