<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayuhan Street Coffee - Halaman Publik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navbar Publik -->
    <header class="bg-[#1b3b2b] text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="font-bold text-lg tracking-wider">KAYUHAN STREET COFFEE</div>
            <nav class="hidden md:flex space-x-6 text-sm">
                <a href="#menu" class="hover:text-amber-300 transition">Menu</a>
                <a href="#team" class="hover:text-amber-300 transition">Our Team</a>
                <a href="#location" class="hover:text-amber-300 transition">Location</a>
                <a href="#package" class="hover:text-amber-300 transition">Package</a>
            </nav>
            <div>
                <a href="{{ route('login') }}" class="bg-amber-400 hover:bg-amber-500 text-[#1b3b2b] px-4 py-2 rounded-md text-sm font-semibold transition">Login Staf</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="space-y-6">
            <h1 class="text-3xl md:text-5xl font-extrabold text-[#1b3b2b] leading-tight">Nikmati Racikan Kopi Terbaik di Setiap Perjalanan</h1>
            <p class="text-gray-600 text-base md:text-lg">Slogan usaha: Kopi nikmat, harga bersahabat, diseduh sepenuh hati untuk menemani hari-hari.</p>
            <div>
                <a href="#menu" class="inline-block bg-[#1b3b2b] hover:bg-[#132a1e] text-white font-medium px-6 py-3 rounded-lg shadow transition">Lihat Menu</a>
            </div>
        </div>
        <div class="bg-amber-100 border border-amber-200 rounded-2xl h-64 md:h-80 flex items-center justify-center text-amber-800 font-semibold shadow-inner">
            [Foto Produk Unggulan]
        </div>
    </section>

    <!-- Our Menu Section -->
    <section id="menu" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-gray-200">
        <h2 class="text-2xl font-bold text-[#1b3b2b] mb-6">Our Menu</h2>
        
        <!-- Filter Kategori -->
        <div class="flex space-x-4 mb-8">
            <button class="bg-[#1b3b2b] text-white px-5 py-2 rounded-lg font-medium text-sm shadow">Coffee</button>
            <button class="bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 px-5 py-2 rounded-lg font-medium text-sm transition">Non-Coffee</button>
        </div>

        <!-- Grid Produk Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm space-y-3">
                <div class="bg-gray-100 h-40 rounded-lg flex items-center justify-center text-gray-400 text-sm">[Foto Produk]</div>
                <h3 class="font-semibold text-gray-900 text-lg">Kopi Susu Signature</h3>
                <p class="text-emerald-700 font-bold">Rp 18.000</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm space-y-3">
                <div class="bg-gray-100 h-40 rounded-lg flex items-center justify-center text-gray-400 text-sm">[Foto Produk]</div>
                <h3 class="font-semibold text-gray-900 text-lg">Americano Classic</h3>
                <p class="text-emerald-700 font-bold">Rp 15.000</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm space-y-3">
                <div class="bg-gray-100 h-40 rounded-lg flex items-center justify-center text-gray-400 text-sm">[Foto Produk]</div>
                <h3 class="font-semibold text-gray-900 text-lg">Matcha Latte</h3>
                <p class="text-emerald-700 font-bold">Rp 20.000</p>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section id="team" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-gray-200">
        <h2 class="text-2xl font-bold text-[#1b3b2b] mb-6">Our Team</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl text-center space-y-2">
                <div class="w-20 h-20 bg-amber-200 rounded-full mx-auto flex items-center justify-center text-amber-800 text-xs">Foto</div>
                <h4 class="font-semibold text-gray-900">Barista 1</h4>
                <p class="text-xs text-gray-500">Head Barista</p>
            </div>
            <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl text-center space-y-2">
                <div class="w-20 h-20 bg-amber-200 rounded-full mx-auto flex items-center justify-center text-amber-800 text-xs">Foto</div>
                <h4 class="font-semibold text-gray-900">Barista 2</h4>
                <p class="text-xs text-gray-500">Assistant Barista</p>
            </div>
        </div>
    </section>

    <!-- Lokasi, Jadwal & Paket -->
    <section id="location" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-4">
            <h3 class="text-xl font-bold text-[#1b3b2b]">Lokasi & Jadwal</h3>
            <p class="text-sm text-gray-600">Peta lokasi operasional serta jadwal reguler dan akhir pekan.</p>
            <div class="bg-gray-100 h-48 rounded-lg flex items-center justify-center text-gray-500">[Embed Peta Lokasi]</div>
        </div>
        <div id="package" class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-4">
            <h3 class="text-xl font-bold text-[#1b3b2b]">Package Layanan</h3>
            <p class="text-sm text-gray-600">Informasi paket kemitraan atau pemesanan khusus acara.</p>
            <a href="https://wa.me/" target="_blank" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition">Hubungi via WhatsApp</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1b3b2b] text-white py-6 text-center text-sm mt-12">
        <p>&copy; 2026 Kayuhan Street Coffee. Seluruh hak cipta dilindungi.</p>
    </footer>

</body>
</html>