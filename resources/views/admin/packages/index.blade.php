@extends('layouts.admin')

@section('title', 'Kelola Paket Layanan')

@section('content')
@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Form Tambah / Edit Paket -->
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
        <h2 class="text-base font-bold text-gray-900 mb-4">
            {{ isset($package) ? 'Edit Paket Layanan' : 'Tambah Paket Baru' }}
        </h2>

        <form action="{{ isset($package) ? route('admin.packages.update', $package->id) : route('admin.packages.store') }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($package)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Nama Paket</label>
                <input type="text" name="name" value="{{ old('name', $package->name ?? '') }}" placeholder="Contoh: Paket Event 50 Cup" required
                    class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Harga Paket (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $package->price ?? '') }}" min="0" required
                    class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Keterangan / Fasilitas</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 text-sm">{{ old('description', $package->description ?? '') }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-semibold w-full">
                    {{ isset($package) ? 'Simpan Perubahan' : 'Simpan Paket' }}
                </button>
                @if(isset($package))
                    <a href="{{ route('admin.packages.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-sm">Batal</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Paket -->
    <div class="lg:col-span-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-200">
            <h3 class="font-bold text-gray-900">Daftar Paket Acara & Kemitraan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="py-3 px-5">Nama Paket</th>
                        <th class="py-3 px-5">Harga</th>
                        <th class="py-3 px-5">Deskripsi</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($packages as $pkg)
                        <tr>
                            <td class="py-3 px-5 font-semibold text-gray-900">{{ $pkg->name }}</td>
                            <td class="py-3 px-5 font-bold text-emerald-700">Rp {{ number_format($pkg->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-5 text-xs text-gray-600 max-w-xs">{{ $pkg->description ?? '-' }}</td>
                            <td class="py-3 px-5 text-right space-x-2">
                                <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="bg-amber-400 text-[#1b3b2b] px-3 py-1 rounded text-xs font-semibold">Edit</a>
                                <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus paket ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-8 text-center text-gray-500">Belum ada data paket layanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection