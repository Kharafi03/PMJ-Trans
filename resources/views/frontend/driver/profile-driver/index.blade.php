@extends('frontend.layouts.app')
@push('styles')
    <title>Profile</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/profilDriver-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <section id="profilDriver">
        <div class="profil-container container p-3">
            <!-- TEXT CONTENT -->
            <div class="text-content text-center">
                <p class="title">PROFIL DRIVER</p>
            </div>
            <div class="profil-image d-flex justify-content-center">
                {{-- <img src="img/avatar-driver.png" alt="profil"> --}}
                <img src="{{ asset('img/avatar-driver.png') }}" alt="profil">
            </div>

            <!-- FORM -->
            <div class="p-3 mb-5">
                <form id="formProfilDriver">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="number_phone" class="form-label">Nomor Telephone</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                            <input type="text" class="form-control" id="number_phone" name="number_phone" value="{{ Auth::user()->number_phone }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                            <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>
                    <div class="mt-4 mb-3">
                        <button type="button" class="btn-ubahPassword" onclick="ubahPassword()">Ubah Password</button>
                    </div>
                </form>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="text-center">{{ $error }}</p>
                        @endforeach
                </div>
            @endif


            <!-- MODAL -->
            <div class="modal fade" id="modalUbahPassword" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><img src="{{ asset('img/close.png') }}"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Ubah Password</h5>
                            <form action="{{ route('driver.update-password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="passwordBaru" class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="toggle-passwordBaru"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                                        <input type="password" class="form-control" id="passwordBaru" placeholder="Masukkan password baru">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="konfirmasiPassword" class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="toggle-konfirmasiPassword"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                                        <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Konfirmasi password">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn-updatePassword">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>


    <!-- SCRIPT -->
    <script>
        // MATA
        // Inisialisasi toggle untuk setiap input password
        const togglePassword = document.querySelector('#toggle-password');
        const password = document.querySelector('#password');
        togglePasswordVisibility(togglePassword, password);

        const togglePasswordBaru = document.querySelector('#toggle-passwordBaru');
        const passwordBaru = document.querySelector('#passwordBaru');
        togglePasswordVisibility(togglePasswordBaru, passwordBaru);

        const toggleKonfirmasiPassword = document.querySelector('#toggle-konfirmasiPassword');
        const konfirmasiPassword = document.querySelector('#konfirmasiPassword');
        togglePasswordVisibility(toggleKonfirmasiPassword, konfirmasiPassword);

        // Fungsi untuk toggle visibility
        function togglePasswordVisibility(toggleBtn, passwordField) {
            toggleBtn.addEventListener('click', function() {
                // toggle the type attribute
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // toggle the eye icon
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }

        //MODAL
        function ubahPassword() {
            var myModal = new bootstrap.Modal(document.getElementById('modalUbahPassword'));
            myModal.show();
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
