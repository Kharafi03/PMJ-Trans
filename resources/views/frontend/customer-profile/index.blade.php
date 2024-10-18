@extends('frontend.layouts.app')
@push('styles')
    <title>Customer Profil</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/profilCustomer-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- CUSTOMER PROFIL -->
    <section id="profil">
        <div class="container">
            @include('frontend.assets.alert')
            <div class="row justify-content-center g-4 mb-5">
                <div>
                    <h1 style="font-size: 44px; font-weight: 700; color: #1E9781;">Ubah <span
                            style="color: #FD9C07;">Profil</span></h1>
                </div>
                <div class="col-xl-8">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-success text-white font-weight-bold">
                            Pengaturan Profil
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                                id="profileForm">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-5 d-flex flex-column mb-3">
                                        <p>Foto Profil</p>
                                        <div>
                                            <div class="profil-image card h-100 w-100">
                                                <div class="text-center">
                                                    <img src="{{ asset('img/avatar.png') }}" class="img-fluid"
                                                        alt="avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 d-flex flex-column">
                                        <div class="mb-3">
                                            <label for="name"
                                                class="form-label font-weight-bold">Nama</label>
                                                <span class="text-danger text-lg">*</span>
                                            <div class="input-group">
                                                <input type="text" id="name" name="name"
                                                    class="form-control bg-light @error('name') is-invalid @enderror" value="{{ $user->name }}" required>
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-user text-success text-lg"
                                                        style="font-size: 1rem"></i>
                                                </span>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email"
                                                class="form-label font-weight-bold">Email</label>
                                            <div class="input-group">
                                                <input type="email" id="email" name="email"
                                                    class="form-control bg-light @error('email') is-invalid @enderror" value="{{ $user->email }}"
                                                    required>
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-envelope text-success text-lg"
                                                        style="font-size: 1rem"></i>
                                                </span>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="number_phone"
                                                class="form-label font-weight-bold">Nomor Handphone</label>
                                                <span class="text-danger text-lg">*</span>
                                            <div class="input-group">
                                                <input type="number" id="number_phone" name="number_phone" class="form-control bg-light @error('number_phone') is-invalid @enderror"
                                                    required placeholder="Nomor Handphone Anda"
                                                    value="{{ $user->number_phone }}">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-phone text-success text-lg"
                                                        style="font-size: 1rem"></i>
                                                </span>
                                                @error('number_phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label font-weight-bold">Alamat</label>
                                            <span class="text-danger text-lg">*</span>
                                            <div class="input-group">
                                                <textarea id="address" name="address" class="form-control bg-light @error('address') is-invalid @enderror" rows="4" placeholder="Masukkan Alamat Anda" required>{{ $user->address ?? '' }}</textarea>
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-location-dot text-success text-lg"
                                                        style="font-size: 1rem"></i>
                                                </span>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <p class="text-danger">* Wajib diisi</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Perbarui Profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Update Password -->
                <div class="col-xl-4">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-success text-white font-weight-bold">
                            Ubah Password
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.updatePassword') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password_lama"
                                        class="form-label font-weight-bold">Password Sekarang</label>
                                    <span class="text-danger text-lg">*</span>
                                    <div class="input-group">
                                        <input type="password" id="password_lama" name="password_lama"
                                            class="form-control @error('password_lama') is-invalid @enderror"
                                            placeholder="Masukan Password Sekarang" required
                                            autocomplete="current-password">
                                        <span class="input-group-text" onclick="togglePassword(this)"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye-slash text-success" style="font-size: 1rem"></i>
                                        </span>
                                        @error('password_lama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password_baru"
                                        class="form-label font-weight-bold">Password Baru</label>
                                    <span class="text-danger text-lg">*</span>
                                    <div class="input-group">
                                        <input type="password" id="password_baru" name="password_baru"
                                            class="form-control @error('password_baru') is-invalid @enderror"
                                            placeholder="Masukan Password Baru" required
                                            autocomplete="new-password">
                                        <span class="input-group-text" onclick="togglePassword(this)"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye-slash text-success" style="font-size: 1rem"></i>
                                        </span>
                                        @error('password_baru')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="konfirmasi_password"
                                        class="form-label font-weight-bold">Konfirmasi Password</label>
                                    <span class="text-danger text-lg">*</span>
                                    <div class="input-group">
                                        <input type="password" id="konfirmasi_password" name="konfirmasi_password"
                                            class="form-control @error('konfirmasi_password') is-invalid @enderror"
                                            placeholder="Konfirmasi Password" required
                                            autocomplete="new-password">
                                        <span class="input-group-text" onclick="togglePassword(this)"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye-slash text-success" style="font-size: 1rem"></i>
                                        </span>
                                        @error('konfirmasi_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <p class="text-danger mt-3">* Wajib diisi</p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Perbarui Password</button>
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />
    @push('scripts')
        <script>
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
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const numberInputs = document.querySelectorAll('input[type="number"]');
    
                numberInputs.forEach(function(input) {
                    // Prevent "-" from being entered
                    input.addEventListener('keypress', function(event) {
                        if (event.which === 45 || event.key === '-') {
                            event.preventDefault();
                        }
                    });
    
                    // Remove any negative signs that might have been pasted
                    input.addEventListener('input', function() {
                        let value = input.value;
                        if (value.indexOf('-') !== -1) {
                            input.value = value.replace('-', '');
                        }
                    });
    
                    // Ensure no negative value remains after input loses focus
                    input.addEventListener('blur', function() {
                        let value = input.value;
                        if (value < 0) {
                            input.value = Math.abs(value); // Convert negative to positive
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
