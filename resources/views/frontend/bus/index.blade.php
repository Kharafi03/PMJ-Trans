@extends('frontend.layouts.app')
@push('styles')
    <title>List Bus</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/bus-style.css') }}" rel="stylesheet" />

@endpush
@section('content')

    <!-- NAVBAR -->
    <x-navbar-customer/>
    <section id="bus">
      <!-- Header Start -->
      <div class="container-fluid header bg-white p-0">
          <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
              <div class="col-md-6 p-5 mt-lg-5">
                  <h1 style="font-size: 44px; font-weight: 700; color: #1E9781;">Daftar Bus <span style="color: #FD9C07;">PMJ Trans </span></h1>
                  <p class="mb-4" style="font-size: 16px; font-weight: 500; color: #666666B5;">Temukan bus ideal Anda dengan pilihan kategori, rentang harga, dan kapasitas penumpang yang telah kami sediakan !</p>
              </div>
              <div class="col-md-6">
                  <img class="img-fluid" src="img/listbust-img.png" style="width: 100%; align-items:center; padding: 50px 30px; 0px 30px" alt="">
                  <!-- src="{{ asset('frontend/img/carousel/carousel-2.jpg') }}" -->
              </div>
          </div>
      </div>
      <!-- Header End -->

      <div style="margin: 50px 0px 0px 50px;">
          <h1 style="font-size: 44px; font-weight: 700; color: #1E9781;">Daftar Bus <span style="color: #FD9C07;">PMJ Trans </span></h1>
          <p class="mb-4" style="font-size: 20px; font-weight: 600; color: #666666B5;">Temukan bus ideal Anda dengan pilihan kategori, rentang harga, dan kapasitas penumpang yang telah kami sediakan !</p>
      </div>

      <!-- Property List Start -->
      <div class="container px-5 mt-5 mb-5">
        <!-- CARD BUS -->
        <div class="col-lg-12">
          <div class="row g-5">
                  <!-- Card 1 -->
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj02-1.jpg" alt="Bus 1" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 02</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.8
                            </div>  
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center fasilitas-package">
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bed"></i>
                            <p>Bantal & Selimut</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-tv"></i>
                            <p>Entertain System</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-mug-hot"></i>
                            <p>Dispenser</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bolt"></i>
                            <p>USB Charger</p>
                          </div>
                        </div>
                        <div class="detail-package d-flex justify-content-end">
                          <button type="button" class="btn-detail"><a href="{{ route('bus-detail')}}" style="text-decoration:none; color: white;">Detail</a></button>
                        </div>
                      </div>   
                    </div>
                  </div>
                  <!-- Card 2 -->
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj03-1.jpg" alt="Bus 2" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 03</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.8
                            </div>
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center fasilitas-package">
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bed"></i>
                            <p>Bantal & Selimut</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-tv"></i>
                            <p>Entertain System</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-mug-hot"></i>
                            <p>Dispenser</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bolt"></i>
                            <p>USB Charger</p>
                          </div>
                        </div>
                        <div class="detail-package d-flex justify-content-end">
                          <button type="button" class="btn-detail">Detail</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Card 3 -->
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj02-1.jpg" alt="Bus 3" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 02</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.8
                            </div>  
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center fasilitas-package">
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bed"></i>
                            <p>Bantal & Selimut</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-tv"></i>
                            <p>Entertain System</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-mug-hot"></i>
                            <p>Dispenser</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bolt"></i>
                            <p>USB Charger</p>
                          </div>
                        </div>
                        <div class="detail-package d-flex justify-content-end">
                          <button type="button" class="btn-detail">Detail</button>
                        </div>
                      </div>   
                    </div>
                  </div>
                  <!-- Card 4 -->
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj03-1.jpg" alt="Bus 4" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 03</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.7
                            </div>  
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center fasilitas-package">
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bed"></i>
                            <p>Bantal & Selimut</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-tv"></i>
                            <p>Entertain System</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-mug-hot"></i>
                            <p>Dispenser</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bolt"></i>
                            <p>USB Charger</p>
                          </div>
                        </div>
                        <div class="detail-package d-flex justify-content-end">
                          <button type="button" class="btn-detail">Detail</button>
                        </div>
                      </div>   
                    </div>
                  </div>
                  <!-- Card 5 -->
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj02-1.jpg" alt="Bus 5" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 02</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.9
                            </div>
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center fasilitas-package">
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bed"></i>
                            <p>Bantal & Selimut</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-tv"></i>
                            <p>Entertain System</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-mug-hot"></i>
                            <p>Dispenser</p>
                          </div>
                          <div class="col-3 text-icon">
                            <i class="fa-solid fa-bolt"></i>
                            <p>USB Charger</p>
                          </div>
                        </div>
                        <div class="detail-package d-flex justify-content-end">
                          <button type="button" class="btn-detail">Detail</button>
                        </div>
                      </div>
                    </div>
                  </div>
          </div>
        </div>
    </section>
    <!-- FOOTER -->
    <x-footer-customer/>
@endsection

