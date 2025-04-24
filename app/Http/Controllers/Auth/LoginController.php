<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.signin');
    }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->has('rememberMe');

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect berdasarkan user_role_id
            if (in_array($user->user_role_id, [1, 2, 3, 9])) {
                return redirect()->intended('dashboard');
            } elseif (in_array($user->user_role_id, [4])) {
                return redirect()->route('dashboard.sa');
            } elseif (in_array($user->user_role_id, [5])) {
                return redirect()->route('list-client-sa.index');
            } elseif (in_array($user->user_role_id, [7])) {
                return redirect()->route('dashboard.mb');
            } elseif (in_array($user->user_role_id, [8])) {
                return redirect()->route('clients-mb.index');
            } elseif ($user->user_role_id == 6) {
                return redirect()->route('data-client.index');
            }
        }

        return back()->withErrors(['message' => 'The provided credentials do not match our records.']);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/sign-in');
    }
}
