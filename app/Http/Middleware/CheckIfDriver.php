<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfDriver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna terautentikasi dan memiliki role 'Driver'
        if (Auth::check() && Auth::user()->roles->first()->name === 'Driver') {
            return $next($request);
        }

        // Jika tidak memiliki akses, redirect ke halaman lain (misalnya homepage)
        return redirect()->route('homepage')->with([
            'message' => 'Anda harus login sebagai Driver terlebih dahulu.',
            'alert-type' => 'error',
        ]);
    }
}
