<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use Carbon\Carbon;
use App\Models\Bus;
use Illuminate\Support\Facades\Auth;

class ScanTripController extends Controller
{
    //
    public function index()
    {
        return view('frontend.driver.scan-trip.index');
    }

    public function checkTripForBus(Request $request, $bus_code)
    {
        $today = Carbon::today();

        // dd($bus_code);

        // Cek apakah kode bus valid
        $bus = Bus::where('name', $bus_code)->first();

        if (!$bus) {
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Kode bus tidak valid.',
                'alert-type' => 'error'
            ]);
        }

        // Ambil id driver yang sedang login
        $idDriver = Auth::id(); // Pastikan ini mengembalikan id driver

        $now = Carbon::now();
        // Ambil data trip bus yang sesuai
        $trip = TripBus::with('booking.ms_booking') // Memuat data booking dan msBooking
            ->where(function ($query) use ($idDriver) {
                // Filter berdasarkan driver dan codriver
                $query->where('id_driver', $idDriver)
                    ->orWhere('id_codriver', $idDriver);
            })
            ->whereHas('booking.ms_booking', function ($query) {
                $query->where('name', 'Diterima'); // Filter untuk hanya menampilkan yang status "Diterima"
            })
            ->where('id_ms_trip', 1) // Tambahkan kondisi untuk id_ms_trip
            ->where('id_bus', $bus->id) // Menambahkan pengecekan apakah id bus sama dengan id_bus di tabel trip_buses
            ->whereHas('booking', function ($query) use ($now) {
                // Menambahkan logika untuk memeriksa apakah trip dimulai hari ini atau dalam rentang waktu sekarang
                $query->where(function($query) use ($now) {
                    $query->whereDate('date_start', '=', $now->toDateString())  // Memeriksa apakah trip dimulai hari ini
                        ->orWhere(function($query) use ($now) {
                            $query->where('date_start', '<=', $now)  // Memeriksa jika trip sudah dimulai
                                ->where('date_end', '>=', $now);  // Memeriksa jika trip belum berakhir
                        });
                });
            })
            ->first();
            
        if ($trip) {
            $request->session()->put('scanned', true);

            return redirect()->route('start-trip')->with([
                'message' => 'Berhasil scan bus ini!',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Tidak ada trip untuk bus ini di hari ini.',
                'alert-type' => 'error'
            ]);
        }
    }
}
