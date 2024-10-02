<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyScan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('scanned')) {
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Silahkan Scan Bus Terlebih Dahulu',
                'alert-type' => 'warning'
            ]);
        }

        return $next($request);
    }
}
