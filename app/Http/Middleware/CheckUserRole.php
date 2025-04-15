<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        
        // Jika pengguna tidak terautentikasi
        if (!$user) {
            return redirect()->route('unauthorized');
        }

        // Memeriksa apakah user_role_id ada dalam daftar yang diizinkan
        if (in_array($user->user_role_id, $roles)) {
            return $next($request);
        }

        // Jika role 4 atau 5 mencoba mengakses halaman 1, 2, atau 3
        if (in_array($user->user_role_id, [4, 5]) && in_array($request->route()->getName(), ['dashboard'])) {
            return redirect()->route('unauthorized');
        }

        return redirect()->route('unauthorized'); // Redirect ke halaman unauthorized
    }
}
