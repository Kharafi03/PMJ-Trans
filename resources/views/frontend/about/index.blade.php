@extends('frontend.layouts.app')
@push('styles')
    <title>About</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/about-style.css') }}" rel="stylesheet" />

@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="mb-4" style="font-size: 44px; font-weight: 700; color: #1E9781;">Tentang <span style="color: #FD9C07;">Kami</span></h1>
                <p class="mb-4" style="font-size: 16px; font-weight: 500; color: #666666B5;">Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat tentang perusahaan.</p>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="img/about-img.png" style="width: 100%; align-items:center" alt="gambar">
                <!-- src="{{ asset('frontend/img/carousel/carousel-2.jpg') }}" -->
            </div>
        </div>
    </div>

        <!-- ABOUT -->
        <section id="about" class="py-5">
          <div class="container">
              <div>
                  <h1 style="font-size: 44px; font-weight: 700; color: #1E9781; margin-bottom: 5px;">PMJ <span style="color: #FD9C07;">Trans</span></h1>
                  <p class="mb-5" style="font-size: 16px; font-weight: 500; color: #666666B5;">Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat tentang perusahaan.</p>
              </div>
              <div class="row align-items-center">
                  <div class="col-lg-6 mb-4 mb-lg-0 d-flex justify-content-center">
                      <img class="img-fluid" src="img/about-image.png" alt="gambar" style="max-width: 100%; height: 100%;">
                  </div>
                  <div class="col-lg-6">
                      <div class="text-about mb-5">
                          <p class="caption">PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.</p>
                      </div>
                      <div class="row mt-3">
                          <div class="col-lg-6 col-md-3 mb-4">
                            <div class="about-card card text-center">
                              <div class="card-body">
                                <h5 class="card-title">2</h5>
                                <p class="card-text">Bus</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-3 mb-4">
                            <div class="about-card card text-center">
                              <div class="card-body">
                                <h5 class="card-title">450</h5>
                                <p class="card-text">Jam Perjalanan</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-3 mb-4">
                            <div class="about-card card text-center">
                              <div class="card-body">
                                <h5 class="card-title">50</h5>
                                <p class="card-text">Destinasi</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-3 mb-4">
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
        </section>

    <!-- NAVBAR -->
    <x-footer-customer />

    <!-- SCRIPT JS -->
    
@endsection