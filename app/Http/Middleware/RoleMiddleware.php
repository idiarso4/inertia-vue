<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            if ($request->user()) {
                switch ($request->user()->role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'student':
                        return redirect()->route('student.dashboard');
                    case 'teacher':
                        return redirect()->route('teacher.dashboard');
                }
            }
            return redirect()->route('login');
        }

        return $next($request);
    }
} 