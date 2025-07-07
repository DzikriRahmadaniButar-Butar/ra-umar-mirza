<?php

// database/seeders/StudentSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'name' => 'Siti Aminah',
                'student_number' => 'S001',
                'classroom_id' => 1,
                'birth_place' => 'Medan',
                'birth_date' => '2017-08-01',
                'address' => 'Jl. Mawar No. 10',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Ahmad Fauzi',
                'student_number' => 'S002',
                'classroom_id' => 1,
                'birth_place' => 'Binjai',
                'birth_date' => '2017-06-15',
                'address' => 'Jl. Melati No. 5',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Rina Sari',
                'student_number' => 'S003',
                'classroom_id' => 1,
                'birth_place' => 'Deli Serdang',
                'birth_date' => '2017-09-12',
                'address' => 'Jl. Kenanga No. 8',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Budi Santoso',
                'student_number' => 'S004',
                'classroom_id' => 2,
                'birth_place' => 'Medan',
                'birth_date' => '2017-03-22',
                'address' => 'Jl. Anggrek No. 12',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Dewi Kartika',
                'student_number' => 'S005',
                'classroom_id' => 2,
                'birth_place' => 'Tebing Tinggi',
                'birth_date' => '2017-11-08',
                'address' => 'Jl. Flamboyan No. 7',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Rizki Ramadhan',
                'student_number' => 'S006',
                'classroom_id' => 2,
                'birth_place' => 'Medan',
                'birth_date' => '2017-05-18',
                'address' => 'Jl. Dahlia No. 3',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Putri Maharani',
                'student_number' => 'S007',
                'classroom_id' => 3,
                'birth_place' => 'Langkat',
                'birth_date' => '2017-07-25',
                'address' => 'Jl. Cempaka No. 15',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Arief Setiawan',
                'student_number' => 'S008',
                'classroom_id' => 3,
                'birth_place' => 'Medan',
                'birth_date' => '2017-12-03',
                'address' => 'Jl. Bougenville No. 6',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Indah Permata',
                'student_number' => 'S009',
                'classroom_id' => 3,
                'birth_place' => 'Serdang Bedagai',
                'birth_date' => '2017-04-14',
                'address' => 'Jl. Kamboja No. 9',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Dimas Prasetyo',
                'student_number' => 'S010',
                'classroom_id' => 1,
                'birth_place' => 'Medan',
                'birth_date' => '2017-10-30',
                'address' => 'Jl. Tulip No. 11',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Sari Wulandari',
                'student_number' => 'S011',
                'classroom_id' => 2,
                'birth_place' => 'Karo',
                'birth_date' => '2017-02-17',
                'address' => 'Jl. Sakura No. 4',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Andi Wijaya',
                'student_number' => 'S012',
                'classroom_id' => 2,
                'birth_place' => 'Medan',
                'birth_date' => '2017-08-26',
                'address' => 'Jl. Lily No. 13',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Maya Safitri',
                'student_number' => 'S013',
                'classroom_id' => 3,
                'birth_place' => 'Asahan',
                'birth_date' => '2017-06-09',
                'address' => 'Jl. Lavender No. 2',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Teguh Nugroho',
                'student_number' => 'S014',
                'classroom_id' => 1,
                'birth_place' => 'Medan',
                'birth_date' => '2017-01-21',
                'address' => 'Jl. Jasmine No. 16',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Fitri Handayani',
                'student_number' => 'S015',
                'classroom_id' => 1,
                'birth_place' => 'Labuhan Batu',
                'birth_date' => '2017-11-14',
                'address' => 'Jl. Geranium No. 8',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Hendra Kurniawan',
                'student_number' => 'S016',
                'classroom_id' => 2,
                'birth_place' => 'Medan',
                'birth_date' => '2017-09-07',
                'address' => 'Jl. Gardenia No. 5',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Lestari Dewi',
                'student_number' => 'S017',
                'classroom_id' => 3,
                'birth_place' => 'Batubara',
                'birth_date' => '2017-04-28',
                'address' => 'Jl. Azalea No. 14',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Fajar Maulana',
                'student_number' => 'S018',
                'classroom_id' => 1,
                'birth_place' => 'Medan',
                'birth_date' => '2017-07-11',
                'address' => 'Jl. Camellia No. 7',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Nur Halimah',
                'student_number' => 'S019',
                'classroom_id' => 2,
                'birth_place' => 'Tapanuli Utara',
                'birth_date' => '2017-12-19',
                'address' => 'Jl. Begonia No. 1',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Wahyu Pratama',
                'student_number' => 'S020',
                'classroom_id' => 3,
                'birth_place' => 'Medan',
                'birth_date' => '2017-05-06',
                'address' => 'Jl. Petunia No. 18',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Ratna Sari',
                'student_number' => 'S021',
                'classroom_id' => 1,
                'birth_place' => 'Nias',
                'birth_date' => '2017-03-15',
                'address' => 'Jl. Carnation No. 9',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Dedy Kurniawan',
                'student_number' => 'S022',
                'classroom_id' => 2,
                'birth_place' => 'Medan',
                'birth_date' => '2017-10-23',
                'address' => 'Jl. Hibiscus No. 12',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Sinta Maharani',
                'student_number' => 'S023',
                'classroom_id' => 3,
                'birth_place' => 'Toba Samosir',
                'birth_date' => '2017-08-04',
                'address' => 'Jl. Iris No. 6',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Randi Saputra',
                'student_number' => 'S024',
                'classroom_id' => 1,
                'birth_place' => 'Medan',
                'birth_date' => '2017-06-27',
                'address' => 'Jl. Sunflower No. 17',
                'academic_year_id' => 1
            ],
            [
                'name' => 'Yuni Astuti',
                'student_number' => 'S025',
                'classroom_id' => 2,
                'birth_place' => 'Humbang Hasundutan',
                'birth_date' => '2017-01-09',
                'address' => 'Jl. Violet No. 19',
                'academic_year_id' => 1
            ]
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}