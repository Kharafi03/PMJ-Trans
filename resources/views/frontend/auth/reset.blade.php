@extends('frontend.layouts.app')
@push('styles')
    <title>Reset Password</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/reset-style.css') }}" rel="stylesheet" />
@endpush
@section('content')

    <section id="login">
            <div class="row">
                <!-- KIRI -->
                <div class="col-lg-6 col-md-12 order-md-last order-lg-first">
                    <div class="logo mt-3">
                        <!-- FORM -->
                        <div class="form-container">
                            <div class="header mb-4">
                                <h5>Reset Password</h5>
                                <p>Ingin mengatur ulang kata sandi? Isi formulir di bawah ini dan klik tombol kirim untuk melanjutkan.</p>
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
                                    <div class="mb-5">
                                        <label for="password" class="form-label">Password Baru<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                            <span class="input-group-text" id="toggle-password"><i class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn-reset">Ubah Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-end col-img">
                    <img src="img/reset-img.png" class="img-fluid" width="500px" height="520px">
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
@endsection
