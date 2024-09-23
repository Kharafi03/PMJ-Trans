@extends('frontend.layouts.app')
@push('styles')
    <link id="pagestyle" href="{{ asset('css/frontend/css/navbarCustomer-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
<div>
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid  justify-content-start">
            <a class="navbar-brand" href="#"><img src="img/logo.png" width="30px" height="30px">&nbsp; PMJ
                Trans</a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Pusat Bantuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking-status') }}">Cek Pesanan</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('history.index') }}">Riwayat Sewa</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Keluar
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @else
                        {{-- <li class="nav-item mx-3">
                        <a href="{{ route('login') }}" class="btn btn-primary shadow-sm">Login</a>
                    </li> --}}
                        <li class="nav-item">
                            <div class="col-md-2">
                                <a href="{{ route('login') }}" class="btn-login btn rounded-pill ml-2">Login</a>
                            </div>
                        </li>
                    @endauth
                </ul>

                {{-- <div class="col-md-2">
                        <a href="#" class="btn-login btn rounded-pill ml-2">Login</a>
                    </div> --}}
            </div>
        </div>
    </nav>
</div>

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
