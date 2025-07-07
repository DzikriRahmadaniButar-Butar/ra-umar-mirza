<?php

// database/seeders/ClassroomSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        Classroom::create(['name' => 'Kelas A']);
        Classroom::create(['name' => 'Kelas B']);
        Classroom::create(['name' => 'Kelas C']);
    }
}
