<nav class="navbar fixed-top bg-white navbar-expand-lg">
    <div class="container-fluid">
        <div class="p-2 me-2">
            <a href="{{ url('/') }}" class="navbar-brand"></a>
            <img class="img-fluid"
                src="https://upload.wikimedia.org/wikipedia/en/thumb/7/7a/Manchester_United_FC_crest.svg/1200px-Manchester_United_FC_crest.svg.png"
                alt="Icon" style="width: 50px; height: 50px;">
            </a>
        </div>
        <a href="{{ url('/') }}" class="navbar-brand">
            <h1 class="m-0 text-primary">PMJ Trans</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ url('/') }}">Beranda</a>
                    </li>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}"
                        href="{{ url('tentang-kami') }}">Tentang Kami</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is('kontak') ? 'active' : '' }}"
                        href="{{ url('kontak') }}">Kontak</a>
                </li>
                @auth
                    @if (auth()->user()->is_admin)
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link {{ Request::is('profile', 'history') ? 'active' : '' }} dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                {{-- <li><a class="dropdown-item {{ Request::is('profile') ? 'active' : '' }}"
                                        href="{{ route('profile.index') }}">Profil</a></li>
                                <li><a class="dropdown-item {{ Request::is('history') ? 'active' : '' }}"
                                        href="{{ route('history.index') }}">Riwayat Sewa</a></li> --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Keluar
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endif
                @else
                    <li class="nav-item mx-3">
                        <a href="{{ route('login') }}" class="btn btn-primary shadow-sm">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
