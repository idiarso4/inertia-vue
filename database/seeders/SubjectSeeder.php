<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Subject::create([
            'name' => 'Pemrograman Dasar',
            'code' => 'RPL-001',
            'teacher_id' => 2, // ID dari user dengan role teacher
            'description' => 'Mata pelajaran dasar pemrograman'
        ]);

        Subject::create([
            'name' => 'Basis Data',
            'code' => 'RPL-002',
            'teacher_id' => 2,
            'description' => 'Mata pelajaran basis data'
        ]);
    }
} 