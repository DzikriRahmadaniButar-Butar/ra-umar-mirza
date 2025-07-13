<!DOCTYPE html>
<html lang="id">
<head>
    @php
        use App\Models\AcademicYear;
        $activeYearId = \App\Helpers\SettingHelper::get('default_academic_year_id');
        $activeYearName = AcademicYear::find($activeYearId)?->year ?? '-';
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RA UMAR MIRZA</title>

    <meta name="description" content="@yield('description', 'RA Umar Mirza - Pendidikan Anak Usia Dini Berkualitas')">
    <meta name="keywords" content="@yield('keywords', 'RA, TK, PAUD, Pendidikan Anak, Medan')">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #1e40af, #166534);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        .header-solid {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-green-50 text-gray-800 min-h-screen">
    <!-- Header -->
    <header class="w-full bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <!-- Mobile Layout -->
            <div class="flex items-center justify-between md:hidden">
                <!-- Logo & Title (Mobile) -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 flex-shrink-0">
                        <img src="/images/logo.png" alt="Logo" class="logo w-full h-full object-contain">
                    </div>
                    <div class="min-w-0 flex-1">
                        <h1 class="text-sm font-bold gradient-text truncate">RA UMAR MIRZA</h1>
                        <p class="text-xs text-gray-600 truncate">PAUD</p>
                    </div>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Desktop Layout -->
            <div class="hidden md:flex items-center justify-between">
                <!-- Logo (Desktop) -->
                <div class="flex items-center space-x-3">
                    <div class="w-16">
                        <img src="/images/logo.png" alt="Logo" class="logo w-full h-auto">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold gradient-text">RA UMAR MIRZA</h1>
                        <p class="text-sm text-gray-600">Pendidikan Anak Usia Dini</p>
                    </div>
                    <span class="ml-2 inline-block px-2 py-1 text-xs font-semibold rounded bg-blue-600 text-white">
                        TA 2024/2025
                    </span>
                </div>
                
                <!-- Desktop Links -->
                <div class="flex items-center space-x-6">
                    <!-- Facebook Link -->
                    <a href="https://facebook.com/ra.umarmirza" target="_blank" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="font-medium">Facebook</span>
                    </a>
                    
                    <!-- Login Button -->
                    <a href="/login" class="inline-block px-5 py-2 bg-gradient-to-r from-blue-600 to-green-600 text-white rounded-lg hover:from-blue-700 hover:to-green-700 transition-all duration-300 shadow-lg">
                        Log in<br/>
                        <span class="text-xs">(Hanya untuk Admin)</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu Overlay -->
        <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 w-80 h-full bg-white shadow-2xl z-50 md:hidden">
            <div class="p-4 border-b border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 flex-shrink-0">
                            <img src="/images/logo.png" alt="Logo" class="logo w-full h-full object-contain">
                        </div>
                        <div>
                            <h2 class="font-bold gradient-text">RA UMAR MIRZA</h2>
                            <p class="text-sm text-gray-600">PAUD</p>
                        </div>
                    </div>
                    <button id="closeMobileMenu" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="mt-3">
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded bg-blue-600 text-white">
                        TA 2024/2025
                    </span>
                </div>
            </div>
            
            <div class="p-4 space-y-4 bg-white">
                <!-- Facebook Link -->
                <a href="https://facebook.com/ra.umarmirza" target="_blank" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span class="font-medium text-blue-600">Facebook</span>
                </a>
                
                <!-- Login Button -->
                <a href="/login" class="block w-full p-3 bg-gradient-to-r from-blue-600 to-green-600 text-white rounded-lg hover:from-blue-700 hover:to-green-700 transition-all duration-300 shadow-lg text-center">
                    <div class="font-medium">Log in</div>
                    <div class="text-xs opacity-90">(Hanya untuk Admin)</div>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative py-20 hero-pattern overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 text-blue-900 leading-tight">
                        {{ \App\Models\Setting::get('hero_title', 'Selamat Datang di Lembaga Pendidikan') }}
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 mb-8 leading-relaxed">
                        {{ \App\Models\Setting::get('hero_description', 'Memberikan pendidikan berkualitas untuk masa depan yang cerah') }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/search-payment" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-green-600 text-white rounded-full text-lg font-semibold hover:from-blue-700 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Cek Pembayaran
                        </a>
                        <a href="#about" class="inline-flex items-center justify-center px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-full text-lg font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                
                <div class="floating-animation">
                    <img src="{{ asset('images/foto_ra.jpg') }}" alt="RA Umar Mirza - Anak-anak Belajar" class="w-full max-w-md mx-auto rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6 text-blue-900 leading-tight">
                    {{ \App\Models\Setting::get('about_title', 'Tentang Kami') }}
                </h2>
                <div class="text-center">
                    <p class="text-lg md:text-xl text-gray-700 mb-8 leading-relaxed">
                        {{ \App\Models\Setting::get('about_description', 'Kami adalah lembaga pendidikan yang berkomitmen untuk memberikan pendidikan terbaik.') }}
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass-effect rounded-2xl p-8 text-center hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Pendidikan Berkualitas</h3>
                    <p class="text-gray-600">Kurikulum yang dirancang khusus untuk mengembangkan potensi anak secara optimal dengan pendekatan holistik.</p>
                </div>

                <div class="glass-effect rounded-2xl p-8 text-center hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Karakter Islami</h3>
                    <p class="text-gray-600">Pembentukan akhlak mulia dan nilai-nilai keislaman yang kuat sebagai fondasi kepribadian anak.</p>
                </div>

                <div class="glass-effect rounded-2xl p-8 text-center hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Lingkungan Kondusif</h3>
                    <p class="text-gray-600">Suasana belajar yang nyaman, aman, dan mendukung perkembangan sosial-emosional anak.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12">
                <!-- Contact Info -->
                <div>
                    <h3 class="text-2xl font-bold mb-6 gradient-text">Hubungi Kami</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Email</p>
                            {{ \App\Models\Setting::get('email', 'info@sekolah.com') }}
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <ul>
                                <p class="text-sm text-gray-400">Telepon</p>
                                <div>
                                    <div>{{ \App\Models\Setting::get('phone', 'Tidak tersedia') }}</div>
                                </div>
                            </ul>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-400">Alamat</p>
                                <p class="text-white">{{ \App\Models\Setting::get('address_description', 'Alamat sekolah') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-2xl font-bold mb-6">Link Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Map -->
                <div>
                    <h3 class="text-2xl font-bold mb-6">Lokasi Kami</h3>
                    <div class="bg-gray-800 rounded-lg p-4 min-h-64 flex items-center justify-center">
                        <div class="map-embed w-full h-full">
                            {!! \App\Models\Setting::get('map_embed', '<p>Map tidak tersedia</p>') !!}
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="border-t border-gray-200 mt-12 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; 2025 RA Umar Mirza. All rights reserved.
                </p>
                <p class="font-medium text-xs text-gray-600 text-center">Created by <a href="https://instagram.com/rddzikri" target="_blank" class="font-bold text-pink-600">Dzikri Rahmadani Butar-Butar a.k.a ZackRyukami7</a> using <a href="https://tailwind.css.com" target="_blank" class="font-bold text-sky-400">Tailwind CSS</a></p>
            </div>
    </footer>
</body>
<!-- JavaScript - Moved to bottom -->
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        
        function openMobileMenu() {
            mobileMenu.classList.add('open');
            mobileMenuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenuFunc() {
            mobileMenu.classList.remove('open');
            mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Event listeners
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileMenu);
        }
        
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        }
        
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
        }
        
        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeMobileMenuFunc();
            }
        });
    });
</script>
</html>