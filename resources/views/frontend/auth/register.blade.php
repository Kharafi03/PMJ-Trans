@extends('frontend.layouts.app')
@push('styles')
    <title>Registrasi</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/register-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    
    <!-- <div class="container-fluid p-3">
        <a href="#" class="navbar-brand">
            <img src="img/logo.png" alt="Travelo Logo">
        </a>
    </div>
    
    <section id="register">
        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="header mb-3">
                        <h5>Registrasi</h5>
                        <p>Jika Anda sudah memiliki akun, silakan <a href="{{ route('login') }}">Login di sini.</a></p>
                    </div>
                    @include('frontend.assets.alert')
                    
                    <div class="form-login>">
                        <form id="formRegistrasi" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="number_phone" class="form-label">Nomor WhatsApp<span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="number_phone" name="number_phone"
                                    placeholder="Masukkan nomor whatsapp" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap<span
                                        class="rtext-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama lengkap anda" required>
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukkan Password" required>
                                    <span class="input-group-text" id="toggle-password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center mb-5">
                                <div class="lupa-sandi">
                                    <a href="#">Lupa kata sandi?</a>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn-register">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center justify-content-center col-img mb-3">
                    <img src="img/pmj03-1.jpg" class="img-fluid" width="600px" height="700px">
                </div>
            </div>
        </div>
    </section> -->

    <section id="register">
            <div class="row">
                <!-- KIRI -->
                <div class="col-lg-6 col-md-12 order-md-last order-lg-first d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeInLeft">
                        <!-- FORM -->
                        <div class="form-container">
                            <div class="header mb-3">
                                <h5>Registrasi</h5>
                            </div>

                            @include('frontend.assets.alert')

                            <div class="form-registrasi">
                                <form id="formRegistrasi" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="number_phone" class="form-label">Nomor WhatsApp<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="number_phone" name="number_phone" placeholder="Masukkan nomor whatsapp" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap anda" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                            <span class="input-group-text @error('password') text-danger border-danger @enderror" id="toggle-password"><i class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                        <textarea class="form-control" placeholder="Masukkan alamat Lengkap" id="address" name="address" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <ul>
                                            <li style="font-size:14px; color:#4180CC; font-weight: 600;">
                                                Masukan alamat anda dengan benar
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mb-5">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" placeholder="Masukkan alamat email" id="email" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn-register">Registrasi</button>
                                    </div>
                                    <div class="link-login">
                                        <p>Jika Anda sudah memiliki akun, silakan<a href="{{ route('login') }}"> Log in di sini.</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center col-img wow animate__animated animate__fadeInRight">
                    <div class="background d-flex align-items-center justify-content-center">
                        <img src="img/register-img.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

    <!-- SCRIPT -->
    <script>
        //MATA
        const togglePassword = document.querySelector('#toggle-password');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        new WOW().init();
    </script>
@endsection
