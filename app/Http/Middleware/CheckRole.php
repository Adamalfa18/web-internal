<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Pastikan pengguna terautentikasi
        if (!$user) {
            Log::warning('User is not authenticated.');
            return redirect('/unauthorized');
        }

        // Cek apakah peran pengguna ada dalam daftar peran yang diizinkan
        if (!in_array($user->user_role_id, $roles)) {
            Log::warning('Unauthorized access attempt by user with role ID: ' . $user->user_role_id);
            return redirect('/unauthorized');
        }

        return $next($request);
    }
} 
