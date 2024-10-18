@extends('frontend.layouts.app')
@push('styles')
    <title>Login</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/loginDriver-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section id="loginDriver">
        <div class="dashboard-container">
            <div class="login-driver">
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <img src="img/login-driver-img.png" class="img-fluid">
                </div>
                <div class="form-login">
                    <div class="text-content mb-5">
                        <h5>Login</h5>
                        <p>Silakan masukkan WhatsApp dan kata sandi Anda, lalu klik tombol login untuk melanjutkan.</p>
                    </div>
                    <form id="formLoginDriver">
                        <div class="mb-5">
                            <label for="number_phone" class="form-label">Nomor WhatsApp<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="number_phone" name="number_phone" placeholder="Masukkan nomor whatsapp aktif" required>
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
                            <a class="lupa-sandi" href="#">Lupa kata sandi?</a>
                        </div>
                        <div class="mb-2">
                            <button type="button" class="btn-login">Log In</button>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
    </section>

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