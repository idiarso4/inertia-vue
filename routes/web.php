<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::get('/student/dashboard', function () {
        return Inertia::render('Student/Dashboard');
    })->name('student.dashboard');

    Route::get('/teacher/dashboard', function () {
        return Inertia::render('Teacher/Dashboard');
    })->name('teacher.dashboard');
});

require __DIR__.'/auth.php';