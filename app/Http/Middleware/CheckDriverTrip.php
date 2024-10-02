<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\TripBus;

class CheckDriverTrip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $booking_code = $request->route('booking_code'); // Ambil booking_code dari route
        $userId = Auth::id(); // Ambil ID driver yang sedang login

        // Cek apakah ada trip dengan booking_code dan apakah driver atau co-driver memiliki akses ke booking tersebut
        $trip = TripBus::whereHas('booking', function ($query) use ($booking_code) {
            $query->where('booking_code', $booking_code);
        })
        ->where(function ($query) use ($userId) {
            $query->where('id_driver', $userId) // Cek apakah id_driver sesuai dengan driver yang sedang login
                  ->orWhere('id_codriver', $userId); // Atau cek apakah id_codriver sesuai
        })
        ->first();

        if (!$trip) {
            // Jika tidak ada, redirect ke halaman lain dengan pesan error
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Trip tidak ditemukan atau Anda tidak memiliki akses.',
                'alert-type' => 'error'
            ]);
        }

        return $next($request);
    }
}