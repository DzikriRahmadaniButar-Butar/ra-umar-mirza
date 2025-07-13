<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fee;
use App\Models\Student;
use App\Models\FeeCategory;
use App\Models\AcademicYear;

class FeeSeeder extends Seeder
{
    public function run(): void
    {
        $academicYear = AcademicYear::first(); // Ambil tahun ajaran pertama
        $students = Student::all();

        $sppCategory = FeeCategory::where('slug', 'spp')->first();
        $pendaftaranCategory = FeeCategory::where('slug', 'pendaftaran')->first();

        foreach ($students as $student) {
            // Tagihan SPP 3 bulan (misalnya Juli, Agustus, September)
            foreach (['Juli', 'Agustus', 'September'] as $month) {
                Fee::create([
                    'student_id' => $student->id,
                    'fee_category_id' => $sppCategory->id,
                    'academic_year_id' => $academicYear->id,
                    'name' => 'SPP ' . $month,
                    'amount' => 100000,
                    'month' => $month,
                    'is_paid' => false,
                ]);
            }

            // Tagihan pendaftaran
            Fee::create([
                'student_id' => $student->id,
                'fee_category_id' => $pendaftaranCategory->id,
                'academic_year_id' => $academicYear->id,
                'name' => 'Biaya Pendaftaran',
                'amount' => 700000,
                'month' => null,
                'is_paid' => false,
            ]);
        }
    }
}
