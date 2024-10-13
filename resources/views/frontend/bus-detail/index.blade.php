@extends('frontend.layouts.app')
@push('styles')
    <title>Detail Bus</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/detailBus-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- CONTENT -->
    <section id="detailBus">
        <div class="container mt-5 mb-5">
            <h5>Daftar <span style="color: #FD9C07;">Bus PMJ</span></h5>
            <div class="bus-card">
              <div class="row">
                <!-- <div class="col-md-4">
                <img src="../asset/img/image1.png" alt="Bus Image" class="bus-image">
                </div> -->
                <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
                    <img id="mainBusImage" src="/img/pmj02-2.jpg" alt="Bus Image" class="bus-image img-fluid">
                    <div class="row mt-3 mb-3">
                        <div class="col-12 thumbnail-images">
                        <img src="/img/pmj02-2.jpg" alt="Thumbnail 1" class="thumbnail" onclick="changeImage(this)">
                        <img src="/img/pmj02-3.jpg" alt="Thumbnail 2" class="thumbnail" onclick="changeImage(this)">
                        <img src="/img/pmj02-4.jpg" alt="Thumbnail 3" class="thumbnail" onclick="changeImage(this)">
                        <img src="/img/pmj02-5.jpg" alt="Thumbnail 4" class="thumbnail" onclick="changeImage(this)">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 mt-3">
                    <div class="d-flex justify-content-between">
                        <p class="bus-title">PMJ 05</p>
                        <div class="bus-star">
                            <i class="fa-solid fa-star"></i> 4.7
                        </div>  
                    </div>
                    <p class="bus-type">Jetbus 3+ Voyager Adiputro</p>
                    <div class="row mt-3 text-center fasilitas">
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
                <ul class="bus-description">
                    <li>Dilengkapi dengan AC, toilet, dan seluruh untuk kenyamanan perjalanan.</li>
                    <li>Kursi recliner nyaman, seatbelt pada setiap kursi.</li>
                    <li>Tersedia hiburan, port USB, dan audio di setiap kursi.</li>
                    <li>Harga tiket sekitar Rp 300.000, durasi 3-4 jam.</li>
                </ul>
                <div class="d-flex justify-content-end align-items-center">
                    <button class="btn-back">Kembali</button>
                </div>
                </div>
              </div>
            </div>
            <div class="testimoni-content mt-5 mb-5">
            <h5 style="margin-bottom: 50px;">Testimoni</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="filter">
                            <div class="filter-content">
                                <div class="filter-header">
                                    <p>Terbaru <i class="fa-solid fa-angle-up"></i></p>
                                </div>
                                <form>
                                    <label>
                                        <input type="checkbox" name="option1" value="Option 1">
                                        Terbaru
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="option2" value="Option 2">
                                        Rating Tertinggi
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="option3" value="Option 3">
                                        Rating Terendah
                                    </label>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="testimoni-container">
                            <div class="testi">
                                <p class="tanggal-testi">13 Maret 2024</p>
                                <div class="rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="profile-card">
                                    <img src="img/driver.png" alt="Profile Image">
                                    <div class="profile-text">
                                        <h5>Nida Aulia Karima</h5>
                                    </div>
                                </div>
                                <p class="role">Customer</p>
                                <div class="isi-testi">
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non at sed quo ratione? Aliquam quisquam quia consectetur! Voluptas ducimus pariatur sit voluptates? Maxime laudantium nemo quaerat provident ab quis nihil?</p>
                                </div>
                            </div>
                            <div class="testi">
                                <p class="tanggal-testi">13 Maret 2024</p>
                                <div class="rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="profile-card">
                                    <img src="img/driver.png" alt="Profile Image">
                                    <div class="profile-text">
                                        <h5>Nida Aulia Karima</h5>
                                    </div>
                                </div>
                                <p class="role">Customer</p>
                                <div class="isi-testi">
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non at sed quo ratione? Aliquam quisquam quia consectetur! Voluptas ducimus pariatur sit voluptates? Maxime laudantium nemo quaerat provident ab quis nihil?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
  <script>
    function changeImage(element) {
      var newImage = element.src;
      var mainImage = document.getElementById('mainBusImage');
      
      // Tambahkan efek fade-out dengan mengubah opacity
      mainImage.style.opacity = 0;

      // Setelah 500ms (durasi fade-out), ganti gambar dan fade-in
      setTimeout(function() {
        mainImage.src = newImage;
        mainImage.style.opacity = 1;
      }, 200);
    }
  </script>

    <!-- FOOTER -->
     <x-footer-customer/>
@endsection