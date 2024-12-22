<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data user yang ada
        User::truncate();

        // Create Admin
        User::firstOrCreate(
            ['email' => 'admin@school.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Teacher
        User::firstOrCreate(
            ['email' => 'teacher@school.test'],
            [
                'name' => 'Teacher User',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]
        );

        // Create Student
        User::firstOrCreate(
            ['email' => 'student@school.test'],
            [
                'name' => 'Student User',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );
    }
} 