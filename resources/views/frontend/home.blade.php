@extends('frontend.layout.app')
@push('styles')
    <style>
        main {
            margin-top: 82px;
        }
    </style>
@endpush
@section('content')
    <header>
        @include('frontend.layout.navbar')
    </header>
    <main>
        <!-- Carousel -->
        <section class="carousel">
            <div class="container-fluid header bg-white p-0">
                <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                    <div class="col-md-6 p-5 mt-lg-5 wow fadeInLeft" data-wow-delay="0.1s">
                        <h1 class="display-5 animated fadeIn mb-4>
                            <span class="text-primary">
                            PMJ Trans</span>
                            Solusi Perjalanan Anda!
                        </h1>
                        <h5 class="animated fadeIn pb-2">Temukan Mobil dan Motor terbaik untuk setiap perjalanan Anda!</h5>
                        <h5 class="animated fadeIn pb-2">Sewa sekarang dan rasakan kenyamanannya!</h5>
                        <h4><i class="fa fa-check text-primary me-3"></i>Mudah</h4>
                        <h4><i class="fa fa-check text-primary me-3"></i>Aman</h4>
                        <h4><i class="fa fa-check text-primary me-3"></i>Nyaman</h4>
                        <a href="#more" class="btn btn-primary mt-3 py-3 px-5 me-3 animated fadeIn">Selengkapnya</a>
                    </div>
                    <div class="col-md-6 wow fadeInRight" data-wow-delay="0.1s">
                        <img class="img-fluid" src="{{ asset('images/carousel/carousel-1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.3s" style="padding: 35px;">
            </div>
        </section>
        <!-- Mengapa PMJ -->
        <section id="mengapa-pmj">
            <div class="container py-5 wow fadeInUp" data-wow-delay="0.1s" id="more">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h1 class="mb-4"><strong>Kenapa Harus di PMJ Trans ?</strong></h1>
                        <p class="lead mb-5">Berikut Alasan Mengapa PMJ Trans Menjadi Pilihan Terbaik Anda</p>
                    </div>
                </div>
                <div class="row text-center">
                    @php
                        $advantages = [
                            [
                                'title' => 'Mudah, Aman dan Nyaman',
                                'icon' => 'fas fa-shield-alt',
                            ],
                            [
                                'title' => 'Proses Cepat dan Praktis',
                                'icon' => 'fas fa-tachometer-alt',
                            ],
                            [
                                'title' => 'Antar Jemput ke Lokasi',
                                'icon' => 'fas fa-shipping-fast',
                            ],
                            [
                                'title' => 'Pembayaran Mudah',
                                'icon' => 'fas fa-credit-card',
                            ],
                            [
                                'title' => 'Banyak Pilihan',
                                'icon' => 'fas fa-car',
                            ],
                            [
                                'title' => 'Terpercaya',
                                'icon' => 'fas fa-thumbs-up',
                            ],
                        ];
                    @endphp
                    @foreach ($advantages as $index => $advantage)
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 wow fadeInUp" data-wow-delay="0.{{ $index + 2 }}s">
                            <div class="d-flex flex-column align-items-center">
                                <div class="icon-container mb-3 bg-primary rounded-circle p-3">
                                    <i class="{{ $advantage['icon'] }} fa-3x text-white"></i>
                                </div>
                                <h5 class="mt-3 text-center">{{ $advantage['title'] }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section id="cara-pemesanan">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-4"><strong>Cara Pemesanan</strong></h1>
                        <p class="lead mb-5">Ikuti Langkah Mudah Ini untuk Menyewa di PMJ Trans</p>
                    </div>
                </div>
                <div class="row text-center">
                    @php
                        $steps = [
                            [
                                'title' => 'Melengkapi Data Diri',
                                'description' =>
                                    'Isi formulir dengan data diri lengkap dan informasi yang diperlukan untuk proses pemesanan.',
                                'icon' => 'fas fa-user',
                                'color' => 'text-success',
                            ],
                            [
                                'title' => 'Memilih Kendaraan',
                                'description' =>
                                    'Pilih kendaraan yang Anda inginkan dan tentukan jadwal rental yang sesuai dengan kebutuhan Anda.',
                                'icon' => 'fas fa-tachometer-alt',
                                'color' => 'text-primary',
                            ],
                            [
                                'title' => 'Melakukan Pembayaran',
                                'description' =>
                                    'Kami telah menyediakan proses pembayaran melalui transfer bank dan dompet digital',
                                'icon' => 'fas fa-check',
                                'color' => 'text-warning',
                            ],
                            [
                                'title' => 'Kendaraan Siap Pakai',
                                'description' => 'Nikmati kendaraan rental sesuai dengan jadwal yang telah Anda tentukan.',
                                'icon' => 'fas fa-clock',
                                'color' => 'text-danger',
                            ],
                        ];
                    @endphp
                    @foreach ($steps as $index => $step)
                        <div class="col-lg-3 mb-5 wow fadeInUp" data-wow-delay="0.{{ $index + 2 }}s">
                            <div class="card h-100 shadow border-0" style="box-shadow: 0 0.5rem 1rem rgba(0, 0, 255, 0.2);">
                                <div class="card-header bg-light">
                                    <div class="fs-1 {{ $step['color'] }}"><i class="{{ $step['icon'] }}"></i></div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $step['title'] }}</h3>
                                    <p class="card-text">{{ $step['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endSection
