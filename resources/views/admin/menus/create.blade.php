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
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition">Dashboard</a>
                <a href="{{ route('admin.menus.index') }}" class="block px-4 py-2.5 rounded-lg bg-white/20 font-semibold text-amber-300 transition">Menu & Harga</a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Tim <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Lokasi & Jadwal <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Paket <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
                <a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition flex justify-between items-center">Akun Admin <span class="text-[10px] bg-amber-400 text-[#1b3b2b] px-1.5 py-0.5 rounded font-bold">Owner</span></a>
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
            <h1 class="text-lg font-semibold text-gray-800">Tambah Menu Baru</h1>
            <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-600 hover:text-[#1b3b2b] font-medium">&larr; Kembali ke Daftar Menu</a>
        </header>

        <!-- Content Body -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
            <div class="max-w-3xl bg-white p-6 md:p-8 rounded-lg shadow-sm border border-gray-200">

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Kopi Susu Aren" required
                                class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                            <select name="category_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="Contoh: 18000" min="0" required
                            class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat (Opsional)</label>
                        <textarea name="description" rows="3" placeholder="Jelaskan komposisi atau cita rasa minuman..."
                            class="w-full rounded-lg border-gray-300 focus:border-[#1b3b2b] focus:ring-[#1b3b2b] text-sm">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Produk (JPG/PNG/WebP, Maks 2MB)</label>
                        <input type="file" name="image" id="image-input" accept="image/*" required
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1b3b2b] file:text-white hover:file:bg-[#132a1e]">
                        <div class="mt-3 hidden" id="preview-container">
                            <p class="text-xs text-gray-500 mb-1">Pratinjau Foto:</p>
                            <img id="image-preview" src="#" alt="Preview" class="w-36 h-36 object-cover rounded-lg border border-gray-200">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-6 py-2 rounded-lg text-sm font-semibold transition">
                            Simpan Produk
                        </button>
                    </div>
                </form>

            </div>
        </main>
    </div>
</div>

<script>
    document.getElementById('image-input').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                document.getElementById('image-preview').src = event.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection