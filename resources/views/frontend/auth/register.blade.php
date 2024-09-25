@extends('frontend.layouts.app')
@push('styles')
    <title>Registrasi</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link id="pagestyle" href="{{ asset('css/frontend/css/register-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- LOGO -->
    <div class="container-fluid p-3">
        <a href="#" class="navbar-brand">
            <img src="img/logo.png" alt="Travelo Logo">
        </a>
    </div>
    <!-- CONTENT -->
    <section id="register">
        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="header mb-5">
                        <h5>Registrasi</h5>
                        <p>Jika Anda sudah memiliki akun, silakan <a href="{{ route('login') }}">Login di sini.</a></p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <li class="text-white">{{ $error }}</li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- FORM -->
                    <div class="form-login>">
                        <form id="formRegistrasi" action="{{ route('register') }}" method="POST">
                            @csrf                            
                            <div class="mb-5">
                                <label for="number_phone" class="form-label">Nomor Telephone<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="number_phone" name="number_phone"
                                    placeholder="Masukkan no telephone aktif" required>
                            </div>
                            <div class="mb-5">
                                <label for="name" class="form-label">Nama Lengkap<span
                                        class="text-danger">*</span></label>
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
                                <button type="submit" class="btn-register">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center justify-content-center col-img mb-3">
                    <img src="img/register-img.png" class="img-fluid" width="600px" height="700px">
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

        // //ALERT REGISTRASI
        // function prosesRegistrasi() { //jaga2 tak tambahi dulu
        //     // Simulasi proses registrasi
        //     var isRegistrationSuccessful = true; // Ganti dengan logika registrasi Anda

        //     if (isRegistrationSuccessful) {
        //         Swal.fire({
        //             title: 'Registrasi Berhasil!',
        //             text: 'Akun Anda telah berhasil dibuat. Silakan login untuk melanjutkan.',
        //             icon: 'success',
        //             confirmButtonText: 'OK'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 // Arahkan ke halaman login setelah registrasi berhasil
        //                 window.location.href = 'login.html'; // Ganti dengan URL halaman login Anda
        //             }
        //         });
        //     } else {
        //         Swal.fire({
        //             title: 'Registrasi Gagal!',
        //             text: 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.',
        //             icon: 'error',
        //             confirmButtonText: 'OK'
        //         });
        //     }
        // }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
