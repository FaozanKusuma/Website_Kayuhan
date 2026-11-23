@extends('layouts.admin')

@section('title', 'Kelola Tim & Barista')

@section('content')
@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Form Tambah / Edit Tim -->
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
        <h2 class="text-base font-bold text-gray-900 mb-4">
            {{ isset($team) ? 'Edit Anggota Tim' : 'Tambah Anggota Tim' }}
        </h2>

        <form action="{{ isset($team) ? route('admin.teams.update', $team->id) : route('admin.teams.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @if(isset($team)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $team->name ?? '') }}" required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b]">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Jabatan / Peran</label>
                <input type="text" name="role" value="{{ old('role', $team->role ?? '') }}" placeholder="Contoh: Head Barista" required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b]">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Foto Profil</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-[#1b3b2b] file:text-white">
                @if(isset($team) && $team->photo_url)
                    <img src="{{ $team->photo_url }}" alt="{{ $team->name }}" class="w-16 h-16 rounded-full object-cover border mt-3">
                @endif
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-semibold transition w-full">
                    {{ isset($team) ? 'Simpan Perubahan' : 'Tambah Anggota' }}
                </button>
                @if(isset($team))
                    <a href="{{ route('admin.teams.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-600">Batal</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Tim -->
    <div class="lg:col-span-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-200">
            <h3 class="font-bold text-gray-900">Daftar Tim Kayuhan Street Coffee</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="py-3 px-5">Foto</th>
                        <th class="py-3 px-5">Nama</th>
                        <th class="py-3 px-5">Jabatan</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($teams as $member)
                        <tr>
                            <td class="py-3 px-5">
                                @if ($member->photo_url)
                                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-11 h-11 rounded-full object-cover border">
                                @else
                                    <div class="w-11 h-11 rounded-full bg-emerald-50 text-[#1b3b2b] flex items-center justify-center font-bold text-xs">
                                        {{ substr($member->name, 0, 2) }}
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-5 font-semibold text-gray-900">{{ $member->name }}</td>
                            <td class="py-3 px-5 text-gray-600">{{ $member->role }}</td>
                            <td class="py-3 px-5 text-right space-x-2">
                                <a href="{{ route('admin.teams.edit', $member->id) }}" class="bg-amber-400 text-[#1b3b2b] px-3 py-1 rounded text-xs font-semibold">Edit</a>
                                <form action="{{ route('admin.teams.destroy', $member->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus anggota tim ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-8 text-center text-gray-500">Belum ada data tim.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection