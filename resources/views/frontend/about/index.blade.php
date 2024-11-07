@extends('frontend.layouts.app')
@push('styles')
    <title>About</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/about-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- Header Start -->
    <div class="container-fluid p-5 header bg-white">
        <div class="row g-0 align-items-center flex-md-row">
            <div class="col-md-6 mt-lg-5 text-content wow animate__animated animate__fadeInLeft">
                <h1 class="mb-3">Tentang <span>Kami</span></h1>
                <p>
                    Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat tentang perusahaan.
                </p>
            </div>
            <div class="col-md-6 wow animate__animated animate__fadeInRight">
                <img class="img-fluid" src="{{ asset('img/about-img.png') }}" style="width: 100%; align-items:center" alt="gambar">
            </div>
        </div>
    </div>

    <!-- ABOUT -->
    <section id="about">
        <div>
            <div class="p-5 text-content wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
                <?php
                    $companyName = $setting ? $setting->name : '#';
                    if (strpos($companyName, '-') !== false) {
                        $parts = explode('-', $companyName);
                        $part1 = $parts[0];
                        $part2 = $parts[1];
                    } else {
                        $part1 = $companyName;
                        $part2 = '';
                    }
                ?>
                <h1 class="mb-3"><?= $part1 ?> <span><?= $part2 ?></span></h1>
                <p class="mb-4">
                    Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat tentang perusahaan.
                </p>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0 d-flex justify-content-center wow animate__animated animate__fadeInLeft" data-wow-delay="0.7s">
                        <img class="img-fluid" src="{{ asset('img/about-image.png') }}" alt="gambar" style="max-width: 100%; height: 100%;">
                    </div>
                    <div class="col-lg-6 wow animate__animated animate__fadeInRight" data-wow-delay="0.7s">
                        <div class="text-about mb-5">
                            <p class="caption">
                                {{ $setting ? $setting->about_us : '#' }}
                            </p>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $countBus ? $countBus : '#' }}</h5>
                                        <p class="card-text">Bus</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">450</h5>
                                        <p class="card-text">Jam Perjalanan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">50</h5>
                                        <p class="card-text">Destinasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">100</h5>
                                        <p class="card-text">Pelanggan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NAVBAR -->
    <x-footer-customer />

    @push('scripts')
        <script>
            new WOW().init();
        </script>
    @endpush
@endsection
