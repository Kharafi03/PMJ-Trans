<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\TripBus;
use Carbon\Carbon;

class CheckDriverTripToday
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::id(); // Ambil ID driver yang sedang login
        $now = Carbon::now(); // Waktu sekarang

        $trip = TripBus::with('booking.ms_booking') // Memuat data booking dan msBooking
            ->where(function ($query) use ($userId) {
                // Filter berdasarkan driver dan co-driver
                $query->where('id_driver', $userId)
                    ->orWhere('id_codriver', $userId);
            })
            ->whereHas('booking.ms_booking', function ($query) {
                $query->where('name', 'Diterima'); // Filter untuk hanya menampilkan yang status "Diterima"
            })
            ->where('id_ms_trip', 1) // Tambahkan kondisi untuk id_ms_trip
            ->whereHas('booking', function ($query) use ($now) {
                $query->where(function ($query) use ($now) {
                    // Trip yang dimulai hari ini
                    $query->whereDate('date_start', $now->format('Y-m-d'))
                        ->where('date_start', '<=', $now) // Trip sudah dimulai
                        ->where('date_start', '>=', $now->subHours(16)); // Hingga 16 jam dari sekarang
                })->orWhere(function ($query) use ($now) {
                    // Trip yang dimulai keesokan harinya
                    $query->whereDate('date_start', $now->copy()->addDay()->format('Y-m-d'))
                        ->where('date_start', '>=', $now->copy()->setTime(0, 0)) // Trip mulai dari tengah malam
                        ->where('date_start', '<=', $now->copy()->addHours(16)); // Hingga 16 jam dari sekarang
                });
            })
            ->first();
            
        // Jika tidak ada trip yang ditemukan
        if (!$trip) {
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Tidak ada trip untuk hari ini atau sudah lewat waktu yang ditentukan!',
                'alert-type' => 'error'
            ]);
        }

        return $next($request);
    }
}
