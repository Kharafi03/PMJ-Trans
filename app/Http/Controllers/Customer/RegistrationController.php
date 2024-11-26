<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle the registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input form
        $this->validator($request->all())->validate();

        // Simpan data user baru
        $user = $this->create($request->all());

        // Login otomatis setelah registrasi berhasil
        Auth::login($user); // Menggunakan Auth::login

        // Redirect ke halaman dashboard atau sesuai keinginan
        return redirect()->route('homepage')
            ->with('message', 'Registrasi Berhasil!')
            ->with('alert-type', 'success');
    }

    /**
     * Validasi data yang diterima.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'number_phone' => ['required', 'string', 'max:15', 'unique:users,number_phone'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',        // At least one lowercase letter
                'regex:/[A-Z]/',        // At least one uppercase letter
                'regex:/[0-9]/',        // At least one digit
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // At least one special character
            ],
            'address' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama wajib diisi!',
            'name.max' => 'Harap mengisikan Nama maksimal 255 karakter!',
            'number_phone.required' => 'Nomor WhatsApp wajib diisi!',
            'number_phone.max' => 'Nomor WhatsApp tidak boleh lebih dari 15 digit!',
            'number_phone.unique' => 'Nomor WhatsApp ini sudah terdaftar, silakan gunakan nomor lain!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email ini sudah terdaftar, silakan gunakan email lain!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Harap mengisikan password minimal 8 karakter',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu simbol!',
            'address.required' => 'Alamat wajib diisi!',
            'address.max' => 'Harap mengisikan Alamat maksimal 255 karakter!',
        ]);        
    }


    /**
     * Buat user baru setelah validasi berhasil.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'number_phone' => $data['number_phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_ms' => 1,
            'address' => $data['address'],
        ]);
    }
}
