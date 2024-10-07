<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\TripBus;
use Illuminate\Http\Request;
use App\Models\Destination;

class DetailTripController extends Controller
{
    //
    public function showDetail($booking_code)
    {
        // Ambil data trip berdasarkan booking_code, dan muat data booking, bus, dan driver terkait
        $trip = TripBus::with(['booking', 'bus', 'driver', 'codriver']) // Pastikan driver juga dimuat
            ->whereHas('booking', function ($query) use ($booking_code) {
                $query->where('booking_code', $booking_code);
            })
            ->firstOrFail(); // Jika tidak ada, akan memunculkan 404

        // Ambil data customer jika ada relasi dengan booking
        $customer = $trip->booking->customer; // Misalnya jika ada relasi dengan customer

        $destination = Destination::where('id_booking', $trip->booking->id)->get();

        return view('frontend.driver.dashboard-detail.index', compact('trip', 'customer', 'destination'));
    }
}
