<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@school.test',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Teachers with different roles
        $teachers = [
            [
                'name' => 'John Doe',
                'email' => 'teacher1@school.test',
                'username' => 'teacher1',
                'role' => 'teacher',
                'nip' => '198501012010011001',
                'position' => 'guru_mapel' // guru mata pelajaran biasa
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'teacher2@school.test',
                'username' => 'teacher2',
                'role' => 'teacher',
                'nip' => '198601012010011002',
                'position' => 'guru_piket' // guru piket
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'teacher3@school.test',
                'username' => 'teacher3',
                'role' => 'teacher',
                'nip' => '198701012010011003',
                'position' => 'pembimbing_pkl' // guru pembimbing PKL
            ],
        ];

        foreach ($teachers as $teacher) {
            User::create([
                'name' => $teacher['name'],
                'email' => $teacher['email'],
                'username' => $teacher['username'],
                'password' => Hash::make('password'),
                'role' => $teacher['role'],
                'nip' => $teacher['nip'],
                'position' => $teacher['position'],
            ]);
        }

        // Create Staff
        $staffs = [
            [
                'name' => 'Security Staff',
                'email' => 'security@school.test',
                'username' => 'security1',
                'role' => 'staff',
                'position' => 'security'
            ],
            [
                'name' => 'TU Staff',
                'email' => 'tu@school.test',
                'username' => 'tu1',
                'role' => 'staff',
                'position' => 'tata_usaha'
            ],
            [
                'name' => 'Tool Man',
                'email' => 'toolman@school.test',
                'username' => 'toolman1',
                'role' => 'staff',
                'position' => 'tool_man'
            ],
        ];

        foreach ($staffs as $staff) {
            User::create([
                'name' => $staff['name'],
                'email' => $staff['email'],
                'username' => $staff['username'],
                'password' => Hash::make('password'),
                'role' => $staff['role'],
                'position' => $staff['position'],
            ]);
        }

        // Create Students
        User::create([
            'name' => 'Student One',
            'email' => 'student@school.test',
            'username' => 'student1',
            'password' => Hash::make('password'),
            'role' => 'student',
            'nis' => '2024001',
        ]);
    }
}