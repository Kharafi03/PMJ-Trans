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
        // Jika user belum login
        if (!Auth::check()) {
            // Jika user mencoba mengakses /driver, arahkan ke /driver/login
            if ($request->is('driver')) {
                return redirect()->route('driver.login');
            }
        } else {
            // Jika user sudah login, pastikan role-nya adalah 'Driver'
            $userRole = Auth::user()->roles->first()->name;
            
            // Jika user adalah driver
            if ($userRole === 'Driver' || $userRole === 'Kru') {
                // Jika user mencoba mengakses /driver/login, arahkan ke dashboard driver
                if ($request->is('driver/login')) {
                    return redirect()->route('dashboard-driver');
                }

                // Jika user mencoba mengakses /driver, arahkan juga ke dashboard driver
                if ($request->is('driver')) {
                    return redirect()->route('dashboard-driver');
                }

                // Lanjutkan request jika tidak ada masalah
                return $next($request);
            } else {
                // Jika user bukan driver, arahkan ke halaman lain
                return redirect()->route('homepage')->with([
                    'message' => 'Anda harus login sebagai Driver terlebih dahulu.',
                    'alert-type' => 'error',
                ]);
            }
        }

        // Jika bukan Driver atau belum login, arahkan ke halaman lain
        return redirect()->route('homepage')->with([
            'message' => 'Anda harus login sebagai Driver terlebih dahulu.',
            'alert-type' => 'error',
        ]);
    }
}