@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Status</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/statusPesanan-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- Bread Crumbs -->
    <nav aria-label="breadcrumb" style="margin-top: 100px;" class="wow animate__animated animate__fadeIn" data-wow-delay="0.6s">
        <ol class="breadcrumb d-flex justify-content-center align-items-center">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cek.status') }}">Cek Pemesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Status Pemesanan</li>
        </ol>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="modalPemesananDiterima" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: none !important; border: none;">
                        <img src="{{ asset('img/close.png') }}">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img class="img-fluid" src="{{ asset('img/accepted-img.png') }}">
                    </div>
                    <h5>Pemesanan Anda Diterima.</h5>
                    <form id="formModal">
                        <div class="mb-3">
                            <label for="kodeBooking" class="form-label">Kode Booking</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon">
                                    <i class="fa-solid fa-ticket-simple"></i>
                                </span>
                                <input type="text" class="form-control" id="kodeBooking" value="{{ $booking->booking_code }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal Pembayaran</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                </span>
                                <input type="text" class="form-control" id="nominal" value="Rp. {{ number_format($booking->trip_nominal, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="minDp" class="form-label">Minimum DP</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                </span>
                                <input type="text" class="form-control" id="minDp" value="Rp. {{ number_format($booking->minimum_dp, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <!-- TAMABAHAN -->
                        <div class="mb-5">
                            <label for="noRek" class="form-label">Nomor Rekening</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i class="fa-solid fa-landmark"></i></span>
                                <input type="text" class="form-control" id="noRek" value="{{ $setting->bank_account ? $setting->bank_account : '#' }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bayarSekarang" data-bs-dismiss="modal">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <section id="statusPesanan">
        <div class="container mt-5 mb-5">
            <!-- CARD -->
            <div class="mb-3">
                <div class="form-header mb-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                    <h5 style="font-size: 44px; font-weight: 700; color: #1E9781; padding: 10px;">
                        Status <span style="color: #FD9C07;">Pemesanan</span>
                    </h5>
                </div>
                <!-- FORM -->
                <form action="{{ route('booking.uploadProof', $encryptedId) }}" method="POST" enctype="multipart/form-data"
                    id="formUploadDP" class="wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
                    @csrf
                    <div class="row">
                        {{-- Detail Pemesanan --}}
                        <div class="col-lg-7" style="padding: 40px;">
                            <div class="text-content mb-4">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781; ">
                                    Detail 
                                    <span style="color: #FD9C07;">Pemesanan</span>
                                </h5>
                            </div>
                            <div class="pemesanan-diproses">
                                <div class="mb-3">
                                    <label for="kodeBooking" class="form-label">Kode Booking</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon">
                                            <i class="fa-solid fa-ticket-simple"></i>
                                        </span>
                                        <input type="text" id="kodeBooking" class="form-control" value="{{ $booking->booking_code }}" readonly>
                                    </div>
                                </div>
                                {{-- Jika Status Pemesanan Masih Draf --}}
                                @if ($booking->id_ms_booking == 1)
                                    <div class="status-alert-diproses d-flex align-items-center mb-3">
                                        <span class="card-icon mx-3">
                                            <i class="fa-solid fa-arrows-rotate "></i>
                                        </span>
                                        <span>
                                            <h5>PESANAN ANDA SEDANG DIPROSES</h5>
                                            <p>Admin sedang memproses pesanan anda, silakan cek status pemesanan secara berkala.</p>
                                        </span>
                                    </div>
                                {{-- Jika Status Pemesanan Diterima --}}
                                @elseif ($booking->id_ms_booking == 2)
                                    {{-- Jika Pembayaran Lunas --}}
                                    @if ($booking->id_ms_payment == 4)
                                        <div class="status-alert-diterima d-flex align-items-center mb-3">
                                            <span class="card-icon mx-3">
                                                <i class="fa-solid fa-credit-card"></i>
                                            </span>
                                            <span>
                                                <h5>PEMBAYARAN LUNAS</h5>
                                                <p>Pembayaran Anda lunas. Terima kasih atas kepercayaan Anda.</p>
                                            </span>
                                        </div>
                                    {{-- Jika Pembayaran DP atau Pelunasan belum dibayar --}}
                                    @else
                                        <div class="status-alert-diterima d-flex align-items-center mb-3">
                                            <span class="card-icon mx-3">
                                                <i class="fa-solid fa-file-lines"></i>
                                            </span>
                                            <span>
                                                <h5>PESANAN ANDA DITERIMA</h5>
                                                <p>Admin telah menerima pesanan anda, silahkan lanjutkan ke upload bukti
                                                    @if ($booking->id_ms_payment == 2)
                                                        DP
                                                    @else
                                                        Pelunasan
                                                    @endif
                                                    Pemesanan.
                                                </p>
                                            </span>
                                        </div>
                                        <div class="rekening d-flex align-items-center mb-3">
                                            <span class="card-icon mx-3"> 
                                                <i class="fa-solid fa-landmark"></i>
                                            </span>
                                            <span>
                                                <h5>KIRIM KE NOMOR REKENING {{ $setting->bank_account ? $setting->bank_account : '#' }}</h5>
                                                <p>Uang Sejumlah
                                                    @if ($booking->id_ms_payment == 2)
                                                        <b>Rp {{ number_format($booking->minimum_dp, 0, ',', '.') }}</b>
                                                        untuk menyelesaikan DP
                                                    @elseif ($booking->id_ms_payment == 3)
                                                        <b>Rp {{ number_format($booking->payment_remaining, 0, ',', '.') }}</b>
                                                        untuk menyelesaikan pelunasan
                                                    @endif
                                                </p>
                                            </span>
                                        </div>
                                    @endif
                                {{-- Jika Status Pemesanan Ditolak --}}
                                @elseif ($booking->id_ms_booking == 3)
                                    <div class="status-alert-ditolak d-flex align-items-center mb-3">
                                        <span class="card-icon mx-3">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </span>
                                        <span>
                                            <h5>PESANAN ANDA DITOLAK</h5>
                                            <p>Admin menolak pesanan anda, pastikan data yang dimasukan benar.</p>
                                        </span>
                                    </div>
                                {{-- Jika Status Pemesanan Selesai --}}
                                @elseif ($booking->id_ms_booking == 4)
                                    <div class="status-alert-diterima d-flex align-items-center mb-3">
                                        <span class="card-icon mx-3">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                        <span>
                                            <h5>PEMESANAN SELESAI</h5>
                                            <p>Pesanan anda telah selesai.  Terima kasih atas kepercayaan Anda.</p>
                                        </span>
                                    </div>
                                @elseif ($booking->id_ms_booking == 5)
                                    <div class="status-alert-ditolak d-flex align-items-center mb-3">
                                        <span class="card-icon mx-3">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </span>
                                        <span style="margin-left: 10px;">
                                            <h5>PESANAN ANDA DIBATALKAN</h5>
                                            <p>Admin membatalkan pesanan anda, berdasarkan persetujuan anda.</p>
                                        </span>
                                    </div>
                                @endif
                                {{-- Jika Status Pemesanan Diterima --}}
                                @if ($booking->id_ms_booking == 2)
                                    {{-- Jika Ada Bukti Pembayaran Sebelumnya --}}
                                    @if ($booking->incomes->isNotEmpty())
                                        <div class="row mb-3">
                                            @foreach ($booking->incomes->slice(-2) as $income)
                                                @if ($income->image_receipt != null)
                                                    <div class="col-6 mb-3">
                                                        <label class="form-label">
                                                            Bukti
                                                            @if ($income->id_m_income == 1)
                                                                DP
                                                            @elseif ($income->id_m_income == 2)
                                                                Pelunasan
                                                            @endif
                                                        </label>
                                                        <img src="{{ asset('storage/' . $income->image_receipt) }}" class="rounded-image w-100" id="formFile{{ $loop->iteration }}" alt="Receipt Image" style="border-radius: 10px;">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    {{-- Unggah Bukti Pembayaran --}}
                                    {{-- Jika status pembayaran DP Belum Dibayar --}}
                                    @if ($booking->id_ms_payment == 2)
                                        <div class="mb-4">
                                            <label for="proof_of_payment_dp" class="form-label">
                                                Unggah Bukti DP
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="icon" style="background-color: white !important;">
                                                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                </span>
                                                <input type="file" class="form-control @error('proof_of_payment_dp') is-invalid @enderror" id="proof_of_payment_dp" name="proof_of_payment_dp" accept="image/*" required>
                                                @error('proof_of_payment_dp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <ul>
                                                <li style="font-size:14px; color:#4180CC; font-weight: 700;">
                                                    Masukan bukti transfer berupa gambar dalam format JPG, PNG atau JPEG. Maksimal ukuran file 2 MB.
                                                </li>
                                            </ul>
                                        </div>
                                    {{-- Jika status pembayaran DP Sudah Dibayar --}}
                                    @elseif ($booking->id_ms_payment == 3)
                                        <div class="mb-4">
                                            <label for="proof_of_payment_pelunasan" class="form-label">
                                                Unggah Bukti Pelunasan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="icon" style="background-color: white !important;">
                                                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                </span>
                                                <input type="file" class="form-control @error('proof_of_payment_pelunasan') is-invalid @enderror" id="proof_of_payment_pelunasan" name="proof_of_payment_pelunasan" accept="image/*" required>
                                                @error('proof_of_payment_pelunasan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                {{-- Destinasi --}}
                                @foreach ($destinations as $destination)
                                    <div class="mb-3">
                                        <label for="destination_point" class="form-label">
                                            @if ($loop->count === 1)
                                                Tujuan Akhir
                                            @elseif ($loop->last)
                                                Tujuan Akhir
                                            @else
                                                Tujuan {{ $loop->iteration }}
                                            @endif
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="icon">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </span>
                                            <input type="text" class="detail-pemesanan form-control" id="destination_point" name="destination_point" placeholder="Masukkan tujuan perjalanan" value="{{ $destination->name }}" readonly>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label for="capacity" class="form-label">
                                                Jumlah Penumpang
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="icon">
                                                    <i class="fa-solid fa-user-group"></i>
                                                </span>
                                                <input type="number" class="detail-pemesanan form-control" id="capacity" name="capacity" value="{{ $booking->capacity }}" placeholder="Masukkan jumlah penumpang" min="1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center mt-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="toggle-leg-rest" {{ $booking->legrest == 1 ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="toggle-leg-rest">
                                                    Leg Rest
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="date_start" class="form-label">Tanggal Mulai
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="datetime-local" class="detail-pemesanan form-control" id="date_start" name="date_start" value="{{ $booking->date_start }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="pickup_point" class="form-label">
                                        Titik Jemput
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="icon">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <textarea class="form-control" placeholder="Masukkan alamat lengkap" id="pickup_point" name="pickup_point" readonly>{{ $booking->pickup_point }}</textarea>
                                    </div>
                                </div>
                                <div>
                                    <ul>
                                        <li style="font-size:14px; color:#4180CC; font-weight: 700;">
                                            Contoh : Jalan Mangga Besar III No. 17, RT 06 RW 07, Kelurahan Bedali, Kecamatan Lawang, Kab. Malang, Jawa Timur, 60256
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- Detail Kontak --}}
                        <div class="col-lg-5" style="padding: 40px;">
                            <div class="text-content mb-4">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781; ">
                                    Detail <span style="color: #FD9C07;">Kontak</span>
                                </h5>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" id="namaLengkap" class="form-control" value="{{ $booking->customer->name }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="email" id="email" class="form-control" value="{{ $booking->customer->email }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="noTelp" class="form-label">Nomor WhatsApp</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </span>
                                        <input type="text" id="noTelp" class="form-control" value="{{ $booking->customer->number_phone }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-location-dot"></i></span>
                                        <textarea class="form-control" id="alamat" readonly>{{ $booking->customer->address }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-5 d-flex justify-content-end">
                                    @if ($booking->id_ms_booking == 1 || $booking->id_ms_booking == 4)
                                        <div class="mt-5">
                                            <a href="" class="btn btn-hubungi">Hubungi Admin</a>
                                        </div>
                                    @elseif ($booking->id_ms_booking == 3)
                                        <div class="mt-5">
                                            <a href="{{ route('booking') }}" class="btn btn-perbaiki">Pesan ulang</a>
                                        </div>
                                    @elseif ($booking->id_ms_booking == 2)
                                        @if ($booking->id_ms_payment != 4)
                                            <div class="mt-5">
                                                <button type="submit" class="btn-kirim">Bayar</button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />
    @if ($booking->id_ms_booking == 2)
        @if ($booking->id_ms_payment == 2)
            @push('scripts')
                <script>
                    $(document).ready(function() {
                        var myModal = new bootstrap.Modal($('#modalPemesananDiterima'));
                        myModal.show();
                    });
                </script>
            @endpush
        @endif
    @endif
    <script>
        new WOW().init();
    </script>
    @if($errors->any())
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengirim Bukti Pembayaran',
                        text: '{{ implode(', ', $errors->all()) }}',
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'custom-ok-button'
                        }
                    });
                });
            </script>
        @endpush
        @push('styles')
            <style>
                .custom-ok-button {
                    background-color: #1E9781;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                }
        
                .custom-ok-button:hover {
                    background-color: #1E9781;
                }
            </style>
        @endpush
    @endif
@endsection
