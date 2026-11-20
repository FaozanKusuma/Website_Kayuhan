@extends('layouts.admin')

@section('title', 'Pengaturan Akun Admin & Staf')

@section('content')
@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">{{ session('error') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Form Tambah / Edit Akun -->
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
        <h2 class="text-base font-bold text-gray-900 mb-4">
            {{ isset($user) ? 'Edit Akun Staf/Admin' : 'Tambah Akun Baru' }}
        </h2>

        <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Email Login</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Role / Hak Akses</label>
                <select name="role" class="w-full rounded-lg border-gray-300 text-sm">
                    <option value="owner" {{ old('role', $user->role ?? '') == 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="employee" {{ old('role', $user->role ?? '') == 'employee' ? 'selected' : '' }}>Barista / Karyawan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">
                    Password {{ isset($user) ? '(Kosongkan jika tetap)' : '' }}
                </label>
                <input type="password" name="password" {{ isset($user) ? '' : 'required' }} class="w-full rounded-lg border-gray-300 text-sm">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-semibold w-full">
                    {{ isset($user) ? 'Perbarui Akun' : 'Buat Akun' }}
                </button>
                @if(isset($user))
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-sm">Batal</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Akun -->
    <div class="lg:col-span-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-200">
            <h3 class="font-bold text-gray-900">Daftar Akun Pengguna Sistem</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="py-3 px-5">Nama</th>
                        <th class="py-3 px-5">Email</th>
                        <th class="py-3 px-5">Role</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $usr)
                        <tr>
                            <td class="py-3 px-5 font-semibold text-gray-900">{{ $usr->name }}</td>
                            <td class="py-3 px-5 text-gray-600">{{ $usr->email }}</td>
                            <td class="py-3 px-5">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase bg-amber-100 text-amber-800">
                                    {{ $usr->role ?? 'staff' }}
                                </span>
                            </td>
                            <td class="py-3 px-5 text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $usr->id) }}" class="bg-amber-400 text-[#1b3b2b] px-3 py-1 rounded text-xs font-semibold">Edit</a>
                                @if ($usr->id !== Auth::id())
                                    <form action="{{ route('admin.users.destroy', $usr->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus akun ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection