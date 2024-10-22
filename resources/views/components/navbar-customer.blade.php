@push('styles')
    <link id="pagestyle" href="{{ asset('css/frontend/css/navbarCustomer-style.css') }}" rel="stylesheet" />
@endpush
<div>
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid  justify-content-start">
            <a class="navbar-brand" href="#"><img src="{{ asset('img/logo.png') }}" width="60px" height="45px" style="margin-left: 20px;"></a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: 30px;">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bus') }}">Bus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Kontak Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('terms-conditions') }}">Syarat & Ketentuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cek.status') }}">Cek Pemesanan</a>
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
                        <a href="{{ route('login') }}">Login</a>
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
    //hover active
    const currentLocation = location.href;
    const menuItems = document.querySelectorAll('.nav-link');
    menuItems.forEach(item => {
        if (item.href === currentLocation) {
            item.classList.add('active');
        }
    });
</script>
