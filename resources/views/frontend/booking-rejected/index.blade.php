@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Rejected</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesananDitolak-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />
    
    <!-- PEMESANAN DITOLAK -->
    <section id="pemesananDitolak">
        <div class="container mb-5 mt-5">
            <!-- CARD -->
            <div class="mb-3">
                <div class="row">
                    <!-- HEADER -->
                    <div class="col-md-12 col-lg-6 mb-3 d-flex flex-column justify-content-center">
                        <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">Cek <span style="color: #FD9C07;">Pesanan</span></h5>
                        <div class="status-pemesanan">
                            <p>Status pemesan Anda saat ini</p>
                        </div>
                        <img src="/img/cek-img.png" class="img-fluid" alt="images" style="padding: 0px 50px 0px 50px;">
                    </div>
                    <!-- FORM -->
                    <div class="col-md-12 col-lg-6 mb-3">
                        <form id="formPemesananDitolak">
                            <div class="form-header text-center mb-5">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781;">Cek <span style="color: #FD9C07;">Pesanan</span></h5>
                            </div>
                            <div class="pemesanan-ditolak">
                                <div class="mb-3">
                                    <label for="kodeBooking" class="form-label">Kode Booking</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-ticket-simple"></i></span>
                                        <input type="text" id="kodeBooking" class="form-control" value="" placeholder="PMJ777777" aria-label="Username" aria-describedby="basic-addon1" readonly> 
                                        <!-- tak kasih placeholder dulu buat isinya -->
                                    </div>
                                </div>
            
                                <div class="status-alert d-flex align-items-center">
                                    <span class="card-icon me-2" style="padding-left: 10px;"><i class="fa-solid fa-triangle-exclamation"></i></span>
                                    <span style=" margin-left: 10px;"><b>Pesanan ditolak admin</b><br><small>Admin menolak pesanan anda, pastikan data yang dimasukan benar.</small></span>
                                </div>
            
                                <div class="d-flex align-items-center mb-3">
                                    <img src="img/pmj02-1.jpg" class="rounded-image me-2" alt="Bus Image" height="70px" width="106px" style="border-radius: 4px;">
                                    <div>
                                        <strong>BUS PMJ Trans 01</strong>
                                    </div>
                                </div>
            
                                <div class="mb-3">
                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" id="namaLengkap" class="form-control" placeholder="Nida Aulia Karima" value="" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
            
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" id="email" class="form-control" placeholder="nida@gmail.com" value="" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                    </div>                                      
                                </div>
            
                                <div class="mb-3">
                                    <label for="noTelp" class="form-label">Nomor Telephone</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>
                                        <input type="text" id="noTelp" class="form-control" placeholder="0897654321234" value="" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
            
                                <div class="mb-3">
                                    <label for="kodeBooking" class="form-label">Alamat</label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" id="alamat" placeholder="Jl. Nakula Raya, No.20, Pendrikan Kidul, Semarang Tengah, semarang, Jawa Tengah" value=""></textarea>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="btn-perbaiki">Pesan Ulang</button>
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@endsection