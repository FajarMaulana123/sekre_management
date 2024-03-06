<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return '/login';
        }

        if (!isLoggedIn()) {
            Auth::logout();
            return redirect('login')->with('error', "Maaf, Akun Tidak Memiliki Akses Harap hubungi Administrator !!");
        }

        $user = Auth::user();

        if ($user) {
            return $next($request);
        }

        return redirect('login')->with('error', "Kamu gak punya akses yaaa..");
        //
    }
}
