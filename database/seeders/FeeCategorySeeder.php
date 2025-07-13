<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FeeCategory;

class FeeCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'SPP',
                'slug' => 'spp',
                'is_monthly' => true,
                'limit_amount' => 100000, // per bulan
                'description' => 'Tagihan bulanan untuk operasional siswa.',
            ],
            [
                'name' => 'Pendaftaran',
                'slug' => 'pendaftaran',
                'is_monthly' => false,
                'limit_amount' => 700000,
                'description' => 'Biaya masuk untuk siswa baru.',
            ],
            [
                'name' => 'Buku',
                'slug' => 'buku_pelajaran',
                'is_monthly' => false,
                'limit_amount' => 300000,
                'description' => 'Pembayaran buku dan LKS.',
            ],
        ];

        foreach ($categories as $category) {
            FeeCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
