@extends('frontend.layouts.app')
@push('styles')
    <title>Kilometer Awal</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/kmAwal-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardKm">
        <!-- HEADER -->
        <div class="dashboard-container container p-3">
            <x-header-driver />
            <!-- BUS IMAGE -->

            <!-- FORM INPUT -->
            <div class="form-km mb-4">
                <form action="{{ route('km-start', $trip->id) }}" method="POST">
                    @csrf <!-- Tambahkan token CSRF -->
                    <div class="mb-3">
                        <label for="km_start" class="form-label">Kilometer Awal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-regular fa-file"></i></span>
                            <input type="text" class="form-control" id="km_start" name="km_start"
                                placeholder="Masukkan Kilometer Awal" required>
                        </div>
                    </div>
                {{-- </form> --}}
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
                                                <h5>Titik Jemput</h5>
                                                <p>{{ $booking->pickup_point }}</p>
                                            </div>
                                            <div class="col" style="padding-top: 10px;">
                                                <h5>Tujuan</h5>
                                                <div style="text-align: justify; ">
                                                    @foreach ($destinations as $dest)
                                                        @if ($loop->count > 1)
                                                            <p class="m-0">{{ $loop->iteration }}. {{ $dest->name }}
                                                            </p>
                                                        @else
                                                            <p>{{ $dest->name }}</p>
                                                        @endif
                                                    @endforeach
                                                </div>
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
                                            <h5>{{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F') }}
                                            </h5>
                                        </div>
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('img/km-img.png') }}" alt="image km">
                                        </div>
                                        <div class="col-5 d-flex justify-content-center align-items-center">
                                            <h5>{{ \Carbon\Carbon::parse($trip->booking->date_end)->translatedFormat('d F') }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="info-jam">
                                        <?php
                                            // Mengonversi start date dan end date ke Carbon tanpa mempertimbangkan jam
                                            $startDate = \Carbon\Carbon::parse($trip->booking->date_start)->startOfDay();
                                            $endDate = \Carbon\Carbon::parse($trip->booking->date_end)->startOfDay(); // Set startOfDay untuk tanggal akhir
                                    
                                            // Hitung perbedaan hari penuh
                                            $daysDifference = $startDate->diffInDays($endDate);
                                    
                                            // Tambahkan 1 hari agar minimal 1 hari terhitung
                                            $daysDifference += 1;
                                        ?>
                                        <p>Durasi: {{ $daysDifference }} hari</p>
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
                </form>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>
@endsection
