<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayuhan Street Coffee — Grind The Everyday Essentials</title>

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

    @php
        use Illuminate\Support\Str;

        // Ambil lokasi utama dari database untuk kontak WhatsApp & Google Maps
        $primaryLocation = (isset($locations) && $locations->count()) ? $locations->first() : null;

        // Normalisasi nomor WhatsApp (08... -> 628...)
        $rawWa = ($primaryLocation && !empty($primaryLocation->whatsapp))
            ? $primaryLocation->whatsapp
            : '6287724390512';
        $waNumber = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $rawWa));

        $waPackageUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode('Halo Kayuhan Street Coffee, saya tertarik untuk konsultasi paket acara / kemitraan.');
        $waGeneralUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode('Halo Kayuhan Street Coffee, saya ingin bertanya mengenai menu dan lokasi kedai hari ini.');

        // Penyiapan URL Google Maps (Embed Iframe & Tombol Buka Maps)
        $locationQuery = ($primaryLocation->name ?? 'Kayuhan Street Coffee') . ' ' . ($primaryLocation->address ?? 'Kediri');
        $embedMapUrl   = 'https://maps.google.com/maps?q=' . urlencode($locationQuery) . '&t=&z=15&ie=UTF8&iwloc=&output=embed';
        $directMapUrl  = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($locationQuery);

        $rawMap = $primaryLocation->maps_url ?? '';
        if (!empty($rawMap)) {
            if (preg_match('/src="([^"]+)"/', $rawMap, $matches)) {
                $embedMapUrl  = $matches[1];
                $directMapUrl = $matches[1];
            } elseif (str_contains($rawMap, '/maps/embed') || str_contains($rawMap, 'output=embed')) {
                $embedMapUrl  = $rawMap;
                $directMapUrl = $rawMap;
            } elseif (str_starts_with($rawMap, 'http')) {
                $directMapUrl = $rawMap;
            }
        }
    @endphp

    <!-- Navbar Minimalis & Glassmorphism -->
    <header class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <img src="{{ asset('images/foto_menu/kayuhan.png') }}" alt="Logo Kayuhan" class="w-10 h-10 rounded-full object-cover border border-brand-100">
                <span class="font-extrabold text-lg tracking-tight text-brand-800">
                    KAYUHAN<span class="font-medium text-brand-600">.COFFEE</span>
                </span>
            </a>

            <!-- Navigasi Desktop -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
                <a href="#menu" class="hover:text-brand-600 transition py-1">Menu</a>
                <a href="#package" class="hover:text-brand-600 transition py-1">Package</a>
                <a href="#team" class="hover:text-brand-600 transition py-1">Our Team</a>
                <a href="#location" class="hover:text-brand-600 transition py-1">Location</a>
            </nav>

            <!-- CTA Login Staf & Mobile Toggle -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold shadow-sm hover:shadow transition">
                        Panel Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold shadow-sm hover:shadow transition">
                        Login Staf
                    </a>
                @endauth

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
            <a href="#package" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-600">Package</a>
            <a href="#team" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-600">Our Team</a>
            <a href="#location" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-600">Location</a>
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

            <!-- Foto Produk Unggulan Kanan -->
            <div class="lg:col-span-6">
                <div class="relative mx-auto max-w-lg lg:max-w-none">
                    <div class="aspect-[4/3] bg-brand-50 border border-brand-100 rounded-3xl overflow-hidden shadow-xl shadow-brand-900/5 relative">
                        @if(isset($menus) && $menus->first() && $menus->first()->image_url)
                            <img src="{{ $menus->first()->image_url }}" alt="{{ $menus->first()->name }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/foto_menu/kayuhan_signature.jpeg') }}" alt="Kayuhan Signature Coffee" class="w-full h-full object-cover">
                        @endif

                        <!-- Floating Badge -->
                        <div class="absolute bottom-5 left-5 right-5 sm:right-auto bg-white/95 backdrop-blur px-4 py-3 rounded-2xl shadow-md border border-slate-100 flex items-center gap-3 text-left">
                            <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-sm">
                                100%
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">
                                    {{ (isset($menus) && $menus->first()) ? $menus->first()->name : 'Kayuhan Signature Blend' }}
                                </p>
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

            <!-- Filter Kategori -->
            <div class="flex flex-wrap gap-2.5" id="menu-filters">
                <button type="button" data-filter="all" class="filter-btn active bg-brand-600 text-white px-5 py-2.5 rounded-full font-semibold text-sm transition">
                    Semua Menu
                </button>
                @if(isset($categories) && $categories->count())
                    @foreach($categories as $category)
                        <button type="button" data-filter="{{ Str::slug($category->name) }}" class="filter-btn bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-700 px-5 py-2.5 rounded-full font-semibold text-sm transition">
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
                    <div data-category="{{ Str::slug($menu->category->name ?? 'coffee') }}" class="menu-card group bg-white rounded-3xl border border-slate-100 p-4 shadow-sm hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="aspect-square bg-brand-50/60 rounded-2xl overflow-hidden mb-4 relative flex items-center justify-center">
                                @if($menu->image_url)
                                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <img src="{{ asset('images/foto_menu/kayuhan.png') }}" alt="{{ $menu->name }}" class="w-24 h-24 object-contain opacity-60">
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
                            <span class="text-xs font-medium text-slate-400">Ice / Hot</span>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback Katalog dari public/images/foto_menu/ -->
                @php
                    $defaultMenus = [
                        ['name' => 'Kayuhan Signature', 'cat' => 'coffee', 'label' => 'Coffee', 'price' => 18000, 'img' => 'kayuhan_signature.jpeg', 'desc' => 'Racikan kopi susu andalan Kayuhan dengan tekstur creamy dan aroma khas.'],
                        ['name' => 'Kopi Susu Gula Aren', 'cat' => 'coffee', 'label' => 'Coffee', 'price' => 17000, 'img' => 'kopi_susu_gula_aren.jpeg', 'desc' => 'Perpaduan espresso house blend, susu segar, dan manis legit gula aren asli.'],
                        ['name' => 'Americano', 'cat' => 'coffee', 'label' => 'Coffee', 'price' => 14000, 'img' => 'americano.jpeg', 'desc' => 'Ekstraksi biji kopi pilihan dengan karakter bersih dan menyegarkan.'],
                        ['name' => 'Pandan Latte', 'cat' => 'coffee', 'label' => 'Coffee', 'price' => 18000, 'img' => 'pandan_latte.jpeg', 'desc' => 'Kopi susu lembut dengan sentuhan aroma pandan harum yang menenangkan.'],
                        ['name' => 'Matcha Latte', 'cat' => 'non-coffee', 'label' => 'Non-Coffee', 'price' => 18000, 'img' => 'matcha_latte.jpeg', 'desc' => 'Bubuk matcha autentik dengan susu segar yang lembut dan seimbang.'],
                        ['name' => 'Chocolate Caramel', 'cat' => 'non-coffee', 'label' => 'Non-Coffee', 'price' => 19000, 'img' => 'chocolate_caramel.jpeg', 'desc' => 'Cokelat pekat berpadu saus karamel manis dan susu segar pilihan.'],
                    ];
                @endphp

                @foreach($defaultMenus as $item)
                    <div data-category="{{ $item['cat'] }}" class="menu-card group bg-white rounded-3xl border border-slate-100 p-4 shadow-sm hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="aspect-square bg-brand-50/60 rounded-2xl overflow-hidden mb-4 relative flex items-center justify-center">
                                <img src="{{ asset('images/foto_menu/' . $item['img']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[11px] font-semibold text-brand-700">{{ $item['label'] }}</span>
                            </div>
                            <h3 class="font-bold text-slate-900 text-lg group-hover:text-brand-600 transition">{{ $item['name'] }}</h3>
                            <p class="text-slate-500 text-sm mt-1">{{ $item['desc'] }}</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-brand-700 font-extrabold text-lg">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                            <span class="text-xs font-medium text-slate-400">Ice / Hot</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <!-- Package Layanan -->
    <section id="package" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-brand-800 rounded-3xl p-8 md:p-12 lg:p-14 text-white relative overflow-hidden">
            <div class="relative z-10 max-w-3xl space-y-5">
                <span class="inline-block px-3.5 py-1 rounded-full bg-white/10 text-brand-100 text-xs font-semibold tracking-wider uppercase">
                    Event & Kemitraan
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight leading-tight">
                    Hadirkan Kayuhan Street Coffee di Acara Spesial Anda
                </h2>
                <p class="text-brand-100/90 text-sm sm:text-base leading-relaxed">
                    Tersedia paket layanan kopi untuk acara kampus, komunitas, pernikahan, hingga peluang kemitraan strategis dengan dukungan penuh tim barista kami.
                </p>

                <!-- Daftar Paket Dinamis dari Admin -->
                @if(isset($packages) && $packages->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        @foreach($packages as $pkg)
                            <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-2xl p-5 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-start justify-between gap-2">
                                        <h3 class="font-bold text-white text-base">{{ $pkg->name }}</h3>
                                        <span class="text-xs font-extrabold bg-amber-400 text-brand-900 px-3 py-1 rounded-full shrink-0">
                                            Rp {{ number_format($pkg->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    @if($pkg->description)
                                        <p class="text-xs text-brand-100/85 mt-2 leading-relaxed">{{ $pkg->description }}</p>
                                    @endif
                                </div>
                                <div class="mt-4 pt-3 border-t border-white/10">
                                    <a href="{{ 'https://wa.me/' . $waNumber . '?text=' . urlencode('Halo Kayuhan Street Coffee, saya ingin memesan ' . $pkg->name . '.') }}"
                                       target="_blank" rel="noopener noreferrer"
                                       class="text-xs font-semibold text-amber-300 hover:text-amber-200 inline-flex items-center gap-1">
                                        Pesan Paket Ini &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="pt-2">
                    <a href="{{ $waPackageUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2.5 bg-white text-brand-800 hover:bg-brand-50 font-bold px-6 py-3.5 rounded-full text-sm shadow-lg transition">
                        <span>Konsultasi Paket via WhatsApp</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
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
                            @if($member->photo_url)
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/foto_karyawan/owner.jpeg') }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <h4 class="font-bold text-slate-900 text-base">{{ $member->name }}</h4>
                        <p class="text-xs font-medium text-brand-600 mt-1">{{ $member->role }}</p>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-slate-100 p-6 rounded-3xl text-center shadow-sm hover:shadow-md transition">
                    <div class="w-24 h-24 bg-brand-50 ring-4 ring-brand-50/70 rounded-full mx-auto overflow-hidden mb-4">
                        <img src="{{ asset('images/foto_karyawan/owner.jpeg') }}" alt="Owner & Head Barista" class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-bold text-slate-900 text-base">Owner Kayuhan</h4>
                    <p class="text-xs font-medium text-brand-600 mt-1">Founder & Head Barista</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Lokasi & Jadwal Operasional -->
    <section id="location" class="bg-slate-50/80 border-t border-slate-100 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Kolom Info Lokasi, Jadwal & Tombol Aksi -->
                <div class="lg:col-span-5 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Find Us</span>
                            <h3 class="text-2xl md:text-3xl font-extrabold text-brand-900 tracking-tight mt-1">Lokasi & Jadwal</h3>
                        </div>

                        <!-- Alamat dari Admin -->
                        @if(isset($locations) && $locations->count())
                            <div class="space-y-2.5">
                                @foreach($locations as $loc)
                                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                                        <p class="font-bold text-sm text-brand-900">{{ $loc->name }}</p>
                                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $loc->address }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                                <p class="font-bold text-sm text-brand-900">Kayuhan Street Coffee — Kediri</p>
                                <p class="text-xs text-slate-600 mt-1 leading-relaxed">Kota Kediri, Jawa Timur (Atur alamat lengkap melalui Panel Admin).</p>
                            </div>
                        @endif

                        <!-- Jadwal Operasional -->
                        <div class="space-y-2.5">
                            @if(isset($schedules) && $schedules->count())
                                @foreach($schedules as $sch)
                                    <div class="p-4 rounded-2xl bg-brand-50/70 border border-brand-100">
                                        <p class="text-xs font-bold uppercase tracking-wider text-brand-700">{{ $sch->day }}</p>
                                        <p class="text-sm font-semibold text-slate-800 mt-1">{{ $sch->hours }}</p>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-4 rounded-2xl bg-brand-50/70 border border-brand-100">
                                    <p class="text-xs font-bold uppercase tracking-wider text-brand-700">Jadwal Reguler (Senin – Jumat)</p>
                                    <p class="text-sm font-semibold text-slate-800 mt-1">15.00 – 22.00 WIB</p>
                                </div>
                                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-600">Akhir Pekan (Sabtu – Minggu)</p>
                                    <p class="text-sm font-semibold text-slate-800 mt-1">07.00 – 23.00 WIB</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Peta & WhatsApp -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <a href="{{ $directMapUrl }}" target="_blank" rel="noopener noreferrer"
                           class="flex-1 text-center bg-brand-600 hover:bg-brand-700 text-white font-semibold px-4 py-3 rounded-full text-xs sm:text-sm transition">
                            Buka Google Maps
                        </a>
                        <a href="{{ $waGeneralUrl }}" target="_blank" rel="noopener noreferrer"
                           class="flex-1 text-center bg-emerald-50 hover:bg-emerald-100 text-brand-800 border border-brand-200 font-semibold px-4 py-3 rounded-full text-xs sm:text-sm transition">
                            Chat WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Kolom Embed Peta Google Maps -->
                <div class="lg:col-span-7 bg-white p-3 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
                    <iframe
                        src="{{ $embedMapUrl }}"
                        class="w-full h-80 lg:h-full min-h-[340px] rounded-2xl border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3 text-center md:text-left">
                <img src="{{ asset('images/foto_menu/kayuhan.png') }}" alt="Logo Kayuhan" class="w-9 h-9 rounded-full object-cover border border-white/20 hidden sm:block">
                <div>
                    <div class="font-extrabold text-lg tracking-tight">KAYUHAN STREET COFFEE</div>
                    <p class="text-brand-100/70 text-xs mt-0.5">&copy; 2026 Kayuhan Street Coffee. Seluruh hak cipta dilindungi.</p>
                </div>
            </div>
            <div class="flex flex-wrap justify-center gap-6 text-sm text-brand-100/80">
                <a href="#menu" class="hover:text-white transition">Menu</a>
                <a href="#package" class="hover:text-white transition">Package</a>
                <a href="#team" class="hover:text-white transition">Our Team</a>
                <a href="#location" class="hover:text-white transition">Location</a>
                <a href="{{ $waGeneralUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-amber-300 transition">WhatsApp</a>
            </div>
        </div>
    </footer>

    <script>
        // Toggle Menu Mobile
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        }

        // Filter Kategori Menu Interaktif
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