@extends('frontend.layouts.app')
@push('styles')
    <title>Customer Profile</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/profilCustomer-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- CUSTOMER PROFIL -->
    <section id="profil">
        <div class="container mt-5">
            <div class="row d-flex align-items-stretch">
                <!-- AVATAR -->
                <div class="mb-3">
                    <h3>Ubah Profil</h3>
                </div>
                <div class="col-md-4 mb-3 d-flex">
                    <div class="profil-image card h-100 w-100">
                        <h5>Foto Profil</h5>
                        <p>Photo</p>
                        <div class="avatar text-center">
                            <!-- <i class="fa-solid fa-user"></i> -->
                            <img src="img/avatar.png" class="img-fluid" alt="avatar">
                        </div>
                    </div>
                </div>
                <!-- FORM -->
                <div class="col-md-8 mb-3 d-flex">
                    <div class="profil-form card h-100 w-100">
                        <form id="formProfilCustomer">
                            <div class="mb-3">
                                <label for="namaLengkap" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="namaLengkap" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan alamat email">
                            </div> 
                            <div class="mb-3">
                                <label for="noTelp" class="form-label">Nomor Telepon<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="noTelp" placeholder="Masukkan nomor telepin aktif fan dapat dihubungi" required>
                            </div> 
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>
                        </form>                         
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="note">
                        <p>Keterangan : <span class="text-danger">Wajib diisi (*)</span></p>
                    </div>
                </div>
                <!-- BUTTON -->
                <div class="col-md-8">
                    <div class="container-btn">
                        <buton type="button" class="btn-profil" onclick="konfirmasiUbahProfil()">Perbarui Profil</buton>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection