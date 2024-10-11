@extends('frontend.layouts.app')
@push('styles')
    <title>PMJ Trans</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/homepage-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
        <!-- HEADER -->
        <section id="header">
        <div class="bg-image" style="background-image: url('img/bgx.png');">
            <!-- NAVBAR -->
            <x-navbar-customer />
            <div class="header-text container" style="padding-top: 100px">
                <h1 class="header-title display-4 fw-bold">Menghubungkan Anda ke Seluruh<br><span>Destinasi.</span></h1>
                <button class="btn-pesan">Pesan</button>
            </div>
        </div>
    </section>



    <!-- DAFTAR BUS -->
    <section id="package">
        <div class="package-container container">
          <h2>Daftar Bus PMJ</h2>
          <div id="carouselExampleIndicators" class="carousel slide carousel-dark mb-5">
            <div class="carousel-inner">
              <!-- Carousel Item 1 -->
              <div class="carousel-item active">
                <div class="row">
                  <!-- Card 1 -->
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
                  <!-- Card 2 -->
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
                  <!-- Card 3 -->
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card card h-100">
                      <img src="img/pmj03-1.jpg" alt="Bus 3" class="img-fluid">
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
                </div>
              </div>
              <!-- Carousel Item 2 -->
              <div class="carousel-item">
                <div class="row">
                  <!-- Card 4 -->
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
                  <!-- Card 5 -->
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
            </div>
              <!-- Navigation Buttons -->
            <button class="package-button package-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="package-button package-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
    </section>

    <!-- CARA PENYEWAAN -->
    <section id="caraPenyewaan">
        <div class="container-fluid cara-container">
            <div class="cara-title text-center">
                <h5>Cara Penyewaan</h5>
                <p>Ikuti langkah dibawah ini untuk melakukan penyewaan BUS di PMJ Trans</p>
            </div>
            <div class="row" style="background-image: url('img/bg-cara.png');">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara1.png" class="img-fluid" alt="cara 1">
                        <h5>Pilih Bus</h5>
                        <p>Pilih bus yang tersedia dari layanan PMJ Trans.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara2.png" class="img-fluid" alt="cara 1">
                        <h5>Pesan Bus</h5>
                        <p>Melalui Admin Atau Website dengan mengisi formulir pemesanan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara3.png" class="img-fluid" alt="cara 1">
                        <h5>Konfirmasi Admin</h5>
                        <p>Konfirmasi via WhatsApp jika pemesanan melalui admin atau cek pemesanan jika menggunakan website.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara4.png" class="img-fluid" alt="cara 1">
                        <h5>Pembayaran</h5>
                        <p>Unggah bukti pembayaran DP, sisa pembayaran dapat dilakukan saat trip atau di Kantor PMJ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="homepage-content" style="background-image: url('img/bg-body.png');">

        <!-- KENAPA -->
        <section id="why">
            <div class="container">
                <div class="text-container">
                    <p style="font-size: 44px;"><b>Kenapa Harus Sewa di PMJ?</b></p>
                    <p style="font-size: 17px; font-weight: 600; color: #666666B5;">Berikut alasan yang kenapa harus sewa
                        di PMJ</p>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 p-3">
                    <div class="col-md-4 mb-3" id="card1">
                        <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                            <img class="img-fluid mb-4" src="img/why-image1.png" width="60px" height="60px"
                                alt="images1">
                            <div class="card-body">
                                <h5 class="why-title">Banyak Pilihan</h5>
                                <p class="card-text">Kami menyedikan banyak pilihan destinasi dan BUS yang dapat anda
                                    pilih, sesuai kebutuhan dan keinganan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" id="card2">
                        <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                            <img class="img-fluid mb-4" src="img/why-image2.png" width="60px" height="60px"
                                alt="images2">
                            <div class="card-body">
                                <h5 class="why-title">Penyewaan Mudah</h5>
                                <p class="card-text">PMJ Trans menyediakan penyewaan yang mudah dengan cara mengisi
                                    formulir dan kontak admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" id="card3">
                        <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                            <img class="img-fluid mb-4" src="img/why-image3.png" width="60px" height="60px"
                                alt="images3">
                            <div class="card-body">
                                <h5 class="why-title">Harga Bersahabat</h5>
                                <p class="card-text">Kami menyediakan tarif yang terjangkau dengan kendaraan modern,
                                    memastikan perjalanan Anda nyaman dan terpercaya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- TENTANG KAMI -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 d-flex justify-content-center">
                    <img class="img-fluid" src="img/about-imgage.png" alt="gambar" style="max-width: 100%; height: auto;">
                </div>
                <div class="col-lg-6">
                    <div class="text-about">
                        <p style="font-size: 44px;"><b>Tentang Kami</b></p>
                        <p class="caption">PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-3 mb-4">
                          <div class="about-card card text-center">
                            <div class="card-body">
                              <h5 class="card-title">30+</h5>
                              <p class="card-text">Bus</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-3 mb-4">
                          <div class="about-card card text-center">
                            <div class="card-body">
                              <h5 class="card-title">450+</h5>
                              <p class="card-text">Jam Perjalanan</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-3 mb-4">
                          <div class="about-card card text-center">
                            <div class="card-body">
                              <h5 class="card-title">50+</h5>
                              <p class="card-text">Destinasi</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-3 mb-4">
                          <div class="about-card card text-center">
                            <div class="card-body">
                              <h5 class="card-title">12k+</h5>
                              <p class="card-text">Pelanggan</p>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq">
        <div class="container mt-5">
          <div class="title-faq"><p>Pertanyaan<span> Umum</span></p></div>
          <div class="accordion accordion-flush" id="faq">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false">
                  Pertanyaan 1
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam, possimus quaerat! Consequuntur nihil reiciendis enim odit maiores eveniet rerum dolore? Aut quod delectus blanditiis nisi? Nihil, distinctio libero! Non, odit.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
                  Pertanyaan 2
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est officiis temporibus quae tenetur esse ut quo praesentium quam. Possimus cupiditate consequatur perspiciatis ad recusandae explicabo unde quaerat, facere illum. Libero?</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
                  Pertanyaan 3
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non nulla illum et minus assumenda pariatur aspernatur eveniet quisquam tenetur facilis ipsam ea, nemo ipsum odio earum? Veniam eos pariatur autem!</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">
                  Pertanyaan 4
                </button>
              </h2>
              <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas, quia dolores? Sint nostrum deserunt fuga magnam minus autem sequi molestiae soluta excepturi iusto fugit cum qui temporibus, pariatur rem esse!</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false">
                  Pertanyaan 5
                </button>
              </h2>
              <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi earum eveniet ducimus dolorem itaque quae sequi, molestias veritatis, ratione rem dolorum laudantium! Minus nesciunt adipisci repellat ut culpa laboriosam maiores.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false">
                  Pertanyaan 6
                </button>
              </h2>
              <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae dolore excepturi a facilis obcaecati ad reiciendis nisi maiores labore dolorum harum deserunt distinctio, sapiente cumque ut vero eos quae provident!</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="false">
                  Pertanyaan 7
                </button>
              </h2>
              <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur eligendi maxime aut error laudantium molestiae qui tenetur ullam repellat unde blanditiis, nulla harum explicabo hic deleniti dolores magni illum suscipit.</div>
              </div>
            </div>
          </div>      
        </div>
    </section>


        <!-- TESTIMONI -->
        <section id="testimoni" class="py-5">
            <div class="container container-testi">
                <div class="title text-center mb-5">
                    <p style="color: #1E9781; margin-bottom: 5px;">T E S T I M O N I</p>
                    <p style="font-size: 44px; font-weight: bold;">Kata Mereka</p>
                </div>

                <div id="carouselTestimoni" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators" style="margin-top: 50px;">
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="1"
                            aria-label="Slide 2"
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="2"
                            aria-label="Slide 3"
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                    </div>

                    <div class="carousel-inner carousel-inner-testi">
                        <!-- Testimoni 1 -->
                        <div class="carousel-item active text-center">
                            <img src="img/avatar.png" class="testi-img mb-3" alt="Customer"
                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <h5><b>Nida Aulia Karima</b></h5>
                            <p>Customer</p>
                            <div class="stars mb-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="testimonial-text mx-auto" style="max-width: 500px;">Saya suka PMJ Trans, ini adalah
                                tempat terbaik untuk membeli tiket dan membantu Anda menemukan liburan impian Anda.</p>
                        </div>

                        <!-- Testimoni 2 -->
                        <div class="carousel-item text-center">
                            <img src="img/avatar.png" class="testi-img mb-3" alt="Customer"
                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <h5><b>Nida Aulia Karima</b></h5>
                            <p>Customer</p>
                            <div class="stars mb-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="testimonial-text mx-auto" style="max-width: 500px;">Saya suka PMJ Trans, ini adalah
                                tempat terbaik untuk membeli tiket dan membantu Anda menemukan liburan impian Anda.</p>
                        </div>

                        <!-- Testimoni 3 -->
                        <div class="carousel-item text-center">
                            <img src="img/avatar.png" class="testi-img mb-3" alt="Customer"
                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <h5><b>Nida Aulia Karima</b></h5>
                            <p>Customer</p>
                            <div class="stars mb-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="testimonial-text mx-auto" style="max-width: 500px;">Saya suka PMJ Trans, ini adalah
                                tempat terbaik untuk membeli tiket dan membantu Anda menemukan liburan impian Anda.</p>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimoni"
                        data-bs-slide="prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimoni"
                        data-bs-slide="next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- FOOTER -->
    <x-footer-customer />




    <script>
        // Deteksi scroll dan tambahkan kelas navbar-scrolled
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');
            if (window.scrollY > 50) { // Scroll lebih dari 50px
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
