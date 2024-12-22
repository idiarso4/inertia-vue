<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'class_room_id',
        'reason',
        'proof_file',
        'status',
        'teacher_notes',
        'supervisor_notes'
    ];

    protected $casts = [
        'teacher_approved_at' => 'datetime',
        'supervisor_approved_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    // Helper Methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApprovedByTeacher()
    {
        return $this->status === 'approved_by_teacher';
    }

    public function isRejectedByTeacher()
    {
        return $this->status === 'rejected_by_teacher';
    }

    public function isApprovedFinal()
    {
        return $this->status === 'approved_final';
    }

    public function isRejectedFinal()
    {
        return $this->status === 'rejected_final';
    }
}