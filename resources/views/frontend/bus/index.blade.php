@extends('frontend.layouts.app')
@push('styles')
    <title>List Bus</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/bus-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')

    <!-- NAVBAR -->
    <x-navbar-customer/>
    <section id="bus">
      <!-- Header Start -->
      <div class="container-fluid header bg-white p-0">
          <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
              <div class="col-md-6 p-5 mt-lg-5">
                  <h1 class="display-5 mb-4">Daftar Bus PMJ Trans</h1>
                  <p class="mb-4">Temukan bus ideal Anda dengan pilihan kategori, rentang harga, dan
                      kapasitas penumpang yang telah kami sediakan !</p>
              </div>
              <div class="col-md-6">
                  <img class="img-fluid" src="img/image-bus1.png" style="width: 100%; align-items:center" alt="">
                  <!-- src="{{ asset('frontend/img/carousel/carousel-2.jpg') }}" -->
              </div>
          </div>
      </div>
      <!-- Header End -->

      <!-- Property List Start -->
      <div class="container px-5 mt-5 mb-5">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                    <h1 class="mb-3">Daftar Bus PMJ Trans</h1>
                    <p>Temukan bus yang sesuai dengan kebutuhan dan preferensi Anda!</p>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 bus-item">
                        <div class="property-item rounded overflow-hidden wow fadeInUp card-bus">
                            <div class="position-relative overflow-hidden image-container">
                                <img class="img-fluid" src="img/image-bus1.png" alt="gambar-mobil">
                                <div class="bg-white rounded-top position-absolute start-0 bottom-0 mx-4 pt-1 px-3 label">PMJ Trans 1</div>
                            </div>
                            <div class="p-4 property-content">
                                <h5 class="mb-3 price">Rp. 5.000.000,00</h5>
                                <p class="d-block mb-2">
                                    <div class="package-icon">
                                        <i class="fa-solid fa-star"></i> 4.8
                                    </div>
                                </p>   
                                <ul>
                                    <li>Tempat duduk yang bisa direbahkan 180 derajat untuk kenyamanan maksimal.</li>
                                    <li>Privasi ekstra dengan pembatas dan fasilitas hiburan pribadi.</li>
                                    <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                </ul>
                            </div>
                            <div class="property-footer">
                                <div class="d-flex justify-content-end me-4 pb-0">
                                    <a href="#" class="btn   btn-pesan">Pesan</a>
                                </div>
                                <div class="d-flex   mt-3 penumpang-container justify-content-center align-items-center">
                                    <div class="flex-fill text-center   py-3 penumpang-isi">
                                        <i class="fa-solid fa-chair me-2"></i>
                                        <p>30 Kursi</p>
                                    </div>
                                    <div class="flex-fill text-center py-3 penumpang-isi">
                                        <i class="fa-solid fa-tv me-2"></i>
                                        <p>TV Pribadi</p>
                                    </div>
                                    <div class="flex-fill text-center py-3 penumpang-isi">
                                        <i class="fa-solid fa-wifi me-2"></i>
                                        <p>Free Wifi</p>
                                    </div>
                                    <div class="flex-fill text-center py-3">
                                        <i class="fa-solid fa-bolt me-2"></i>
                                        <p>Charger</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 bus-item">
                        <div class="property-item rounded overflow-hidden wow fadeInUp card-bus">
                            <div class="position-relative overflow-hidden image-container">
                                <img class="img-fluid" src="img/image-bus1.png" alt="gambar-mobil">
                                <div class="bg-white rounded-top position-absolute start-0 bottom-0 mx-4 pt-1 px-3 label">PMJ Trans 1</div>
                            </div>
                            <div class="p-4 property-content">
                                <h5 class="mb-3 price">Rp. 5.000.000,00</h5>
                                <p class="d-block h5 mb-2" href="">PMJ 1</p>
                                 
                            </div>
                            <div class="property-footer">
                                <div class="d-flex justify-content-end p-4 pb-0">
                                    <a href="#" class="btn   btn-pesan">Pesan</a>
                                </div>
                                <div class="d-flex   mt-3 penumpang-container">
                                    <div class="flex-fill text-center   py-3 penumpang-isi">
                                        <i class="fa-solid fa-person   me-2"></i> 5 Penumpang
                                    </div>
                                    <div class="flex-fill text-center py-3">
                                        <i class="fa-solid fa-door-closed   me-2"></i>5 Pintu
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-6 bus-item">
                        <div class="property-item rounded overflow-hidden wow fadeInUp card-bus">
                            <div class="position-relative overflow-hidden image-container">
                                <img class="img-fluid" src="img/image-bus1.png" alt="gambar-mobil">
                                <div class="bg-white rounded-top position-absolute start-0 bottom-0 mx-4 pt-1 px-3 label">PMJ Trans 1</div>
                            </div>
                            <div class="p-4 property-content">
                                <h5 class="mb-3 price">Rp. 5.000.000,00</h5>
                                <p class="d-block h5 mb-2" href="">PMJ 1</p>
                                 
                            </div>
                            <div class="property-footer">
                                <div class="d-flex justify-content-end p-4 pb-0">
                                    <a href="#" class="btn   btn-pesan">Pesan</a>
                                </div>
                                <div class="d-flex mt-3 penumpang-container">
                                    <div class="flex-fill text-center py-3 penumpang-isi">
                                        <i class="fa-solid fa-person me-2"></i> 5 Penumpang
                                    </div>
                                    <div class="flex-fill text-center py-3">
                                        <i class="fa-solid fa-door-closed   me-2"></i>5 Pintu
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-6 bus-item">
                        <div class="property-item rounded overflow-hidden wow fadeInUp card-bus">
                            <div class="position-relative overflow-hidden image-container">
                                <img class="img-fluid" src="img/image-bus1.png" alt="gambar-mobil">
                                <div class="bg-white rounded-top position-absolute start-0 bottom-0 mx-4 pt-1 px-3 label">PMJ Trans 1</div>
                            </div>
                            <div class="p-4 property-content">
                                <h5 class="mb-3 price">Rp. 5.000.000,00</h5>
                                <p class="d-block h5 mb-2" href="">PMJ 1</p>
                                 
                            </div>
                            <div class="property-footer">
                                <div class="d-flex justify-content-end p-4 pb-0">
                                    <a href="#" class="btn   btn-pesan">Pesan</a>
                                </div>
                                <div class="d-flex mt-3 penumpang-container">
                                    <div class="flex-fill text-center py-3 penumpang-isi">
                                        <i class="fa-solid fa-person me-2"></i> 5 Penumpang
                                    </div>
                                    <div class="flex-fill text-center py-3">
                                        <i class="fa-solid fa-door-closed me-2"></i>5 Pintu
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-6 bus-item">
                        <div class="property-item rounded overflow-hidden wow fadeInUp card-bus">
                            <div class="position-relative overflow-hidden image-container">
                                <img class="img-fluid" src="img/image-bus1.png" alt="gambar-mobil">
                                <div class="bg-white rounded-top position-absolute start-0 bottom-0 mx-4 pt-1 px-3 label">PMJ Trans 1</div>
                            </div>
                            <div class="p-4 property-content">
                                <h5 class="mb-3 price">Rp. 5.000.000,00</h5>
                                <p class="d-block h5 mb-2" href="">PMJ 1</p>
                                 
                            </div>
                            <div class="property-footer">
                                <div class="d-flex justify-content-end p-4 pb-0">
                                    <a href="#" class="btn   btn-pesan">Pesan</a>
                                </div>
                                <div class="d-flex   mt-3 penumpang-container">
                                    <div class="flex-fill text-center py-3 penumpang-isi">
                                        <i class="fa-solid fa-person   me-2"></i> 5 Penumpang
                                    </div>
                                    <div class="flex-fill text-center py-3">
                                        <i class="fa-solid fa-door-closed   me-2"></i>5 Pintu
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>      
            </div>
        </div> -->

        <!-- CARD BUS -->
        <div class="col-lg-12">
          <div class="row g-4">
            <!-- CARD 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj02-1.jpg" alt="Bus 1" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 01</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.8
                            </div>
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center">
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
                        <ul>
                          <li>Dilengkapi dengan AC, bantal, dan selimut untuk kenyamanan perjalanan.</li>
                          <li>Berbagai entertain system, seperti youtube android tv, subwoofer audio, wireless mic, dan karaoke.</li>
                          <li>Tempat duduk nyaman dengan seat 2-2.</li>
                        </ul>
                      </div>
                       
                    </div>
                  </div>
            <!-- CARD 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj03-1.jpg" alt="Bus 2" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 02</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.8
                            </div>
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center">
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
                        <ul>
                          <li>Dilengkapi dengan AC, bantal, dan selimut untuk kenyamanan perjalanan.</li>
                          <li>Berbagai entertain system, seperti youtube android tv, subwoofer audio, wireless mic, dan karaoke.</li>
                          <li>Tempat duduk nyaman dengan seat 2-2.</li>
                        </ul>
                      </div>   
                    </div>
            </div>
            <!-- CARD 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj02-1.jpg" alt="Bus 3" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 03</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.8
                            </div>
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center">
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
                        <ul>
                          <li>Dilengkapi dengan AC, bantal, dan selimut untuk kenyamanan perjalanan.</li>
                          <li>Berbagai entertain system, seperti youtube android tv, subwoofer audio, wireless mic, dan karaoke.</li>
                          <li>Tempat duduk nyaman dengan seat 2-2.</li>
                        </ul>
                      </div>
                       
                    </div>
                  </div>
            <!-- CARD 4 -->
            <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj03-1.jpg" alt="Bus 4" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 04</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.9
                            </div>
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center">
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
                        <ul>
                          <li>Dilengkapi dengan AC, bantal, dan selimut untuk kenyamanan perjalanan.</li>
                          <li>Berbagai entertain system, seperti youtube android tv, subwoofer audio, wireless mic, dan karaoke.</li>
                          <li>Tempat duduk nyaman dengan seat 2-2.</li>
                        </ul>
                      </div>
                       
                    </div>
                  </div>
            <!-- CARD 5 -->
            <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj02-1.jpg" alt="Bus 5" class="img-fluid">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="package-card-title">PMJ 05</p>
                            <div class="package-icon">
                                <i class="fa-solid fa-star"></i> 4.7
                            </div>
                        </div>
                        <p class="small">Jetbus 3+ Voyager Adiputro</p>
                        <div class="row mt-3 mb-3 text-center">
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
                        <ul>
                          <li>Dilengkapi dengan AC, bantal, dan selimut untuk kenyamanan perjalanan.</li>
                          <li>Berbagai entertain system, seperti youtube android tv, subwoofer audio, wireless mic, dan karaoke.</li>
                          <li>Tempat duduk nyaman dengan seat 2-2.</li>
                        </ul>
                      </div>
                       
                    </div>
                  </div>
          </div>
        </div>

    
    </section>
        <!-- FOOTER -->
    <x-footer-customer/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@endsection

