<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class BookingCodeController extends Controller
{
    public function show($booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->first();

        if (!$booking || $booking->id_cus !== Auth::id()) {
            return redirect()->back()->with([
                'message' => 'Booking tidak ditemukan!',
                'alert-type' => 'error'
            ]);
        }

        $user = $booking->customer;

        $showPasswordModal = Hash::check('12345678', $user->password);

        $destinations = Destination::where('id_booking', $booking->id)->get();

        // Cek apakah booking ditemukan dan customer memiliki email dan ticket_sent = false
        if ($booking && !$booking->email_tiket && $booking->customer->email != null) {
            // Kirim email e-ticket kepada customer
            $setting = Setting::all();
            // dd($setting);
            Mail::send('vendor.mail.ticket-email', compact('booking', 'destinations', 'setting'), function ($message) use ($booking) {
                $message->to($booking->customer->email, $booking->customer->name)
                    ->subject('E-Ticket PMJ Trans - ' . $booking->booking_code);
            });

            // Update kolom email_tiket menjadi true
            $booking->email_tiket = true;
            $booking->save();
        }

        return view('frontend.booking-code.index', compact('booking', 'destinations', 'showPasswordModal'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',        // At least one lowercase letter
                'regex:/[A-Z]/',        // At least one uppercase letter
                'regex:/[0-9]/',        // At least one digit
                'regex:/[@$!%*?&]/',    // At least one symbol
            ],
            'konfirmasi_password' => 'required|same:new_password'
        ], [
            'new_password.required' => 'Password baru harus diisi!',
            'new_password.min' => 'Harap mengisikan password minimal 8 karakter!',
            'new_password.regex' => 'Password harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu simbol!',
            'konfirmasi_password.required' => 'Konfirmasi password harus diisi!',
            'konfirmasi_password.same' => 'Konfirmasi password harus sama dengan password baru!',
        ]);

        /** @var \App\Models\User $user **/

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with([
            'message' => 'Password Berhasil Diperbarui!',
            'alert-type' => 'success',
            'passwordUpdated' => true
        ]);
    }
}
