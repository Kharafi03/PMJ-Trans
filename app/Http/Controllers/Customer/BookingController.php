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
            'email' => 'email|max:255',
            'number_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'destination_point' => 'required|string',
            'capacity' => 'required|integer',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'fleet_amount' => 'required|integer',
            'pickup_point' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke tabel users
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('12345678'), // Anda dapat menggunakan password default atau meminta input password
            'number_phone' => $request->input('number_phone'),
            'id_ms' => '1',
            'address' => $request->input('address'),
        ]);

        $booking_code = 'PMJ-' . strtoupper(\Illuminate\Support\Str::random(4)) . rand(1000, 9999);

        // Simpan data ke tabel booking
        Booking::create([
            'booking_code' => $booking_code,
            'id_cus' => $user->id,
            'destination_point' => $request->input('destination_point'),
            'capacity' => $request->input('capacity'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'fleet_amount' => $request->input('fleet_amount'),
            'pickup_point' => $request->input('pickup_point'),
            'id_ms_booking' => '1',
            'id_ms_payment' => '1',
        ]);

         // Login otomatis setelah akun dibuat
        Auth::login($user);

        return redirect()->route('homepage')
            ->with('message', 'Pemesanan Berhasil.')
            ->with('alert-type', 'success');
    }
}
