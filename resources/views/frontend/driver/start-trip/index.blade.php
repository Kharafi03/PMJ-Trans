@extends('frontend.layouts.app')
@push('styles')
    <title>Kilometer Awal</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/kmAwal-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardKm">
        <!-- HEADER -->
        <div class="dashboard-container container p-3">
            <x-header-driver />
            <!-- BUS IMAGE -->
            <!-- <div class="mt-5">
                <div class="tiket">
                    <div class="header-tiket ">
                        <img src="{{ asset('img/logo.png') }}" alt="bus" height="45px" width="50px"> 
                    </div>
                    <div class="content-tiket">
                        <div class="tujuan">
                            <div class="row">
                                <div class="col">
                                    <p>{{ $booking->pickup_point }}</p>
                                    <h5>{{ $booking->pickup_point }}</h5>
                                </div>
                                <div class="col" style="text-align: right;">
                                    <p>{{ $booking->destination_point }}</p>
                                    <h5>{{ $booking->destination_point }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="waktu">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ \Carbon\Carbon::parse($booking->date_start)->format('H:i') }} WIB</h5>
                                    <p>{{ \Carbon\Carbon::parse($booking->date_start)->format('d M Y') }}</p>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-start">
                                    <img src="{{ asset('img/tiket-icon.png') }}">
                                </div>
                                <div class="col" style="text-align: right;">
                                    <h5>10.00 WIB</h5>
                                    <p>{{ \Carbon\Carbon::parse($booking->date_end)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer-tiket">
                            <p>Durasi 1 Jam 15 Menit</p>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- FORM INPUT -->
            <div class="form-km mb-4">
                <form action="{{ route('km-start', $trip->id) }}" method="POST">
                    @csrf <!-- Tambahkan token CSRF -->
                    <div class="mb-3">
                        <label for="km_start" class="form-label">Kilometer Awal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-regular fa-file"></i></span>
                            <input type="text" class="form-control" id="km_start" name="km_start" placeholder="Masukkan Kilometer Awal" required>
                        </div>
                    </div>
                </form>
            </div>

                <div class="mb-4">
                    <div class="tiket-container">
                        <div class="ticketContainer">
                            <div class="ticket">
                                <div class="ticketTitle">
                                    <div class="d-flex justify-content-center align-items-center mb-2">
                                        <img src="{{ asset('img/logo.png') }}" alt="bus" height="45px" width="50px">
                                    </div>
                                    <div class="tiket-card">
                                        <div class="info-tiket">
                                            <div class="row">
                                                <div class="col" style="padding-top: 10px;">
                                                    <!-- <h5>Titik Jemput</h5>
                                                    <p>Jalan Mangga Besar III No. 17, RT 06 RW 07, Kelurahan Bedali, Kecamatan Lawang, Kab. Malang.</p> -->
                                                    <h5>Titik Jemput</h5>
                                                    <p>{{ $booking->pickup_point }}</p>
                                                </div>
                                                <div class="col" style="padding-top: 10px;">
                                                    <h5>Tujuan</h5>
                                                    <ol style="text-align: justify; ">
                                                        <li>Simpang Lima (Semarang)</li>
                                                        <li>Simpang Lima (Semarang)</li>
                                                        <li>Simpang Lima (Semarang)</li>
                                                    </ol>
                                                    <!-- <p>{{ $booking->destination_point }}</p>
                                                    <h5>{{ $booking->destination_point }}</h5> -->
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
                              <div class="jam-tiket">
                                <div class="jam-container">
                                    <div class="row">
                                        <div class="col-5 d-flex justify-content-center align-items-center">
                                            <!-- <h5>08:00 WIB</h5> -->
                                            <h5>{{ \Carbon\Carbon::parse($booking->date_start)->format('H:i') }} WIB</h5>
                                        </div>
                                        <div class="col-2 d-flex justify-content-center align-items-center" >
                                            <img src="{{ asset('img/km-img.png') }}" alt="image km">
                                        </div>
                                        <div class="col-5 d-flex justify-content-center align-items-center">
                                            <h5>23:00 WIB</h5>
                                        </div>
                                    </div>
                                    <div class="info-jam">
                                        <p>Durasi 1 Jam 15 Menit</p>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BUTTON -->
                <div>
                    <button type="submit" class="btn-inputkm">Kirim</button>
                </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
