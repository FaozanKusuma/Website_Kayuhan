@extends('layouts.admin')

@section('title', 'Kelola Menu & Harga')

@section('content')
    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 font-bold">&times;</button>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Daftar Produk Minuman & Makanan</h2>
            <p class="text-sm text-gray-600 mt-1">Atur foto produk, kategori, deskripsi, dan harga yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
            + Tambah Menu Baru
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold uppercase tracking-wider text-gray-600">
                        <th class="py-3.5 px-6">Foto</th>
                        <th class="py-3.5 px-6">Nama Menu</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Harga</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse ($menus as $menu)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3.5 px-6">
                                @if ($menu->image_url)
                                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-14 h-14 object-cover rounded-lg border border-gray-200">
                                @else
                                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                @endif
                            </td>
                            <td class="py-3.5 px-6">
                                <div class="font-semibold text-gray-900">{{ $menu->name }}</div>
                                <div class="text-xs text-gray-500 line-clamp-1 max-w-xs">{{ $menu->description ?? '-' }}</div>
                            </td>
                            <td class="py-3.5 px-6">
                                <span class="inline-block bg-emerald-50 text-[#1b3b2b] border border-emerald-200 text-xs font-semibold px-2.5 py-1 rounded-full">
                                    {{ $menu->category->name ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-6 font-bold text-gray-800">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-6 text-right space-x-2">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="inline-block bg-amber-400 hover:bg-amber-500 text-[#1b3b2b] font-semibold px-3 py-1.5 rounded-md text-xs transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1.5 rounded-md text-xs transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 px-6 text-center text-gray-500">
                                Belum ada data menu. Klik tombol <strong>+ Tambah Menu Baru</strong> untuk mulai menambahkan produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection