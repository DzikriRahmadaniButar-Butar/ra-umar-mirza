<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data yang sudah ada dengan kategori yang ditambahkan
        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Juni',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-06-01'),
            'notes' => 'Dibayar lunas saat daftar ulang semester baru',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 6
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Buku Pelajaran',
            'amount' => 50000,
            'paid_at' => Carbon::parse('2025-06-01'),
            'notes' => 'Buku tahun ajaran baru',
            'user_id' => 1,
            'category' => 'buku_pelajaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Pendaftaran',
            'amount' => 100000,
            'paid_at' => Carbon::parse('2025-05-28'),
            'notes' => 'Pembayaran awal sebelum masuk',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        // Data tambahan untuk mencapai page 2
        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Juli',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-07-01'),
            'notes' => 'Pembayaran SPP bulan Juli',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 7
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Kegiatan',
            'amount' => 75000,
            'paid_at' => Carbon::parse('2025-06-15'),
            'notes' => 'Uang kegiatan semester baru',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Seragam Sekolah',
            'amount' => 200000,
            'paid_at' => Carbon::parse('2025-06-10'),
            'notes' => 'Seragam lengkap untuk tahun ajaran baru',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Praktikum',
            'amount' => 80000,
            'paid_at' => Carbon::parse('2025-06-20'),
            'notes' => 'Uang praktikum laboratorium',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Agustus',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-08-01'),
            'notes' => 'Pembayaran SPP bulan Agustus',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 8
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Ujian',
            'amount' => 120000,
            'paid_at' => Carbon::parse('2025-07-15'),
            'notes' => 'Uang ujian semester ganjil',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Ekstrakurikuler',
            'amount' => 60000,
            'paid_at' => Carbon::parse('2025-06-25'),
            'notes' => 'Uang ekstrakurikuler basket',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Perpustakaan',
            'amount' => 40000,
            'paid_at' => Carbon::parse('2025-06-05'),
            'notes' => 'Uang perpustakaan tahun ajaran baru',
            'user_id' => 1,
            'category' => 'buku_pelajaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan September',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-09-01'),
            'notes' => 'Pembayaran SPP bulan September',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 9
        ]);

        Payment::create([
            'student_id' => 2,
            'name' => 'Uang Karyawisata',
            'amount' => 300000,
            'paid_at' => Carbon::parse('2025-08-15'),
            'notes' => 'Uang karyawisata ke museum',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Administrasi',
            'amount' => 25000,
            'paid_at' => Carbon::parse('2025-07-30'),
            'notes' => 'Uang administrasi semester ganjil',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Oktober',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-10-01'),
            'notes' => 'Pembayaran SPP bulan Oktober',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 10
        ]);

        Payment::create([
            'student_id' => 2,
            'name' => 'Uang Komputer',
            'amount' => 90000,
            'paid_at' => Carbon::parse('2025-09-10'),
            'notes' => 'Uang praktikum komputer',
            'user_id' => 1,
            'category' => 'buku_pelajaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Uang Olahraga',
            'amount' => 45000,
            'paid_at' => Carbon::parse('2025-08-20'),
            'notes' => 'Uang kegiatan olahraga',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan November',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-11-01'),
            'notes' => 'Pembayaran SPP bulan November',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 11
        ]);

        Payment::create([
            'student_id' => 2,
            'name' => 'Uang Perawatan',
            'amount' => 35000,
            'paid_at' => Carbon::parse('2025-10-15'),
            'notes' => 'Uang perawatan fasilitas sekolah',
            'user_id' => 1,
            'category' => 'pendaftaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Desember',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-12-01'),
            'notes' => 'Pembayaran SPP bulan Desember',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 12
        ]);

        // Tambahan data buku pelajaran
        Payment::create([
            'student_id' => 1,
            'name' => 'Buku Matematika',
            'amount' => 75000,
            'paid_at' => Carbon::parse('2025-06-05'),
            'notes' => 'Buku paket matematika semester 1',
            'user_id' => 1,
            'category' => 'buku_pelajaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Buku Bahasa Indonesia',
            'amount' => 60000,
            'paid_at' => Carbon::parse('2025-06-05'),
            'notes' => 'Buku paket bahasa Indonesia',
            'user_id' => 1,
            'category' => 'buku_pelajaran'
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'Buku IPA',
            'amount' => 85000,
            'paid_at' => Carbon::parse('2025-06-05'),
            'notes' => 'Buku paket IPA semester 1',
            'user_id' => 1,
            'category' => 'buku_pelajaran'
        ]);

        // Tambahan SPP untuk melengkapi 12 bulan
        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Januari',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-01-01'),
            'notes' => 'Pembayaran SPP bulan Januari',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 1
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Februari',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-02-01'),
            'notes' => 'Pembayaran SPP bulan Februari',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 2
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Maret',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-03-01'),
            'notes' => 'Pembayaran SPP bulan Maret',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 3
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan April',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-04-01'),
            'notes' => 'Pembayaran SPP bulan April',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 4
        ]);

        Payment::create([
            'student_id' => 1,
            'name' => 'SPP Bulan Mei',
            'amount' => 150000,
            'paid_at' => Carbon::parse('2025-05-01'),
            'notes' => 'Pembayaran SPP bulan Mei',
            'user_id' => 1,
            'category' => 'spp',
            'month' => 5
        ]);
    }
}