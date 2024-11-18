@push('styles')
    <link id="pagestyle" href="{{ asset('css/frontend/css/navbarDriver-style.css') }}" rel="stylesheet" />
@endpush
<!-- CONTENT -->
<div class="navigation d-flex justify-content-center align-items-center">
    <div>
        <ul>
            <li class="list active">
                <a href="{{ route('dashboard-driver') }}">
                    <span class="icon">
                        <i class="fa-solid fa-house"></i>
                    </span>
                    <span class="text">Beranda</span>
                </a>
            </li>
            <li class="list">
                <a href="{{ route('trip-history') }}">
                    <span class="icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </span>
                    <span class="text">Riwayat</span>
                </a>
            </li>
            <li class="list">
                <a href="{{ route('profile-driver') }}">
                    <span class="icon">
                        <i class="fa-regular fa-user"></i>
                    </span>
                    <span class="text">Profil</span>
                </a>
            </li>
            <li class="list">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); confirmLogout(); document.getElementById('logout-form').submit();">
                    <span class="icon">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </span>
                    <span class="text">Keluar</span>
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="indicator"></div>
        </ul>
    </div>
</div>

<script>
    const listItems = document.querySelectorAll('.list a');
    const currentUrl = window.location.href;
    const indicator = document.querySelector('.indicator'); // Ambil elemen indicator

    let isActiveFound = false; // Variabel untuk memeriksa apakah ada yang aktif

    listItems.forEach((item) => {
        // Cek jika item href cocok dengan currentUrl
        if (item.href === currentUrl) {
            item.parentElement.classList.add('active');
            isActiveFound = true; // Tandai bahwa kita menemukan yang aktif
        } else {
            item.parentElement.classList.remove('active');
        }
    });

    // Cek apakah halaman yang sedang dibuka adalah salah satu dari yang diizinkan
    if (isActiveFound) {
        indicator.style.display = 'block'; // Tampilkan indicator jika ada yang aktif
    } else {
        indicator.style.display = 'none'; // Sembunyikan indicator jika tidak ada yang aktif
    }

    // validasi logout
    function confirmLogout() {
        // Tampilkan popup konfirmasi menggunakan SweetAlert2
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            text: "Anda harus login kembali untuk mengakses!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna memilih "Ya, keluar", submit form logout
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
