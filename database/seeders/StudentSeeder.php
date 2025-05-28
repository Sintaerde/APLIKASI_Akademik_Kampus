<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Students;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Students::create([
            'student_id' => 'STD001',
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'NIM' => '12345678',
            'major' => 'Informatika',
            'enrollment_year' => '2023-08-01',
            'password' => Hash::make('rahasia123')
        ]);
    }
}
