@extends('frontend.layouts.app')
@push('styles')
    <title>Profile</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/profilDriver-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section id="profilDriver">
        <div class="profil-container container p-3">
            <!-- TEXT CONTENT -->
            <div class="text-content text-center">
                <p class="title">PROFIL DRIVER</p>
            </div>
            <div class="profil-image d-flex justify-content-center">
                <img src="{{ asset('img/avatar-driver.png') }}" alt="profil">
            </div>

            <!-- FORM -->
            <div class="p-3 mb-5">
                @include('frontend.assets.alert')
                <form id="formProfilDriver">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="number_phone" class="form-label">Nomor Telephone</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                            <input type="text" class="form-control @error('number_phone') is-invalid @enderror" id="number_phone" name="number_phone" value="{{ Auth::user()->number_phone }}" readonly>
                            @error('number_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 mb-3">
                        <button type="button" class="btn-ubahPassword" onclick="ubahPassword()">Ubah Password</button>
                    </div>
                </form>
            </div>

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
                                        <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" placeholder="Masukkan password baru" autocomplete="new-password" required>
                                        <span class="input-group-text" onclick="togglePassword(this)"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye-slash text-success" style="font-size: 1rem"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="konfirmasiPassword" class="form-label">Konfirmasi Password Baru</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="toggle-konfirmasiPassword"><img src="{{ asset('img/icon-deskripsi.png') }}"></span>
                                        <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Konfirmasi password" autocomplete="new-password" required>
                                        <span class="input-group-text" onclick="togglePassword(this)"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye-slash text-success" style="font-size: 1rem"></i>
                                        </span>
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
        function togglePassword(element) {
            const $input = $(element).closest('.input-group').find('input');
            const $icon = $(element).find('i');

            if ($input.attr('type') === 'password') {
                $input.attr('type', 'text');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                $input.attr('type', 'password');
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        }

        //MODAL
        function ubahPassword() {
            var myModal = new bootstrap.Modal(document.getElementById('modalUbahPassword'));
            myModal.show();
        };
    </script>
@endsection
