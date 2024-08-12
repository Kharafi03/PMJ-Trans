<!-- resources/views/auth/login.blade.php -->
@extends('frontend.layout.app')

@section('content')
    <main class="main-content mt-0">
        <section id="login" class="min-vh-100">
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Login</h4>
                                    <p class="mb-0">Masukkan email dan password Anda!</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" class="text-start" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="email" name="email"
                                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                    placeholder="{{ __('Masukan Email Anda') }}" required
                                                    autocomplete="email">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-envelope text-primary text-lg"></i>
                                                </span>
                                                @error('email')
                                                    <span class="error invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="password" id="password" name="password"
                                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                    placeholder="{{ __('Masukan Password Anda') }}" required
                                                    autocomplete="current-password">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-eye-slash text-primary text-lg"
                                                        id="togglePassword" style="cursor: pointer;"></i>
                                                </span>
                                                @error('password')
                                                    <span class="error invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                            <label class="form-check-label" for="rememberMe">Ingatkan saya</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn bg-gradient-primary w-100 my-4 mb-2">{{ __('Login') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    @if (Route::has('password.request'))
                                        <p class="mt-4 text-sm text-center">
                                            Lupa password?
                                            <a href="{{ route('password.request') }}"
                                                class="text-primary font-weight-bold">{{ __('Reset Password') }}</a>
                                        </p>
                                    @endif
                                    <p class="mt-4 text-sm text-center">
                                        Belum punya akun?
                                        <a href="{{ route('register') }}" class="text-primary font-weight-bold">Daftar
                                            Sekarang</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://images.unsplash.com/photo-1502877338535-766e1452684a?q=80&w=1472&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">OtoRent</h4>
                                <p class="text-white position-relative">Solusi Praktis dan Menyenangkan untuk Setiap
                                    Perjalanan Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('togglePassword').addEventListener('click', function(e) {
                    const passwordInput = document.getElementById('password');
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    if (type === 'password') {
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                });
            });
        </script>
    @endpush
@endsection
