@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
    <div class="max-w-3xl bg-white p-6 md:p-8 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">Edit Produk: {{ $menu->name }}</h2>
            <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-600 hover:text-[#1b3b2b] font-medium">&larr; Kembali</a>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $menu->name) }}" required
                        class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                    <select name="category_id" required
                        class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $menu->price) }}" min="0" required
                    class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">{{ old('description', $menu->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ganti Foto Produk (Kosongkan jika tidak ingin mengganti)</label>
                <input type="file" name="image" id="image-input-edit" accept="image/*"
                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1b3b2b] file:text-white hover:file:bg-[#132a1e]">

                <div class="mt-3 flex items-center gap-6">
                    @if ($menu->image)
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <div class="hidden" id="preview-container-edit">
                        <p class="text-xs text-emerald-700 font-medium mb-1">Foto Baru:</p>
                        <img id="image-preview-edit" src="#" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-emerald-300">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-6 py-2 rounded-lg text-sm font-semibold transition">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image-input-edit').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('image-preview-edit').src = event.target.result;
                    document.getElementById('preview-container-edit').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection