<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $userRole = auth()->user()->role;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Default redirect based on role if unauthorized for this specific route
        return match ($userRole) {
            'admin' => redirect()->route('admin.dashboard'),
            'instructor' => redirect()->route('instructor.dashboard'),
            default => redirect()->route('student.dashboard'),
        };
    }
}
