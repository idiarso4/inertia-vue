<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = [
        'name',
        'code',
        'level',
        'major',
        'capacity',
        'homeroom_teacher_id'
    ];

    public function homeroomTeacher()
    {
        return $this->belongsTo(User::class, 'homeroom_teacher_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    // Generate QR Code untuk kelas
    public function generateQrCode()
    {
        // Implementation akan ditambahkan nanti
        return "QR-{$this->code}-" . date('Y-m-d');
    }
}