<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; // Pastikan Anda membuat model Booking
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //
    // Menampilkan formulir pemesanan
    public function showForm()
    {
        return view('frontend.booking.index');
    }

    // Menangani data formulir pemesanan
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'email|max:255|nullable',
            'number_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'destination_point' => 'required|string',
            'capacity' => 'required|integer',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'pickup_point' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Gunakan id user yang sudah login
            $user = Auth::user();
        } else {
            // Simpan data ke tabel users jika belum login
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make('12345678'), // Default password
                'number_phone' => $request->input('number_phone'),
                'id_ms' => '1',
                'address' => $request->input('address'),
            ]);

            // Login otomatis setelah akun dibuat
            Auth::login($user);
        }

        $booking_code = 'PMJ-' . strtoupper(\Illuminate\Support\Str::random(4)) . rand(1000, 9999);

        // Simpan data ke tabel booking
        Booking::create([
            'booking_code' => $booking_code,
            'id_cus' => $user->id, // Gunakan id dari user yang login
            'destination_point' => $request->input('destination_point'),
            'capacity' => $request->input('capacity'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'pickup_point' => $request->input('pickup_point'),
            'id_ms_booking' => '1',
            'id_ms_payment' => '1',
        ]);

        return redirect()->route('booking.code', ['booking_code' => $booking_code])
            ->with('message', 'Pemesanan Berhasil.')
            ->with('alert-type', 'success');
    }
}
