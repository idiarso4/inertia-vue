<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Journal;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];
        $activities = [];

        switch ($user->role) {
            case 'teacher':
                $stats = [
                    'attendances_count' => Attendance::where('teacher_id', $user->id)->count(),
                    'pending_permissions' => Permission::whereHas('subject', function ($query) use ($user) {
                        $query->where('teacher_id', $user->id);
                    })->where('status', 'pending')->count()
                ];
                
                $activities = Attendance::with(['subject', 'classRoom'])
                    ->where('teacher_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($attendance) {
                        return [
                            'id' => $attendance->id,
                            'description' => "Presensi di kelas {$attendance->classRoom->name} - {$attendance->subject->name}",
                            'created_at' => $attendance->created_at,
                            'link' => route('attendances.show', $attendance->id)
                        ];
                    });
                break;

            case 'student':
                $stats = [
                    'permissions_count' => Permission::where('student_id', $user->id)->count(),
                    'journals_count' => Journal::where('student_id', $user->id)->count()
                ];
                
                $activities = Permission::with(['subject', 'classRoom'])
                    ->where('student_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($permission) {
                        return [
                            'id' => $permission->id,
                            'description' => "Pengajuan izin untuk {$permission->subject->name}",
                            'created_at' => $permission->created_at,
                            'link' => route('permissions.show', $permission->id)
                        ];
                    });
                break;

            case 'supervisor':
                $stats = [
                    'pending_journals' => Journal::where('supervisor_id', $user->id)
                        ->where('status', 'submitted')
                        ->count()
                ];
                
                $activities = Journal::with('student')
                    ->where('supervisor_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($journal) {
                        return [
                            'id' => $journal->id,
                            'description' => "Review jurnal dari {$journal->student->name}",
                            'created_at' => $journal->created_at,
                            'link' => route('journals.show', $journal->id)
                        ];
                    });
                break;
        }

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'activities' => $activities
        ]);
    }
} 