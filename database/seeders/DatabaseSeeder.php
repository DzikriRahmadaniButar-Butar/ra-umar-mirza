<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin RA Umar Mirza',
            'email' => 'admin@raumarmirza.sch.id',
            'password' => bcrypt('admin123'), // atau Hash::make jika sudah di-import
            'role' => 'admin'
        ]);        

        $this->call([
            AcademicYearSeeder::class,
            ClassroomSeeder::class,
            StudentSeeder::class,
            PaymentSeeder::class,
            
        ]);
    
        
    }
    
}
