<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Ensure the user has the 'admin' role
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.login')->withErrors(['email' => 'Недостаточно прав для доступа к этой странице.']);
        }

        return $next($request);
    }

}
