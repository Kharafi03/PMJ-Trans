<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; // Pastikan Anda membuat model Booking
use App\Models\Destination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan ini

use App\Models\Bus;

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
            // 'destination_point' => 'required|string',
            'capacity' => 'required|integer',
            'date_start' => 'required|date',
            'pickup_point' => 'required|string',
            'tujuan' => 'array|nullable', // Mengubah validasi tujuan agar menjadi array
            'tujuan.*' => 'string|nullable', // Setiap tujuan harus berupa string atau nullable
            'legrest' => 'boolean|required',  // Validasi legrest sebagai boolean
            'description' => 'string|nullable',  // Deskripsi bersifat opsional
        ]);

        // dd($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil semua bus yang tersedia dengan ms_buses_id != 2
        $availableBuses = Bus::where('ms_buses_id', '!=', 2)->get();
        $totalRequestedCapacity = $request->input('capacity'); // Ambil kapasitas yang diminta

        // Ambil date_start dari input
        $dateStart = $request->input('date_start');

        // Cek semua booking yang sudah diterima admin untuk bus ini
        $totalBookedCapacity = DB::table('bookings')
            ->where('id_ms_booking', '=', '2') // Sudah diterima admin
            ->where(function ($query) use ($dateStart) {
                $query->where(function ($subQuery) use ($dateStart) {
                    // Jika date_end tidak ada (null), cek hanya date_start
                    $subQuery->whereNull('bookings.date_end')
                        ->whereDate('bookings.date_start', '=', \Carbon\Carbon::parse($dateStart)->toDateString());
                })
                    ->orWhere(function ($subQuery) use ($dateStart) {
                        // Jika date_end ada, cek rentang dari date_start sampai date_end
                        $subQuery->whereNotNull('bookings.date_end')
                            ->whereDate('bookings.date_start', '<=', \Carbon\Carbon::parse($dateStart)->toDateString())
                            ->whereDate('bookings.date_end', '>=', \Carbon\Carbon::parse($dateStart)->toDateString());
                    });
            })
            ->select('capacity')
            ->first();

        $capacitybooked = $totalBookedCapacity ? $totalBookedCapacity->capacity : 0;

        // Hitung total kapasitas semua bus yang tersedia
        $totalCapacityAvailable = $availableBuses->sum('capacity'); // Total kapasitas semua bus yang ada

        // Hitung kapasitas tersisa
        $totalRemainingCapacity = $totalCapacityAvailable - $capacitybooked;

        // Hitung bus yang dibutuhkan untuk memenuhi permintaan
        $neededBuses = 0;
        $currentCapacity = 0;

        // Hitung bus yang dibutuhkan untuk memenuhi permintaan
        foreach ($availableBuses as $bus) {
            $currentCapacity += $bus->capacity; // Tambah kapasitas dari bus yang tersedia
            if ($currentCapacity >= $totalRequestedCapacity) {
                $neededBuses++; // Bus yang dibutuhkan untuk memenuhi permintaan
                break; // Hentikan loop jika kapasitas sudah cukup
            }
            $neededBuses++; // Menghitung jumlah bus yang dibutuhkan
        }

        // Hitung jumlah bus yang sudah terpakai berdasarkan kapasitas yang terbooking
        $remainingCapacityToBook = $capacitybooked; // Menggunakan kapasitas yang terbooking
        $busesUsed = 0;

        // Menghitung berapa banyak bus yang digunakan
        foreach ($availableBuses as $bus) {
            if ($remainingCapacityToBook <= 0) {
                break; // Hentikan jika sudah tidak ada kapasitas yang perlu dipenuhi
            }

            // Tambahkan bus yang digunakan
            $busesUsed++;
            // Kurangi kapasitas yang terbooking dengan kapasitas bus yang digunakan
            $remainingCapacityToBook -= $bus->capacity;
        }

        // Hitung total bus yang tersedia
        $totalBusesAvailable = $availableBuses->count();

        // Hitung sisa bus yang tersedia
        $remainingBuses = $totalBusesAvailable - $busesUsed;

        // Debug informasi
        // dd(
        //     "Total kapasitas terbooking: $capacitybooked",
        //     "Total kapasitas semua bus yang tersedia: $totalCapacityAvailable",
        //     "Total kapasitas tersisa: $totalRemainingCapacity",
        //     "Total kapasitas yang diminta: $totalRequestedCapacity",
        //     "Jumlah bus yang terpakai: $busesUsed",
        //     "Jumlah bus yang tersisa: $remainingBuses",
        //     "Jumlah bus yang dibutuhkan untuk memenuhi permintaan: $neededBuses",
        //     "Apakah ada cukup bus? $remainingBuses >= $neededBuses",
        //     $remainingBuses >= $neededBuses,
        //     "Apakah kapasitas bus dapat memenuhi yang diminta? $totalRequestedCapacity <= $totalRemainingCapacity",
        //     $totalRequestedCapacity <= $totalRemainingCapacity,

        //     "maka: $remainingBuses < $neededBuses || $totalRequestedCapacity > $totalRemainingCapacity",
        //     $remainingBuses < $neededBuses || $totalRequestedCapacity > $totalRemainingCapacity
        // );

        if ($remainingBuses < $neededBuses || $totalRequestedCapacity > $totalRemainingCapacity) {
            return redirect()->back()
                ->withErrors(['capacity' => 'Tidak ada cukup bus yang tersedia untuk memenuhi permintaan!, Silakan hubungi admin untuk informasi lebih lanjut.'])
                ->withInput()
                ->with([
                    'message' => 'Tidak ada cukup bus yang tersedia untuk memenuhi permintaan! Silakan hubungi admin untuk informasi lebih lanjut.',
                    'alert-type' => 'error',
                ]);
        }

        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Gunakan id user yang sudah login
            $user = Auth::user();
        } else {

            // Pengecekan apakah email atau nomor telepon sudah terdaftar
            $existingUser = User::where('email', $request->input('email'))
                ->orWhere('number_phone', $request->input('number_phone'))
                ->first();

            // Jika pengguna ditemukan berdasarkan email atau nomor telepon
            if ($existingUser) {
                // Menambahkan error untuk email dan nomor telepon
                $errors = [];
                if ($existingUser->email == $request->email) {
                    $errors['email'] = 'Email sudah terdaftar, silakan login terlebih dahulu!';
                }
                if ($existingUser->number_phone == $request->number_phone) {
                    $errors['number_phone'] = 'Nomor telepon sudah terdaftar, silakan login terlebih dahulu!';
                }

                return redirect()->back()->withErrors($errors)->withInput()
                    ->with([
                        'message' => 'Email atau nomor telepon sudah terdaftar, silakan login terlebih dahulu!',
                        'alert-type' => 'error',
                    ]);
            }

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
        $booking = Booking::create([
            'booking_code' => $booking_code,
            'id_cus' => $user->id, // Gunakan id dari user yang login
            'capacity' => $request->input('capacity'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'pickup_point' => $request->input('pickup_point'),
            'id_ms_booking' => '1',
            'id_ms_payment' => '1',
            'description' => $request->input('description'),
            'legrest' => $request->input('legrest')
        ]);

        // Ambil semua input 'tujuan' sebagai array
        $tujuanArray = $request->input('tujuan'); // Menghasilkan array

        // Simpan setiap tujuan sebagai data baru di tabel 'Destination' dengan id_booking
        if ($tujuanArray && is_array($tujuanArray)) {
            foreach ($tujuanArray as $tujuan) {
                Destination::create([
                    'id_booking' => $booking->id, // Mengambil id dari booking yang baru saja disimpan
                    'name' => $tujuan, // Nama tujuan dari input
                ]);
            }
        }

        return redirect()->route('booking.code', ['booking_code' => $booking_code])
            ->with([
                'message' => 'Booking berhasil dibuat!',
                'alert-type' => 'success',
            ]);
    }
}
