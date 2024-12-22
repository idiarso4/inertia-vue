<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    public function run()
    {
        ClassRoom::create([
            'name' => 'X RPL 1',
            'code' => 'XRPL1',
            'level' => 'X',
            'major' => 'RPL',
            'capacity' => 36,
            'homeroom_teacher_id' => 2, // ID dari user dengan role teacher
        ]);

        ClassRoom::create([
            'name' => 'X RPL 2',
            'code' => 'XRPL2',
            'level' => 'X',
            'major' => 'RPL',
            'capacity' => 36,
            'homeroom_teacher_id' => 2,
        ]);
    }
} 