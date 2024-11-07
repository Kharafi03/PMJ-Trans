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
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',        // At least one lowercase letter
                'regex:/[A-Z]/',        // At least one uppercase letter
                'regex:/[0-9]/',        // At least one digit
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // At least one special character
            ],
        ], [
            'name.required' => 'Nama wajib diisi!',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter!',
            'number_phone.required' => 'Nomor WhatsApp wajib diisi!',
            'number_phone.max' => 'Nomor WhatsApp tidak boleh lebih dari 15 digit!',
            'number_phone.unique' => 'Nomor WhatsApp ini sudah terdaftar, silakan gunakan nomor lain!',
            'password.required' => 'Kata sandi wajib diisi!',
            'password.min' => 'Kata sandi harus minimal 8 karakter!',
            'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu simbol!',
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
            'password' => Hash::make($data['password']),
            'id_ms' => 1,
        ]);
    }
}
