<!DOCTYPE html>
<html lang="id">
<head>
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
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-green-50 text-gray-800 min-h-screen">
    <!-- Header -->
    <header class="w-full bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-16">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold gradient-text">RA UMAR MIRZA</h1>
                        <p class="text-sm text-gray-600">Pendidikan Anak Usia Dini</p>
                    </div>
                </div>
                
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
    </header>

    <!-- Hero Section -->
    <section class="relative py-20 hero-pattern overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h1 class="text-5xl lg:text-6xl font-bold mb-6 gradient-text leading-tight">
                        Selamat Datang di<br/>
                        <span class="text-4xl lg:text-5xl">RA Umar Mirza</span>
                    </h1>
                    <p class="text-xl text-gray-700 mb-8 leading-relaxed">
                        Lembaga pendidikan anak usia dini yang berfokus pada pembentukan karakter Islami, pembelajaran kreatif, dan perkembangan sosial anak. Kami percaya setiap anak adalah istimewa dan memiliki potensi luar biasa.
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
                <h2 class="text-4xl font-bold gradient-text mb-4">Tentang Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    RA Umar Mirza berkomitmen memberikan pendidikan terbaik untuk anak-anak dengan metode pembelajaran yang menyenangkan dan berbasis karakter Islami.
                </p>
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

    {{-- <!-- Statistics Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-green-600">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl font-bold mb-2">150+</div>
                    <div class="text-lg">Siswa Aktif</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">15+</div>
                    <div class="text-lg">Guru Berpengalaman</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">10+</div>
                    <div class="text-lg">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </section> --}}

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
                                <p>ra.umarmirza@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Telepon</p>
                                <p>+62 811641690</p>
                                <p>+62 82167777712</p>
                                <p>+62 81375757408</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Alamat</p>
                                <p>Jl. Balai Desa Ujung, Gg. Bunga<br/>Medan, Sumatera Utara</p>
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
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Program</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Galeri</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <!-- Map -->
                <div>
                    <h3 class="text-2xl font-bold mb-6">Lokasi Kami</h3>
                    <div class="bg-gray-800 rounded-lg p-4 h-48 flex items-center justify-center">
                        <div class="text-center">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.2751086762423!2d98.7233219!3d3.5237708999999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30313a6b9fde12f9%3A0xa9c1cc6cc9de553d!2sR.A.%20Umar%20Mirza!5e0!3m2!1sid!2sid!4v1751920061600!5m2!1sid!2sid" width="380" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-md"></iframe>                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-12 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; 2025 RA Umar Mirza. All rights reserved.
                </p>
                <p class="font-medium text-xs text-gray-600 text-center">Created by <a href="https://instagram.com/rddzikri" target="_blank" class="font-bold text-pink-600">Dzikri Rahmadani Butar-Butar a.k.a ZackRyukami7</a> using <a href="https://tailwind.css.com" target="_blank" class="font-bold text-sky-400">Tailwind CSS</a></p>
            </div>
        </div>
    </footer>
</body>
</html>