@extends('frontend.layouts.app')
@push('styles')
    <link id="pagestyle" href="{{ asset('css/frontend/css/footer-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
<div>
    <!-- FOOTER -->
    <footer class="footer mt-5">
        <div class="container" style="padding: 50px 0px;">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <img src="img/logo.png" alt="Travelo Logo" height="30">
                    <span style="color: white;font-size: 24px; font-weight: bold;">PMJ Trans</span>
                    <p class="caption1">PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.</p>
                </div>
                <div class="col-md-3 mb-3">
                    <h6>Hubungi Kami</h6>
                    <ul class="list-unstyled">
                        <li><li><a href="#" style="text-decoration: none;"> Jl. Lingkar Timur, Kabupaten Kudus, Jawa Tengah</a></li></li>
                        <li><li><a href="#" style="text-decoration: none;">pmjtrans@gmail.com</a></li></li>
                        <li><li><a href="#" style="text-decoration: none;">0856-9877-5655</a></li></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h6>Link Cepat</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" style="text-decoration: none;">Beranda</a></li>
                        <li><a href="#package" style="text-decoration: none;">Bus</a></li>
                        <li><a href="#about" style="text-decoration: none;">Tentang Kami</a></li>
                        <li><a href="#" style="text-decoration: none;">Pusat Bantuan</a></li>
                        <li><a href="#" style="text-decoration: none;">Cek Pesanan</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Sosial Media</h6>
                    <div>
                        <a href="#" class="text-light mx-2"><i class="fab fa-instagram"></i></i></a>
                        <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light mx-2"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright container">
      <p class="text-center m-0" style="color:#00000094;">&copy;2024 PMJ Trans. All Rights Reserved</p>
    </div>
</div>