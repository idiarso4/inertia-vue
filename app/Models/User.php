<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'nip',
        'nis',
        'position',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if user has specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Relationships
    public function teacherSubjects()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }

    public function homerooms()
    {
        return $this->hasMany(ClassRoom::class, 'homeroom_teacher_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'teacher_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'student_id');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'student_id');
    }

    public function supervisedJournals()
    {
        return $this->hasMany(Journal::class, 'supervisor_id');
    }

    // Helper Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}