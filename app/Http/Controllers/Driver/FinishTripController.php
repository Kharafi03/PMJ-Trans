<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;

class FinishTripController extends Controller
{
    //

    public function index()
    {
        //
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil trip dengan kondisi yang diperlukan
        $trip = TripBus::where('id_ms_trip', 2) // Saring trip berdasarkan id_ms_trip
            ->where(function ($query) use ($userId) {
                // Cek apakah id_driver atau id_codriver adalah ID pengguna yang sedang login
                $query->where('id_driver', $userId)
                    ->orWhere('id_codriver', $userId);
            })
            ->first(); // Ambil trip pertama yang cocok

        // Cek apakah trip ditemukan
        if (!$trip) {
            // Jika tidak ditemukan, kembalikan ke halaman utama
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Trip tidak ditemukan.',
                'alert-type' => 'error'
            ]);
        }

        return view('frontend.driver.finish-trip.index', compact('trip'));
    }

    public function kmEnd(Request $request, $tripId)
    {
        //
        $request->validate([
            'km_end' => 'required|numeric',
        ]);

        // $trip = TripBus::where('id', $tripId)->first();
        // $trip->km_end = $request->km_end;
        // $trip->id_ms_trip = 3;
        // $trip->save();

        // Temukan trip berdasarkan ID
        $trip = TripBus::findOrFail($tripId);
        // Update km_end
        $trip->km_end = $request->km_end;
        $trip->id_ms_trip = 3;
        $trip->save();

        // Update id_ms_user
        $driver = User::where('id', $trip->id_driver)->first();
        $driver->id_ms = 1;
        $driver->save();

        // Update id_ms_codriver
        $codriver = User::where('id', $trip->id_codriver)->first();
        $codriver->id_ms = 1;
        $codriver->save();

        // Update id_ms_bus pada bus yang terkait
        $bus = $trip->bus; // Ambil objek bus melalui relasi
        if ($bus) {
            $bus->ms_buses_id = 1; // Update kolom ms_buses_id di model Bus
            $bus->save();
        } else {
            return redirect()->back()->with([
                'message' => 'Bus tidak ditemukan!',
                'alert-type' => 'error'
            ]);
        }

        // Ambil semua trip buses yang terkait dengan booking
        $tripBuses = $trip->booking->tripbus; // Relasi tripbus ke booking

        // Cek apakah semua id_ms_trip adalah 3 (selesai)
        $allTripsCompleted = $tripBuses->every(function ($tripBus) {
            return $tripBus->id_ms_trip == 3; // 3 adalah status "selesai"
        });

        // Jika semua trip sudah selesai, update id_ms_booking menjadi 4 (selesai)
        if ($allTripsCompleted) {
            $booking = $trip->booking; // Ambil data booking melalui relasi
            $booking->id_ms_booking = 4; // 4 adalah status "selesai"
            $booking->save(); // Simpan perubahan
        }

        return redirect()->route('dashboard-driver')
            ->with([
                'message' => 'Kilometer akhir ditambahkan!, Trip selesai!',
                'alert-type' => 'success'
            ]);
    }
}
