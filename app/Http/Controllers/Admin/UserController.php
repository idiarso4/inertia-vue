<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function teachers()
    {
        $teachers = User::where('role', 'teacher')
            ->where('position', 'guru_mapel')
            ->paginate(10);
            
        return Inertia::render('Admin/Users/Teachers', [
            'teachers' => $teachers
        ]);
    }

    public function supervisors()
    {
        $supervisors = User::where('role', 'teacher')
            ->where('position', 'pembimbing_pkl')
            ->paginate(10);
            
        return Inertia::render('Admin/Users/Supervisors', [
            'supervisors' => $supervisors
        ]);
    }

    public function picketTeachers()
    {
        $picketTeachers = User::where('role', 'teacher')
            ->where('position', 'guru_piket')
            ->paginate(10);
            
        return Inertia::render('Users/PicketTeachers', [
            'picketTeachers' => $picketTeachers
        ]);
    }

    public function security()
    {
        $security = User::where('role', 'staff')
            ->where('position', 'security')
            ->paginate(10);
            
        return Inertia::render('Users/Security', [
            'security' => $security
        ]);
    }

    public function administration()
    {
        $administration = User::where('role', 'staff')
            ->where('position', 'tata_usaha')
            ->paginate(10);
            
        return Inertia::render('Users/Administration', [
            'administration' => $administration
        ]);
    }

    public function toolman()
    {
        $toolman = User::where('role', 'staff')
            ->where('position', 'tool_man')
            ->paginate(10);
            
        return Inertia::render('Users/Toolman', [
            'toolman' => $toolman
        ]);
    }
}