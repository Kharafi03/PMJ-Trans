@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Rejected</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesananDitolak-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- PEMESANAN DITOLAK -->
    <section id="pemesanan-diproses">
        <div class="container mt-5">
            <div class="card-form card mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <img src="img/image-bus1.png"  height="100%" width="100%" alt="images">
                    </div>
                    <!-- FORM -->
                    <div class="col-md-6">
                        <form id="formPemesananDitolak">
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
                                    <img src="img/image1.png" class="rounded-image me-2" alt="Bus Image" height="70px" width="106px" style="border-radius: 4px;">
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
                                <div class="mb-3">
                                    <div class="input-group mt-5 d-flex align-items-center justify-content-center flex-column text-left mb-5">
                                        <button type="submit" class="btn-perbaiki">Perbaiki Pesanan</button>
                                    </div>
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@endsection