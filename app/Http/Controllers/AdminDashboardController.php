<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Subject;
use App\Models\ClassRoom;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'teachers_count' => User::where('role', 'teacher')->count(),
                'students_count' => User::where('role', 'student')->count(),
                'subjects_count' => Subject::count(),
                'class_rooms_count' => ClassRoom::count(),
            ]
        ]);
    }
} 