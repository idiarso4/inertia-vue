<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $journals = [];

        if ($user->isStudent()) {
            $journals = Journal::where('student_id', $user->id)
                ->with('supervisor')
                ->latest()
                ->paginate(10);
        } elseif ($user->isSupervisor()) {
            $journals = Journal::where('supervisor_id', $user->id)
                ->with('student')
                ->latest()
                ->paginate(10);
        }

        return Inertia::render('Journals/Index', [
            'journals' => $journals
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_date' => 'required|date',
            'activity_description' => 'required|string|min:10',
            'documentation' => 'nullable|file|max:2048'
        ]);

        if ($request->hasFile('documentation')) {
            $path = $request->file('documentation')->store('journal-docs', 'public');
            $validated['documentation'] = $path;
        }

        $validated['student_id'] = Auth::id();
        $validated['supervisor_id'] = Auth::user()->supervisor_id;
        $validated['status'] = 'draft';

        Journal::create($validated);

        return redirect()->route('journals.index')
            ->with('message', 'Jurnal berhasil dibuat.');
    }

    public function update(Request $request, Journal $journal)
    {
        $user = Auth::user();

        if ($user->isStudent() && $journal->status === 'draft') {
            $validated = $request->validate([
                'activity_description' => 'required|string|min:10',
                'documentation' => 'nullable|file|max:2048'
            ]);

            if ($request->hasFile('documentation')) {
                $path = $request->file('documentation')->store('journal-docs', 'public');
                $validated['documentation'] = $path;
            }

            $validated['status'] = 'submitted';
            $journal->update($validated);

        } elseif ($user->isSupervisor()) {
            $validated = $request->validate([
                'status' => 'required|in:approved,rejected',
                'supervisor_feedback' => 'required|string'
            ]);

            $journal->update([
                'status' => $validated['status'],
                'supervisor_feedback' => $validated['supervisor_feedback'],
                'validated_at' => now()
            ]);
        }

        return back()->with('message', 'Jurnal berhasil diupdate.');
    }
}