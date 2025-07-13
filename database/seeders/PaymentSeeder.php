<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\FeeCategory;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kategori berdasarkan slug
        $spp = FeeCategory::where('slug', 'spp')->first();
        $buku = FeeCategory::where('slug', 'buku_pelajaran')->first();
        $pendaftaran = FeeCategory::where('slug', 'pendaftaran')->first();

        // Pastikan semua kategori ditemukan
        if (!$spp || !$buku || !$pendaftaran) {
            throw new \Exception("Kategori tidak ditemukan. Pastikan slug 'spp', 'buku_pelajaran', dan 'pendaftaran' tersedia.");
        }

        // Data pembayaran contoh
        $data = [
            [
                'student_id' => 1,
                'name' => 'SPP Bulan Juni',
                'amount' => 150000,
                'paid_at' => '2025-06-01',
                'notes' => 'Dibayar lunas saat daftar ulang semester baru',
                'user_id' => 1,
                'fee_category_id' => $spp->id,
                'month' => 6,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 1,
                'name' => 'Buku Pelajaran',
                'amount' => 50000,
                'paid_at' => '2025-06-01',
                'notes' => 'Buku tahun ajaran baru',
                'user_id' => 1,
                'fee_category_id' => $buku->id,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 1,
                'name' => 'Uang Pendaftaran',
                'amount' => 100000,
                'paid_at' => '2025-05-28',
                'notes' => 'Pembayaran awal sebelum masuk',
                'user_id' => 1,
                'fee_category_id' => $pendaftaran->id,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 1,
                'name' => 'SPP Bulan Juli',
                'amount' => 150000,
                'paid_at' => '2025-07-01',
                'notes' => 'Pembayaran SPP bulan Juli',
                'user_id' => 1,
                'fee_category_id' => $spp->id,
                'month' => 7,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 2,
                'name' => 'Uang Kegiatan',
                'amount' => 75000,
                'paid_at' => '2025-06-15',
                'notes' => 'Uang kegiatan semester baru',
                'user_id' => 1,
                'fee_category_id' => $pendaftaran->id,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 2,
                'name' => 'SPP Bulan Agustus',
                'amount' => 150000,
                'paid_at' => '2025-08-01',
                'notes' => 'Pembayaran SPP bulan Agustus',
                'user_id' => 1,
                'fee_category_id' => $spp->id,
                'month' => 8,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 1,
                'name' => 'SPP Bulan September',
                'amount' => 150000,
                'paid_at' => '2025-09-01',
                'notes' => 'Pembayaran SPP bulan September',
                'user_id' => 1,
                'fee_category_id' => $spp->id,
                'month' => 9,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 1,
                'name' => 'SPP Bulan Oktober',
                'amount' => 150000,
                'paid_at' => '2025-10-01',
                'notes' => 'Pembayaran SPP bulan Oktober',
                'user_id' => 1,
                'fee_category_id' => $spp->id,
                'month' => 10,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 1,
                'name' => 'SPP Bulan November',
                'amount' => 150000,
                'paid_at' => '2025-11-01',
                'notes' => 'Pembayaran SPP bulan November',
                'user_id' => 1,
                'fee_category_id' => $spp->id,
                'month' => 11,
                'academic_year_id' => 1
            ],
            [
                'student_id' => 1,
                'name' => 'SPP Bulan Desember',
                'amount' => 150000,
                'paid_at' => '2025-12-01',
                'notes' => 'Pembayaran SPP bulan Desember',
                'user_id' => 1,
                'fee_category_id' => $spp->id,
                'month' => 12,
                'academic_year_id' => 1
            ],
        ];

        // Simpan ke DB
        foreach ($data as $item) {
            Payment::create($item);
        }
    }
}
