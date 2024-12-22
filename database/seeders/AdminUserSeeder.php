<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@school.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'position' => null
        ]);

        // Create Student
        User::create([
            'name' => 'Student One',
            'username' => 'student1',
            'email' => 'student@school.test',
            'password' => Hash::make('password'),
            'role' => 'student',
            'nis' => '2024001'
        ]);

        // Create Teacher
        User::create([
            'name' => 'Teacher One',
            'username' => 'teacher1',
            'email' => 'teacher@school.test',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'nip' => '198500000000000001',
            'position' => 'Guru Mapel'
        ]);
    }
} 