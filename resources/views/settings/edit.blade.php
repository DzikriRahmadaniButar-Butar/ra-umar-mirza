@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-900 text-gray-100">
    @if (session('success'))
        <div class="mx-6 my-4 px-4 py-3 rounded bg-green-100 border border-green-300 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="mx-6 my-4 px-4 py-3 rounded bg-red-100 border border-red-300 text-red-800 text-sm">
            {{ session('error') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="mx-6 my-4 px-4 py-3 rounded bg-red-100 border border-red-300 text-red-800 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header -->
    <div class="px-6 py-4 border-b border-blue-800 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <nav class="flex items-center space-x-2 text-sm text-blue-300 mb-2">
                    <span>Pengaturan</span>
                    <span>></span>
                    <span>Umum</span>
                </nav>
                <h1 class="text-2xl font-bold text-white">Pengaturan Sistem</h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-6">
        <!-- Pengaturan Tahun Ajaran Aktif -->
        <div class="bg-white rounded-lg border border-blue-200 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-blue-200 bg-blue-50">
                <h3 class="text-lg font-semibold text-blue-800">Tahun Ajaran Aktif</h3>
                <p class="text-sm text-blue-600 mt-1">Pilih tahun ajaran yang akan digunakan untuk menampilkan data</p>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('settings.set-active-year') }}">
                    @csrf
                    <div class="flex items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">Tahun Ajaran:</label>
                        <select name="academic_year_id" class="border border-gray-300 rounded-lg px-3 py-2 pr-8 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @php 
                                use App\Helpers\SettingHelper;
                                $defaultAcademicYearId = SettingHelper::get('default_academic_year_id');
                            @endphp
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ $year->id == $defaultAcademicYearId ? 'selected' : '' }}>
                                    {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Pengaturan Konten Website -->
        <div class="bg-white rounded-lg border border-blue-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-blue-200 bg-blue-50">
                <h3 class="text-lg font-semibold text-blue-800">Pengaturan Konten Website</h3>
                <p class="text-sm text-blue-600 mt-1">Atur konten yang tampil di website</p>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    @method('POST')
                    
                    <!-- Hero Section -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Hero Section</h4>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Utama
                                </label>
                                <input type="text" 
                                       name="hero_title" 
                                       value="{{ \App\Helpers\SettingHelper::get('hero_title', 'Selamat Datang di Lembaga Pendidikan Umar Mirza') }}" 
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Judul utama halaman">
                                <p class="text-xs text-gray-500 mt-1">Judul yang akan ditampilkan di bagian atas halaman utama</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi Hero
                                </label>
                                <textarea name="hero_description" 
                                          rows="4" 
                                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Deskripsi singkat tentang sekolah">{{ \App\Helpers\SettingHelper::get('hero_description', 'Memberikan pendidikan berkualitas untuk masa depan...') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Deskripsi yang akan ditampilkan di bagian hero</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tentang Kami -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Tentang Kami</h4>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Tentang Kami
                                </label>
                                <input type="text" 
                                       name="about_title" 
                                       value="{{ \App\Helpers\SettingHelper::get('about_title', 'Tentang Kami') }}" 
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Judul section tentang kami">
                                <p class="text-xs text-gray-500 mt-1">Judul untuk section tentang kami</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi Tentang Kami
                                </label>
                                <textarea name="about_description" 
                                          rows="6" 
                                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Deskripsi lengkap tentang sekolah">{{ \App\Helpers\SettingHelper::get('about_description', 'Kami adalah lembaga pendidikan yang berkomitmen untuk...') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Deskripsi lengkap tentang sekolah yang akan ditampilkan di section tentang kami</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Informasi Kontak</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email" 
                                       name="email" 
                                       value="{{ \App\Helpers\SettingHelper::get('email', 'info@umarmirza.sch.id') }}" 
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Email sekolah">
                                <p class="text-xs text-gray-500 mt-1">Email resmi sekolah</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Telepon
                                </label>
                                <input type="text" 
                                       name="phone" 
                                       value="{{ \App\Helpers\SettingHelper::get('phone', '+62 123 456 7890') }}" 
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Nomor telepon">
                                <p class="text-xs text-gray-500 mt-1">Nomor telepon yang bisa dihubungi</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat
                            </label>
                            <textarea name="address_description" 
                                      rows="3" 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Alamat lengkap sekolah">{{ \App\Helpers\SettingHelper::get('address_description', 'Jl. Pendidikan No. 123, Medan, Sumatera Utara') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Alamat lengkap sekolah</p>
                        </div>
                    </div>

                    <!-- Lokasi & Peta -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Lokasi & Peta</h4>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Embed Google Maps
                            </label>
                            <textarea name="map_embed" 
                                      rows="5" 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                                      placeholder="Paste kode embed iframe Google Maps disini...">{{ \App\Helpers\SettingHelper::get('map_embed', '<p>Map tidak tersedia</p>') }}</textarea>
                            <div class="mt-2 p-3 bg-blue-50 rounded-lg">
                                <p class="text-xs text-blue-700 font-medium mb-1">📍 Cara mendapatkan kode embed Google Maps:</p>
                                <ol class="text-xs text-blue-600 space-y-1">
                                    <li>1. Buka Google Maps di browser</li>
                                    <li>2. Cari lokasi sekolah</li>
                                    <li>3. Klik tombol "Share" atau "Bagikan"</li>
                                    <li>4. Pilih tab "Embed a map" atau "Sematkan peta"</li>
                                    <li>5. Copy kode HTML yang muncul</li>
                                    <li>6. Paste di kolom ini</li>
                                    <li class="text-red-600">PENTING: Ubah Width menjadi 350 dan Height menjadi 250!</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Map -->
                    @if(\App\Helpers\SettingHelper::get('map_embed') && \App\Helpers\SettingHelper::get('map_embed') != '<p>Map tidak tersedia</p>')
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Preview Peta</h4>
                        <div class="bg-gray-100 rounded-lg p-4 max-h-64 overflow-hidden">
                            <div class="map-embed">
                                {!! \App\Helpers\SettingHelper::get('map_embed', '<p>Map tidak tersedia</p>') !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex justify-end pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                            💾 Simpan Semua Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.map-embed iframe {
    width: 100%;
    height: 250px;
    border: none;
    border-radius: 0.5rem;
}
</style>
@endsection