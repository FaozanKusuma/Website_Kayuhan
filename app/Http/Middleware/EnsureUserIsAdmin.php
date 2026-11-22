<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure$next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $role = strtolower(trim(Auth::user()->role ?? ''));

        if (in_array($role, ['employee', 'karyawan', 'barista'])) {
            return redirect()->route('employee.dashboard');
        }

        return $next($request);
    }
}