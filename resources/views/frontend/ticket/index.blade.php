@extends('frontend.layouts.app')
@push('styles')
    <title>E-Ticket</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/tiket-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer/>

    <!-- CONTENT -->
    <section id="tiket">
        <div class="container mb-5">
            <div class="text-content mb-5">
                <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">E-Ticket</h5>
                <p style="font-size: 16px; font-weight: 500; color: #666666B5;">Berikut Detail Pembayaran selama menyewa bus PMJ Trans.</p>
            </div>
            <div class="tiket-container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="ticketContainer">
                            <div class="tiket-ruler"></div>
                            <div class="ticket">
                              <div class="ticketTitle mb-2">
                                <div class="header-tiket d-flex justify-content-between">
                                    <img src="img/icon-tiket.png" alt="icon" width="25px" height="25px">
                                    <p>26/May/2024</p>
                                </div>
                                <div class="tiket-card mb-3">
                                    <div class="profile-card">
                                        <img src="img/driver.png" alt="Profile Image">
                                        <div class="profile-text">
                                            <h5>Nida Aulia Karima</h5>
                                            <p>089654132245</p>
                                        </div>
                                    </div>
                                    <div class="info-tiket" style="background-image: url('img/bg-tiket.png');">
                                        <div class="row">
                                            <div class="col-md-4 d-flex flex-column align-items-center">
                                                <h5>Penumpang</h5>
                                                <p>64</p>
                                            </div>
                                            <div class="col-md-4 d-flex flex-column align-items-center">
                                                <h5>Kode</h5>
                                                <p style="background-color: #1E9781;padding: 5px; color: white; border-radius: 8px;">PMJ-87765DRSU</p>
                                            </div>
                                            <div class="col-md-4  d-flex flex-column align-items-center">
                                                <h5>Bus</h5>
                                                <ol>
                                                    <li>PMJ-01</li>
                                                    <li>PMJ-02</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="ticketRip">
                                <div class="circleLeft"></div>
                                <div class="ripLine"></div>
                                <div class="circleRight"></div>
                              </div>
                              <div class="tujuan-tiket">
                                <div class="tujuan-container">
                                    <div class="row">
                                        <div class="col" style="padding-top: 10px;">
                                            <h5>Titik Jemput</h5>
                                            <p>Jalan Mangga Besar III No. 17, RT 06 RW 07, Kelurahan Bedali, Kecamatan Lawang, Kab. Malang.</p>
                                        </div>
                                        <div class="col-2 d-flex justify-content-center align-items-start" >
                                            <img src="img/tiket-icon.png" >
                                        </div>
                                        <div class="col" style="text-align: right; padding-top: 10px;">
                                            <h5 style="padding-right: 20px">Tujuan</h5>
                                            <ol style="margin-top: 20px;">
                                                <li>Simpang Lima (Semarang)</li>
                                                <li>Simpang Lima (Semarang)</li>
                                                <li>Simpang Lima (Semarang)</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-8">
                        <div class="text-container">
                            <div class="text-content mb-5">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">E-Ticket</span></h5>
                                <p style="font-size: 16px; font-weight: 500; color: #666666B5;">Berikut Detail Pembayaran selama menyewa bus PMJ Trans.</p>
                            </div>
                            <div class="warning mb-3 d-flex align-items-center">
                                <div class="icon-warning">
                                    <i class="fa-solid fa-ticket-simple"></i>
                                </div>
                                <p>Tunjukan E-Tiket dan identitas penumpang saat pengambilan bus.</p>
                            </div>
                            <div class="warning mb-3 d-flex align-items-center">
                                <div class="icon-warning">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <p>Harap datang tepat waktu, keterlambatan maximal 40 menit sebelum keberangkatan.</p>
                            </div>
                            <div class="warning mb-3 d-flex align-items-center">
                                <div class="icon-warning">
                                    <i class="fa-solid fa-triangle-exclamation" style="padding: 10px 12px;"></i>
                                </div>
                                <p>Dilarang membawa senjata atau hal lain yang membahayakan.</p>
                            </div>
                        </div>
                        <div class="">
                            <button type="button" class="btn-download">Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
     <x-footer-customer/>
@endsection