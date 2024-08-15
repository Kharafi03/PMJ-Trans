<style>
    .nav-treeview {
        transition: max-height 0.5s ease-in-out;
        max-height: 0;
        overflow: hidden;
    }

    .nav-item.has-treeview:hover .nav-treeview {
        max-height: 500px;
        /* Atur sesuai kebutuhan tinggi maksimum sub-menu */
    }
</style>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/7/7a/Manchester_United_FC_crest.svg/1200px-Manchester_United_FC_crest.svg.png"
                class="navbar-brand-img h-100" alt="main_logo" />
            <span class="ms-1 font-weight-bold">PMJ Trans</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-house text-info text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-user text-warning text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Pengguna') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bus.*') ? 'active bg-primary text-white' : '' }}"
                    href="{{ route('admin.bus.index') }}">
                    <i class="fa-solid fa-bus text-success text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Bus') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.driver.*') ? 'active bg-primary text-white' : '' }}"
                    href="{{ route('admin.driver.index') }}">
                    <i class="fa-solid fa-user text-info text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Driver') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-calendar text-danger text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Booking') }}</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#kategoriCollapse"
                    class="nav-link {{ request()->routeIs('admin.types.*') || request()->routeIs('admin.typemotorcycles.*') ? 'active bg-primary text-white' : '' }}"
                    data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ request()->routeIs('admin.types.*') || request()->routeIs('admin.typemotorcycles.*') ? 'true' : 'false' }}"
                    aria-controls="kategoriCollapse">
                    <i class="fa-solid fa-list text-success text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">
                        {{ __('Kendaraan') }}
                    </span>
                </a>
                <div class="collapse mt-1 {{ request()->routeIs('admin.types.*') || request()->routeIs('admin.typemotorcycles.*') ? 'show' : '' }}"
                    id="kategoriCollapse">
                    <div class="nav-item">
                        <a href=""
                            class="nav-link {{ request()->routeIs('admin.typemotorcycles.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa-solid fa-motorcycle text-success text-lg opacity-10"></i>
                            <span class="nav-link-text ms-1">List Bus</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href=""
                            class="nav-link {{ request()->routeIs('admin.types.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa-solid fa-car text-success text-lg opacity-10"></i>
                            <span class="nav-link-text ms-1"></span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="#kendaraanCollapse"
                    class="nav-link {{ request()->routeIs('admin.motorcycles.*') || request()->routeIs('admin.cars.*') ? 'active bg-primary text-white' : '' }}"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="kendaraanCollapse">
                    <i class="fa-solid fa-ring text-info text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">
                        Kendaraan
                    </span>
                </a>
                <div class="collapse mt-1 {{ request()->routeIs('admin.motorcycles.*') || request()->routeIs('admin.cars.*') ? 'show' : '' }}"
                    id="kendaraanCollapse">
                    <div class="nav-item">
                        <a href=""
                            class="nav-link {{ request()->routeIs('admin.motorcycles.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa-solid fa-motorcycle text-info text-lg opacity-10"></i>
                            <span class="nav-link-text ms-1">Motor</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href=""
                            class="nav-link {{ request()->routeIs('admin.cars.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa-solid fa-car text-info text-lg opacity-10"></i>
                            <span class="nav-link-text ms-1">Mobil</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-calendar text-info text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Booking') }}</span>
                </a>
            </li> --}}
            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.cancellations.*') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-xmark text-danger text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Pembatalan') }}</span>
                </a>
            </div>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.feedbacks.*') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-quote-left text-warning text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Ulasan') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-envelope text-info text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Pesan') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-user-group text-success text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Team') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#pengaturanCollapse"
                    class="nav-link {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.faqs.*') ? 'active bg-primary text-white' : '' }}"
                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="pengaturanCollapse">
                    <i class="fa-solid fa-gears text-info text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">
                        Pengaturan Web
                    </span>
                </a>
                <div class="collapse mt-1 {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.faqs.*') ? 'show' : '' }}"
                    id="pengaturanCollapse">
                    <div class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active bg-primary text-white' : '' }}"
                            href="">
                            <i class="fa-solid fa-gears text-warning text-lg opacity-10"></i>
                            <span class="nav-link-text ms-1">{{ __('Pengaturan Tampilan') }}</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active bg-primary text-white' : '' }}"
                            href="">
                            <i class="fa-solid fa-question text-info text-lg opacity-10"></i>
                            <span class="nav-link-text ms-1">Pengaturan FAQ</span>
                        </a>
                    </div>
                </div>
        </ul>
    </div>
    <div class="sidenav-footer">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">
                    Akun Admin
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.admin.edit') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-user text-dark text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ Auth::user()->name }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.admin.index') ? 'active bg-primary text-white' : '' }}"
                    href="">
                    <i class="fa-solid fa-address-book text-success text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Daftar Admin') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket text-danger text-lg opacity-10"></i>
                    <span class="nav-link-text ms-1">{{ __('Keluar') }}</span>
                </a>
                <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf

                </form>
            </li>
        </ul>
    </div>
</aside>
@push('scripts')
    <script>
        document.querySelectorAll('.nav-link').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endpush
