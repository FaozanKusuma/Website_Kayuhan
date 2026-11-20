<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayuhan Street Coffee — Grind The Everyday Essentials</title>
    
    <!-- Google Fonts: Plus Jakarta Sans (Karakteristik Tipografi Modern ala Fore Coffee) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#EDF5F1',
                            100: '#D4E8DF',
                            600: '#006041',
                            700: '#004D34',
                            800: '#133928',
                            900: '#0D281C',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-slate-800 font-sans antialiased selection:bg-brand-600 selection:text-white">

    <!-- Navbar Minimalis & Glassmorphism -->
    <header class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-full bg-brand-600 flex items-center justify-center text-white font-extrabold text-sm tracking-tighter group-hover:bg-brand-800 transition">
                    KS
                </div>
                <span class="font-extrabold text-lg tracking-tight text-brand-800">
                    KAYUHAN<span class="font-medium text-brand-600">.COFFEE</span>
                </span>
            </a>

            <!-- Navigasi Desktop -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
                <a href="#menu" class="hover:text-brand-600 transition py-1">Menu</a>
                <a href="#team" class="hover:text-brand-600 transition py-1">Our Team</a>
                <a href="#location" class="hover:text-brand-600 transition py-1">Location</a>
                <a href="#package" class="hover:text-brand-600 transition py-1">Package</a>
            </nav>

            <!-- CTA Login Staf & Mobile Toggle -->
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold shadow-sm hover:shadow transition">
                    Login Staf
                </a>
                <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-full text-slate-600 hover:bg-slate-100 focus:outline-none" aria-label="Buka Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigasi Mobile -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-slate-100 px-4 pt-2 pb-5 space-y-2">
            <a href="#menu" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-600">Menu</a>
            <a href="#team" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-600">Our Team</a>
            <a href="#location" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-600">Location</a>
            <a href="#package" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-600">Package</a>
        </div>
    </header>

    <!-- Hero Section Editorial -->
    <section class="relative overflow-hidden bg-gradient-to-b from-brand-50/70 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-24 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Konten Teks Kiri -->
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-xs font-semibold tracking-wide uppercase">
                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                    Freshly Brewed On The Street
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-[54px] font-extrabold text-brand-900 leading-[1.12] tracking-tight">
                    Nikmati Racikan Kopi Terbaik di Setiap Perjalanan.
                </h1>

                <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-xl">
                    Kopi nikmat, harga bersahabat, diseduh sepenuh hati dari biji kopi pilihan untuk menemani ritme hari-hari Anda.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#menu" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-7 py-3.5 rounded-full shadow-md shadow-brand-600/20 transition">
                        <span>Eksplor Menu</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#location" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-brand-800 border border-slate-200 font-semibold px-7 py-3.5 rounded-full transition">
                        <span>Cek Lokasi</span>
                    </a>
                </div>
            </div>

            <!-- Wadah Visual Produk Unggulan Kanan -->
            <div class="lg:col-span-6">
                <div class="relative mx-auto max-w-lg lg:max-w-none">
                    <div class="aspect-[4/3] bg-brand-50 border border-brand-100 rounded-3xl overflow-hidden shadow-xl shadow-brand-900/5 flex flex-col items-center justify-center p-8 text-center relative">
                        <!-- Ganti blok ini dengan tag <img> foto produk unggulan Anda -->
                        <div class="w-20 h-20 rounded-2xl bg-white shadow-sm flex items-center justify-center text-brand-600 mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3"/>
                            </svg>
                        </div>
                        <span class="text-brand-800 font-bold text-base">Foto Produk Unggulan</span>
                        <span class="text-slate-500 text-xs mt-1">Rekomendasi rasio foto 4:3 atau 1:1 (PNG/WebP transparan atau estetik)</span>

                        <!-- Floating Badge -->
                        <div class="absolute bottom-5 left-5 right-5 sm:right-auto bg-white/95 backdrop-blur px-4 py-3 rounded-2xl shadow-md border border-slate-100 flex items-center gap-3 text-left">
                            <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-sm">
                                100%
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Arabica & House Blend</p>
                                <p class="text-[11px] text-slate-500">Diseduh segar setiap pesanan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Menu Section -->
    <section id="menu" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Curated Drinks</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-brand-900 tracking-tight mt-1">Our Menu</h2>
            </div>

            <!-- Filter Kategori Bentuk Pill -->
            <div class="flex flex-wrap gap-2.5" id="menu-filters">
                <button type="button" data-filter="all" class="filter-btn active bg-brand-600 text-white px-5 py-2.5 rounded-full font-semibold text-sm transition">
                    Semua Menu
                </button>
                @if(isset($categories) && $categories->count())
                    @foreach($categories as $category)
                        <button type="button" data-filter="{{ strtolower($category->name) }}" class="filter-btn bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-700 px-5 py-2.5 rounded-full font-semibold text-sm transition">
                            {{ $category->name }}
                        </button>
                    @endforeach
                @else
                    <button type="button" data-filter="coffee" class="filter-btn bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-700 px-5 py-2.5 rounded-full font-semibold text-sm transition">
                        Coffee
                    </button>
                    <button type="button" data-filter="non-coffee" class="filter-btn bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-700 px-5 py-2.5 rounded-full font-semibold text-sm transition">
                        Non-Coffee
                    </button>
                @endif
            </div>
        </div>

        <!-- Grid Produk Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7" id="menu-grid">
            @if(isset($menus) && $menus->count())
                @foreach($menus as $menu)
                    <div data-category="{{ strtolower($menu->category->name ?? 'coffee') }}" class="menu-card group bg-white rounded-3xl border border-slate-100 p-4 shadow-sm hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="aspect-square bg-brand-50/60 rounded-2xl overflow-hidden mb-4 relative flex items-center justify-center">
                                @if(!empty($menu->image))
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <span class="text-brand-700/60 text-xs font-medium">[Foto {{ $menu->name }}]</span>
                                @endif
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[11px] font-semibold text-brand-700">
                                    {{ $menu->category->name ?? 'Signature' }}
                                </span>
                            </div>
                            <h3 class="font-bold text-slate-900 text-lg group-hover:text-brand-600 transition">{{ $menu->name }}</h3>
                            <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ $menu->description ?? 'Racikan spesial dengan keseimbangan rasa manis dan aroma kopi yang khas.' }}</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-brand-700 font-extrabold text-lg">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <span class="text-xs font-medium text-slate-400">Tersedia</span>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback Data Statis Sesuai File Awal -->
                <div data-category="coffee" class="menu-card group bg-white rounded-3xl border border-slate-100 p-4 shadow-sm hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="aspect-square bg-brand-50/60 rounded-2xl overflow-hidden mb-4 relative flex items-center justify-center">
                            <span class="text-brand-700/60 text-xs font-medium">[Foto Kopi Susu Signature]</span>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[11px] font-semibold text-brand-700">Coffee</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-brand-600 transition">Kopi Susu Signature</h3>
                        <p class="text-slate-500 text-sm mt-1">Perpaduan espresso house blend, susu segar creamy, dan gula aren pilihan.</p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-brand-700 font-extrabold text-lg">Rp 18.000</span>
                        <span class="text-xs font-semibold text-brand-600 bg-brand-50 px-2.5 py-1 rounded-full">Best Seller</span>
                    </div>
                </div>

                <div data-category="coffee" class="menu-card group bg-white rounded-3xl border border-slate-100 p-4 shadow-sm hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="aspect-square bg-brand-50/60 rounded-2xl overflow-hidden mb-4 relative flex items-center justify-center">
                            <span class="text-brand-700/60 text-xs font-medium">[Foto Americano Classic]</span>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[11px] font-semibold text-brand-700">Coffee</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-brand-600 transition">Americano Classic</h3>
                        <p class="text-slate-500 text-sm mt-1">Ekstraksi ganda biji kopi pilihan dengan karakter bersih dan menyegarkan.</p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-brand-700 font-extrabold text-lg">Rp 15.000</span>
                        <span class="text-xs font-medium text-slate-400">Ice / Hot</span>
                    </div>
                </div>

                <div data-category="non-coffee" class="menu-card group bg-white rounded-3xl border border-slate-100 p-4 shadow-sm hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="aspect-square bg-brand-50/60 rounded-2xl overflow-hidden mb-4 relative flex items-center justify-center">
                            <span class="text-brand-700/60 text-xs font-medium">[Foto Matcha Latte]</span>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[11px] font-semibold text-brand-700">Non-Coffee</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-brand-600 transition">Matcha Latte</h3>
                        <p class="text-slate-500 text-sm mt-1">Bubuk matcha autentik dengan susu segar yang lembut dan tidak terlalu manis.</p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-brand-700 font-extrabold text-lg">Rp 20.000</span>
                        <span class="text-xs font-medium text-slate-400">Ice / Hot</span>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Package Layanan (Full-Width Highlight Banner ala Fore Coffee) -->
    <section id="package" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-brand-800 rounded-3xl p-8 md:p-12 lg:p-14 text-white relative overflow-hidden">
            <div class="relative z-10 max-w-2xl space-y-4">
                <span class="inline-block px-3.5 py-1 rounded-full bg-white/10 text-brand-100 text-xs font-semibold tracking-wider uppercase">
                    Event & Kemitraan
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight leading-tight">
                    Hadirkan Kayuhan Street Coffee di Acara Spesial Anda
                </h2>
                <p class="text-brand-100/90 text-sm sm:text-base leading-relaxed">
                    Tersedia paket layanan kopi untuk acara kampus, komunitas, pernikahan, hingga peluang kemitraan strategis dengan dukungan penuh tim barista kami.
                </p>
                <div class="pt-2">
                    <a href="https://wa.me/" target="_blank" class="inline-flex items-center gap-2.5 bg-white text-brand-800 hover:bg-brand-50 font-bold px-6 py-3.5 rounded-full text-sm shadow-lg transition">
                        <span>Konsultasi Paket via WhatsApp</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            <!-- Ornamen Lingkaran Halus -->
            <div class="hidden md:block absolute -right-16 -bottom-24 w-80 h-80 rounded-full bg-brand-600/30 pointer-events-none"></div>
            <div class="hidden md:block absolute right-24 -top-20 w-56 h-56 rounded-full bg-brand-600/20 pointer-events-none"></div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section id="team" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Behind The Bar</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-brand-900 tracking-tight mt-1">Our Team</h2>
            <p class="text-slate-500 text-sm sm:text-base mt-2">Orang-orang di balik setiap cangkir kopi yang diracik dengan presisi.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @if(isset($teams) && $teams->count())
                @foreach($teams as $member)
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl text-center shadow-sm hover:shadow-md transition">
                        <div class="w-24 h-24 rounded-full bg-brand-50 ring-4 ring-brand-50/70 mx-auto overflow-hidden flex items-center justify-center mb-4">
                            @if(!empty($member->photo))
                                <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-brand-700 font-bold text-sm">Foto</span>
                            @endif
                        </div>
                        <h4 class="font-bold text-slate-900 text-base">{{ $member->name }}</h4>
                        <p class="text-xs font-medium text-brand-600 mt-1">{{ $member->role }}</p>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-slate-100 p-6 rounded-3xl text-center shadow-sm hover:shadow-md transition">
                    <div class="w-24 h-24 bg-brand-50 ring-4 ring-brand-50/70 rounded-full mx-auto flex items-center justify-center text-brand-700 font-semibold text-xs mb-4">Foto</div>
                    <h4 class="font-bold text-slate-900 text-base">Barista 1</h4>
                    <p class="text-xs font-medium text-brand-600 mt-1">Head Barista</p>
                </div>
                <div class="bg-white border border-slate-100 p-6 rounded-3xl text-center shadow-sm hover:shadow-md transition">
                    <div class="w-24 h-24 bg-brand-50 ring-4 ring-brand-50/70 rounded-full mx-auto flex items-center justify-center text-brand-700 font-semibold text-xs mb-4">Foto</div>
                    <h4 class="font-bold text-slate-900 text-base">Barista 2</h4>
                    <p class="text-xs font-medium text-brand-600 mt-1">Assistant Barista</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Lokasi & Jadwal Operasional -->
    <section id="location" class="bg-slate-50/80 border-t border-slate-100 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Info Jadwal -->
                <div class="lg:col-span-5 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-6">
                    <div class="space-y-3">
                        <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Find Us</span>
                        <h3 class="text-2xl md:text-3xl font-extrabold text-brand-900 tracking-tight">Lokasi & Jadwal</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Temukan titik mangkal reguler dan jadwal akhir pekan Kayuhan Street Coffee untuk menikmati kopi langsung di tempat.
                        </p>
                    </div>

                    <div class="space-y-3">
                        <div class="p-4 rounded-2xl bg-brand-50/70 border border-brand-100">
                            <p class="text-xs font-bold uppercase tracking-wider text-brand-700">Jadwal Reguler (Senin – Jumat)</p>
                            <p class="text-sm font-semibold text-slate-800 mt-1">15.00 – 22.00 WIB</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-600">Akhir Pekan (Sabtu – Minggu)</p>
                            <p class="text-sm font-semibold text-slate-800 mt-1">07.00 – 23.00 WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Embed Peta -->
                <div class="lg:col-span-7 bg-white p-4 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
                    <div class="w-full h-72 lg:h-full min-h-[300px] bg-slate-100 rounded-2xl overflow-hidden flex items-center justify-center text-slate-500 text-sm font-medium">
                        [Embed Peta Lokasi Google Maps]
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Minimalis -->
    <footer class="bg-brand-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-center md:text-left">
                <div class="font-extrabold text-lg tracking-tight">KAYUHAN STREET COFFEE</div>
                <p class="text-brand-100/70 text-xs mt-1">&copy; 2026 Kayuhan Street Coffee. Seluruh hak cipta dilindungi.</p>
            </div>
            <div class="flex space-x-6 text-sm text-brand-100/80">
                <a href="#menu" class="hover:text-white transition">Menu</a>
                <a href="#team" class="hover:text-white transition">Our Team</a>
                <a href="#location" class="hover:text-white transition">Location</a>
                <a href="#package" class="hover:text-white transition">Package</a>
            </div>
        </div>
    </footer>

    <!-- Script Interaktif: Mobile Menu & Filter Kategori -->
    <script>
        // Toggle Mobile Menu
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Filter Kategori Produk
        const filterButtons = document.querySelectorAll('.filter-btn');
        const menuCards = document.querySelectorAll('.menu-card');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const selected = btn.getAttribute('data-filter');

                filterButtons.forEach(b => {
                    b.classList.remove('bg-brand-600', 'text-white');
                    b.classList.add('bg-slate-100', 'text-slate-700');
                });
                btn.classList.remove('bg-slate-100', 'text-slate-700');
                btn.classList.add('bg-brand-600', 'text-white');

                menuCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (selected === 'all' || category === selected) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>