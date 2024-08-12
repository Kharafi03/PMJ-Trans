@extends('frontend.layout.app')
@section('content')
    <!-- Main Content -->
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://images.unsplash.com/photo-1562369413-43fc1abcf07c?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-2 text-white font-weight-bolder position-relative">OtoRent</h4>
                                <p class="text-white position-relative">Pengalaman Berkendara Tak Terlupakan dengan Layanan
                                    Terbaik</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Register</h4>
                                    <p class="mb-0">Masukkan email dan password untuk membuat akun</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" class="text-start" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" name="name"
                                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                    placeholder="{{ __('Nama Lengkap') }}" required autocomplete="name"
                                                    autofocus>
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-user text-primary text-lg"></i>
                                                </span>
                                                @error('name')
                                                    <span class="error invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                {{-- <input type="email" name="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                placeholder="{{ __('Email') }}" required> --}}
                                                <input type="email" name="email" class="form-control form-control-lg"
                                                    placeholder="Email" required onfocus="focused(this)"
                                                    onfocusout="defocused(this)" autocomplete="email">

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
                                                    placeholder="{{ __('Password') }}" required autocomplete="new-password">
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
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation"
                                                    class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="{{ __('Konfirmasi Password') }}" required
                                                    autocomplete="new-password">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-eye-slash text-primary text-lg"
                                                        id="togglePasswordConfirmation" style="cursor: pointer;"></i>
                                                </span>
                                                @error('password_confirmation')
                                                    <span class="error invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');

            togglePassword.addEventListener('click', function(e) {
                const passwordInput = document.getElementById('password');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            togglePasswordConfirmation.addEventListener('click', function(e) {
                const passwordConfirmationInput = document.getElementById('password_confirmation');
                const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' :
                    'password';
                passwordConfirmationInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
@endsection
