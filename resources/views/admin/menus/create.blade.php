@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-[#1b3b2b] text-white flex justify-between items-center">
            <h3 class="text-lg font-semibold">Tambah Menu Baru</h3>
            <a href="{{ route('admin.menus.index') }}" class="text-sm bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded transition">Kembali</a>
        </div>

        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Kategori Menu -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori Menu</label>
                <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b] sm:text-sm border p-2">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Menu -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b] sm:text-sm border p-2" placeholder="Contoh: Kopi Susu Kayuhan">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b] sm:text-sm border p-2" placeholder="15000">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi / Resep -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi / Komposisi</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b] sm:text-sm border p-2" placeholder="Espresso, fresh milk, palm sugar...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto Produk -->
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700">Foto Produk (Maks 2MB)</label>
                <input type="file" name="photo" id="photo" accept="image/jpg,image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#1b3b2b]/10 file:text-[#1b3b2b] hover:file:bg-[#1b3b2b]/20">
                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Ketersediaan Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }} class="h-4 w-4 text-[#1b3b2b] focus:ring-[#1b3b2b] border-gray-300 rounded">
                <label for="is_available" class="ml-2 block text-sm text-gray-900">Menu Tersedia untuk Dijual</label>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.menus.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium transition">Batal</a>
                <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-md text-sm font-medium transition shadow-sm">Simpan Menu</button>
            </div>
        </form>
    </div>
</div>
@endsection