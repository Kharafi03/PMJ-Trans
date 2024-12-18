@extends('frontend.layouts.app')
@push('styles')
    <title>Login</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/login-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
        <section id="login">
            <div class="row">
                <!-- KIRI -->
                <div class="col-lg-6 col-md-12 order-md-last order-lg-first d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeInLeft">
                        <!-- FORM -->
                        <div class="form-container">
                            <div class="header mb-4">
                                <h5>Log in</h5>
                                <p>Gunakan nomor telepon yang aktif dan dapat dihubungi.</p>
                            </div>

                            @include('frontend.assets.alert')

                            <div class="form-login">
                                <form id="formLogin" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="number_phone" class="form-label">Nomor WhatsApp<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('number_phone') is-invalid @enderror" id="number_phone" name="number_phone" placeholder="Masukkan nomor whatsapp aktif" required>
                                        @error('number_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>
                                    <div class="mb-2">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" required>
                                            <span class="input-group-text @error('password') text-danger border-danger @enderror" id="toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center mb-5">
                                        <div class="lupa-sandi">
                                            <a href="{{ route('password.reset') }}">Lupa password?</a>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn-login">Log in</button>
                                    </div>
                                    <div class="link-registrasi">
                                        <p>Belum punya akun?<a href="{{ route('register') }}"> Registrasi di sini.</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                </div>
                <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center col-img wow animate__animated animate__fadeInRight">
                    <div class="background d-flex align-items-center justify-content-center">
                        <img src="img/login-img.png" class="img-fluid">
                    </div>
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
    <script>
        new WOW().init();
    </script>
@endsection
