<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, select, etc
            $table->string('group')->default('general'); // general, landing, contact, system
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default values
        DB::table('settings')->insert([
            // Hero Section
            [
                'key' => 'hero_title',
                'value' => 'Selamat Datang di Lembaga Pendidikan Umar Mirza',
                'type' => 'text',
                'group' => 'landing',
                'label' => 'Judul Hero',
                'description' => 'Judul utama di halaman beranda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'hero_description',
                'value' => 'Memberikan pendidikan berkualitas untuk masa depan yang cerah',
                'type' => 'textarea',
                'group' => 'landing',
                'label' => 'Deskripsi Hero',
                'description' => 'Deskripsi di hero section',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // About Section
            [
                'key' => 'about_title',
                'value' => 'Tentang Kami',
                'type' => 'text',
                'group' => 'landing',
                'label' => 'Judul Tentang Kami',
                'description' => 'Judul section tentang kami',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'about_description',
                'value' => 'Kami adalah lembaga pendidikan yang berkomitmen untuk memberikan pendidikan terbaik bagi siswa-siswa kami. Dengan fasilitas modern dan tenaga pengajar yang berpengalaman, kami siap membentuk generasi yang berkualitas.',
                'type' => 'textarea',
                'group' => 'landing',
                'label' => 'Deskripsi Tentang Kami',
                'description' => 'Deskripsi tentang lembaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Contact Information
            [
                'key' => 'email',
                'value' => 'info@umarmirza.sch.id',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Email Kontak',
                'description' => 'Email untuk kontak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'phone',
                'value' => '+62 123 456 7890',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Telepon Kontak',
                'description' => 'Nomor telepon untuk kontak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'address_description',
                'value' => 'Jl. Pendidikan No. 123, Medan, Sumatera Utara',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Deskripsi Alamat',
                'description' => 'Alamat lengkap lembaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'map_embed',
                'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.0814154977827!2d98.6728!3d3.5952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMzUnNDIuNyJOIDk4wrA0MCcyMi4xIkU!5e0!3m2!1sen!2sid!4v1234567890!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Lokasi Google Maps',
                'description' => 'Embed code Google Maps',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // System Settings
            [
                'key' => 'default_academic_year_id',
                'value' => '1',
                'type' => 'select',
                'group' => 'system',
                'label' => 'Tahun Ajaran Aktif',
                'description' => 'Tahun ajaran yang sedang aktif/dipilih',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};