@extends('frontend.layouts.app')
@push('styles')
    <title>Login</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/login-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    
    <!-- <div class="container-fluid mt-3">
        <a href="#" class="navbar-brand">
            <img src="img/logo.png" alt="Travelo Logo">
        </a>
    </div>
    
    <section id="login">
        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="header mb-5">
                        <h5>Login</h5>
                        <p><span>Gunakan nomor telepon yang aktif dan dapat dihubungi.</span> Jika Anda belum memiliki akun,
                            silakan <a href="{{ route('register') }}">Registrasi di sini.</a></p>
                    </div>

                    @include('frontend.assets.alert')

                    <div class="form-login>">
                        <form id="formLogin" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label for="number_phone" class="form-label">Nomor Telephone<span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="number_phone" name="number_phone"
                                    placeholder="Masukkan no telephone aktif" required>
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
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <div>
                                    <input type="checkbox" value="" id="ingatSaya">
                                    <label for="ingatSaya" class="label-ingat">Ingat Saya?</label>
                                </div>
                                <div>
                                    <a class="lupa-sandi" href="#">Lupa kata sandi?</a>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn-login">LogIn</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="right-side col-md-8 d-flex align-items-center justify-content-center col-img mb-3">
                    <img src="img/login-img.png" class="img-fluid" width="600px" height="700px">
                </div>
            </div>
        </div>
    </section> -->

        <section id="login">
            <div class="row">
                <!-- KIRI -->
                <div class="col-lg-6 col-md-12 order-md-last order-lg-first d-flex flex-column justify-content-center align-items-center">
                        <!-- FORM -->
                        <div class="form-container">
                            <div class="header mb-4">
                                <h5>Login</h5>
                                <p>Gunakan nomor telepon yang aktif dan dapat dihubungi.</p>
                            </div>

                            @include('frontend.assets.alert')

                            <div class="form-login">
                                <form id="formLogin" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="number_phone" class="form-label">Nomor WhatsApp<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="number_phone" name="number_phone" placeholder="Masukkan nomor whatsapp aktif" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                            <span class="input-group-text" id="toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center mb-5">
                                        <div class="lupa-sandi">
                                            <a href="{{ route('password.reset') }}">Lupa kata sandi?</a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="btn-login">Log In</button>
                                    </div>
                                    <div class="link-registrasi">
                                        <p>Belum punya akun?<a href="{{ route('register') }}"> Registrasi di sini.</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                </div>
                <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center col-img">
                    <img src="img/login-img.png" class="img-fluid" width="70%" height="auto">
                </div>
            </div>
        </section>


    <!-- SCRIPT -->
    <script>
        // MATA
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
@endsection
