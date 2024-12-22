<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $attendances = Attendance::with(['subject', 'classRoom'])
            ->where('teacher_id', $user->id)
            ->latest()
            ->paginate(10);

        return Inertia::render('Attendances/Index', [
            'attendances' => $attendances
        ]);
    }

    public function create()
    {
        $subjects = Subject::where('teacher_id', Auth::id())->get();
        $classRooms = ClassRoom::all();

        return Inertia::render('Attendances/Create', [
            'subjects' => $subjects,
            'classRooms' => $classRooms
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'teaching_material' => 'required|string',
            'teaching_method' => 'required|string',
            'notes' => 'nullable|string',
            'documentation' => 'nullable|file|max:2048'
        ]);

        if ($request->hasFile('documentation')) {
            $path = $request->file('documentation')->store('documentations', 'public');
            $validated['documentation'] = $path;
        }

        $validated['teacher_id'] = Auth::id();
        $validated['check_in_time'] = now();
        $validated['status'] = 'hadir';

        Attendance::create($validated);

        return redirect()->route('attendances.index')
            ->with('message', 'Presensi berhasil dicatat.');
    }

    public function update(Request $request, Attendance $attendance)
    {
        if (!$attendance->check_out_time) {
            $attendance->update([
                'check_out_time' => now(),
                'notes' => $request->input('notes')
            ]);
        }

        return back()->with('message', 'Presensi berhasil diupdate.');
    }
}