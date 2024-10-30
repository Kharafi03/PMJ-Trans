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

    public function showDpTicket()
    {
        // Dummy data untuk template email, Anda bisa menyesuaikan sesuai dengan kebutuhan
        $booking = Booking::first(); // Mengambil satu data booking sebagai contoh
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $setting = Setting::all();
        // dd($setting);

        // Kembalikan view yang digunakan untuk email dengan data dummy
        return view('vendor.mail.dpbelumdibayar-email', compact('booking', 'destinations', 'setting'));
    }

    public function showDpbelumdibayar()
    {
        // Dummy data untuk template email, Anda bisa menyesuaikan sesuai dengan kebutuhan
        $booking = Booking::first(); // Mengambil satu data booking sebagai contoh
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $setting = Setting::all();
        // dd($setting);

        // Kembalikan view yang digunakan untuk email dengan data dummy
        return view('vendor.mail.dpbelumdibayar-email', compact('booking', 'destinations', 'setting'));
    }

    public function showDpdibayar()
    {
        // Dummy data untuk template email, Anda bisa menyesuaikan sesuai dengan kebutuhan
        $booking = Booking::first(); // Mengambil satu data booking sebagai contoh
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $setting = Setting::all();
        // dd($setting);

        // Kembalikan view yang digunakan untuk email dengan data dummy
        return view('vendor.mail.dpdibayarkan-email', compact('booking', 'destinations', 'setting'));
    }

    public function showLunas()
    {
        // Dummy data untuk template email, Anda bisa menyesuaikan sesuai dengan kebutuhan
        $booking = Booking::first(); // Mengambil satu data booking sebagai contoh
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $setting = Setting::all();
        // dd($setting);

        // Kembalikan view yang digunakan untuk email dengan data dummy
        return view('vendor.mail.lunas-email', compact('booking', 'destinations', 'setting'));
    }

    public function showDibatalkan()
    {
        // Dummy data untuk template email, Anda bisa menyesuaikan sesuai dengan kebutuhan
        $booking = Booking::first(); // Mengambil satu data booking sebagai contoh
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $setting = Setting::all();
        // dd($setting);

        // Kembalikan view yang digunakan untuk email dengan data dummy
        return view('vendor.mail.dibatalkan-email', compact('booking', 'destinations', 'setting'));
    }

    public function showDitolak()
    {
        // Dummy data untuk template email, Anda bisa menyesuaikan sesuai dengan kebutuhan
        $booking = Booking::first(); // Mengambil satu data booking sebagai contoh
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $setting = Setting::all();
        // dd($setting);

        // Kembalikan view yang digunakan untuk email dengan data dummy
        return view('vendor.mail.ditolak-email', compact('booking', 'destinations', 'setting'));
    }
}
