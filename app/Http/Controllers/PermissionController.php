<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Subject;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permissions = [];

        if ($user->isStudent()) {
            $permissions = Permission::with(['subject', 'classRoom'])
                ->where('student_id', $user->id)
                ->latest()
                ->paginate(10);
        } elseif ($user->isTeacher()) {
            $permissions = Permission::with(['student', 'subject', 'classRoom'])
                ->whereHas('subject', function ($query) use ($user) {
                    $query->where('teacher_id', $user->id);
                })
                ->latest()
                ->paginate(10);
        } else {
            $permissions = Permission::with(['student', 'subject', 'classRoom'])
                ->latest()
                ->paginate(10);
        }

        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        $subjects = Subject::all();
        $classRooms = ClassRoom::all();

        return Inertia::render('Permissions/Create', [
            'subjects' => $subjects,
            'classRooms' => $classRooms
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'reason' => 'required|string|min:10',
            'proof_file' => 'nullable|file|max:2048'
        ]);

        if ($request->hasFile('proof_file')) {
            $path = $request->file('proof_file')->store('proof-files', 'public');
            $validated['proof_file'] = $path;
        }

        $validated['student_id'] = Auth::id();
        $validated['status'] = 'pending';

        Permission::create($validated);

        return redirect()->route('permissions.index')
            ->with('message', 'Pengajuan izin berhasil dibuat.');
    }

    public function update(Request $request, Permission $permission)
    {
        $user = Auth::user();
        
        if ($user->isTeacher()) {
            $validated = $request->validate([
                'status' => 'required|in:approved_by_teacher,rejected_by_teacher',
                'teacher_notes' => 'required|string'
            ]);

            $permission->update([
                'status' => $validated['status'],
                'teacher_notes' => $validated['teacher_notes'],
                'teacher_approved_at' => now()
            ]);
        } elseif ($user->isSupervisor()) {
            $validated = $request->validate([
                'status' => 'required|in:approved_final,rejected_final',
                'supervisor_notes' => 'required|string'
            ]);

            $permission->update([
                'status' => $validated['status'],
                'supervisor_notes' => $validated['supervisor_notes'],
                'supervisor_approved_at' => now()
            ]);
        }

        return back()->with('message', 'Status perizinan berhasil diupdate.');
    }
}