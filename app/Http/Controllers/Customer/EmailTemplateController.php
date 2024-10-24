<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Setting;

class EmailTemplateController extends Controller
{
    //
    public function showTicketEmail()
    {
        // Dummy data untuk template email, Anda bisa menyesuaikan sesuai dengan kebutuhan
        $booking = Booking::first(); // Mengambil satu data booking sebagai contoh
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $setting = Setting::all();
        // dd($setting);

        // Kembalikan view yang digunakan untuk email dengan data dummy
        return view('vendor.mail.ticket-email', compact('booking', 'destinations', 'setting'));
    }
}
