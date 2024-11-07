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
            <li class="breadcrumb-item"><a href="{{route('homepage')}}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{route('cek.status')}}">Cek Pemesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Status Pemesanan</li>
        </ol>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="modalPemesananDiterima" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: none !important; border: none;"><img
                            src="img/close.png"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img class="img-fluid" src="img/accepted-img.png">
                    </div>
                    <h5>Pemesanan Anda Diterima.</h5>
                    <form id="formModal">
                        <div class="mb-3">
                            <label for="kodeBooking" class="form-label">Kode Booking</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i class="fa-solid fa-ticket-simple"></i></span>
                                <input type="text" class="form-control" id="kodeBooking" value="{{ $booking->booking_code }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal Pembayaran</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i class="fa-solid fa-money-bill-wave"></i>
                                </span>
                                <input type="text" class="form-control" id="nominal" value="Rp. {{ number_format($booking->trip_nominal, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="minDp" class="form-label">Minimum DP</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i class="fa-solid fa-sack-dollar"></i></span>
                                <input type="text" class="form-control" id="minDp" value="Rp. {{ number_format($booking->minimum_dp, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <!-- TAMABAHAN -->
                        <div class="mb-5">
                            <label for="noRek" class="form-label">Nomor Rekening</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i class="fa-solid fa-landmark"></i></span>
                                <input type="text" class="form-control" id="noRek" placeholder="1234567890" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bayarSekarang" data-bs-dismiss="modal">Bayar Sekarang</button>
                                </div>
                            </div>
                        </div>
                        <!-- END TAMBAHAN -->
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
                    <h5 style="font-size: 44px; font-weight: 700; color: #1E9781; padding: 10px;">Status <span style="color: #FD9C07;">Pemesanan</span></h5>
                </div>
                <!-- FORM -->
                <form action="{{ route('booking.uploadProof', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formUploadDP" class="wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
                @csrf
                    <div class="row">
                        <!-- <div class="col-md-12 col-lg-6 mb-3 order-md-2 order-lg-1"> -->
                        <div class="col-lg-7"  style="padding: 40px;">
                            <div class="text-content mb-4">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781; ">Detail <span style="color: #FD9C07;">Pemesanan</span></h5>
                            </div>
                            <!-- <form action="{{ route('booking.uploadProof', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formUploadDP">
                                @csrf -->
                                <div class="pemesanan-diproses">
                                    <div class="mb-3">
                                        <label for="kodeBooking" class="form-label">Kode Booking</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="icon"><i class="fa-solid fa-ticket-simple"></i></span>
                                            <input type="text" id="kodeBooking" class="form-control" value="{{ $booking->booking_code }}" readonly>
                                        </div>
                                    </div>

                                    @if ($booking->id_ms_booking == 1)
                                        <!-- <div class="status-alert-diproses d-flex align-items-center">
                                            <span class="card-icon me-2" style="padding-left: 10px; color: white;"><i class="fa-solid fa-calendar"></i></span>
                                            <span style=" margin-left: 10px;"><b>Pesanan diproses </b><br><small>Admin sedang memproses pesanan anda, silakan cek status pemesanan secara berkala.</small></span>
                                        </div> -->
                                        <div class="status-alert-diproses d-flex align-items-center mb-3">
                                            <span class="card-icon me-2" style="padding-left: 10px; color: white;"><img src="{{ asset('img/icon/icon-proses.png') }}" alt="icon"></span>
                                            <span style=" margin-left: 10px;">
                                                <h5>PESANAN ANDA SEDANG DIPROSES</h5>
                                                <p>Admin sedang memproses pesanan anda, silakan cek status pemesanan secara berkala.</p>
                                            </span>
                                        </div>
                                    @elseif ($booking->id_ms_booking == 2)
                                        @if ($booking->id_ms_payment == 4)
                                            <!-- <div class="status-alert-diterima d-flex align-items-center">
                                                <span class="card-icon me-2" style="padding-left: 10px;"><i class="fa-solid fa-check" style="color: white;"></i></span>
                                                <span style=" margin-left: 10px;"><b>Pembayaran Lunas</b><br><small> Pemesanan anda telah lunas</small></span>
                                            </div> -->
                                            <div class="status-alert-diterima d-flex align-items-center mb-3">
                                                <span class="card-icon me-2" style="padding-left: 10px;color: white;font-size:25px;"><i class="fa-solid fa-credit-card"></i></span>
                                                <span style=" margin-left: 10px;">
                                                    <h5>PEMBAYARAN LUNAS</h5>
                                                    <p>Pembayaran Anda lunas. Terima kasih atas kepercayaan Anda.</p>
                                                </span>
                                            </div>
                                        @else
                                            <!-- <div class="status-alert-diterima d-flex align-items-center">
                                                <span class="card-icon me-2" style="padding-left: 10px;"><i class="fa-solid fa-calendar" style="color: white;"></i></span>
                                                <span style="margin-left: 10px;">
                                                    <b>Pesanan diterima admin</b><br>
                                                    <small>Admin telah menerima pesanan anda, silahkan lanjutkan ke upload bukti
                                                        @if ($booking->id_ms_payment == 2)
                                                            DP
                                                        @else
                                                            Pelunasan
                                                        @endif
                                                        Pemesanan.
                                                    </small>
                                                </span>
                                            </div> -->
                                            <div class="status-alert-diterima d-flex align-items-center mb-3">
                                            <span class="card-icon me-2" style="padding-left: 10px;font-size: 25px; color: white;"><i class="fa-regular fa-file-lines"></i></span>
                                                <span style=" margin-left: 10px;">
                                                    <h5>PESANAN ANDA DITERIMA</h5>
                                                    <p>
                                                        Admin telah menerima pesanan anda, silahkan lanjutkan ke upload bukti 
                                                        @if ($booking->id_ms_payment == 2)
                                                            DP
                                                        @else
                                                            Pelunasan
                                                        @endif
                                                        Pemesanan.
                                                    </p>
                                                </span>
                                            </div>
                                            <!-- <div class="rekening d-flex align-items-center">
                                                <span class="card-icon me-2" style="padding-left: 10px;"><i
                                                        class="fa-solid fa-building-columns" style="color: white;"></i></span>
                                                <span style=" margin-left: 10px;">
                                                    <b>Kirim Nomor Rekening</b>
                                                    9876543212345
                                                    <br>Sejumlah
                                                    @if ($booking->id_ms_payment == 2)
                                                        Rp
                                                        {{ number_format($booking->payment_received === null ? $booking->minimum_dp : $booking->payment_received, 0, ',', '.') }}
                                                        untuk menyelesaikan DP
                                                    @elseif ($booking->id_ms_payment == 3)
                                                        Rp {{ number_format($booking->payment_remaining, 0, ',', '.') }} untuk
                                                        menyelesaikan pelunasan
                                                    @endif
                                                </span> -->
                                                <!-- nominal -->
                                            <!-- </div> -->
                                            <div class="rekening d-flex align-items-center mb-3">
                                                <span class="card-icon me-2" style="padding-left: 10px;color: white; font-size: 25px;"><i class="fa-solid fa-landmark"></i></span>
                                                <span style=" margin-left: 10px;">
                                                    <!-- <h5>Kirim Nomor Rekening 9876543212345</h5> -->
                                                     <h5>KIRIM KE NOMOR REKENING</h5>
                                                    <!-- <p>Transfer Uang Sejumlah
                                                    @if ($booking->id_ms_payment == 2)
                                                        Rp
                                                        {{ number_format($booking->minimum_dp, 0, ',', '.') }}
                                                        untuk menyelesaikan DP
                                                    @elseif ($booking->id_ms_payment == 3)
                                                        Rp {{ number_format($booking->payment_remaining, 0, ',', '.') }} untuk
                                                        menyelesaikan pelunasan
                                                    @endif</p> -->
                                                    <p>Transfer Uang Sejumlah
                                                    @if ($booking->id_ms_payment == 2)
                                                        Rp
                                                        {{ number_format($booking->minimum_dp, 0, ',', '.') }}
                                                        untuk menyelesaikan DP, Ke Nomor Rekening <b>BRI : 221 3454 876</b>
                                                    @elseif ($booking->id_ms_payment == 3)
                                                        Rp {{ number_format($booking->payment_remaining, 0, ',', '.') }} untuk
                                                        menyelesaikan pelunasan, , Ke Nomor Rekening <b>BRI : 221 3454 876</b>
                                                    @endif</p>
                                                </span>
                                            </div>
                                        @endif
                                    @elseif ($booking->id_ms_booking == 3)
                                        <!-- <div class="status-alert-ditolak d-flex align-items-center">
                                            <span class="card-icon me-2" style="padding-left: 10px; color: white;"><i class="fa-solid fa-triangle-exclamation"></i></span>
                                            <span style=" margin-left: 10px;"><b>Pesanan ditolak admin</b><br><small>Admin menolak pesanan anda, pastikan data yang dimasukan benar.</small></span>
                                        </div> -->
                                        <div class="status-alert-ditolak d-flex align-items-center mb-3">
                                            <span class="card-icon me-2" style="padding-bottom: 5px; padding-left: 5px;"><img src="{{ asset('img/icon/icon-ditolak.png') }}" alt="icon"></span>
                                            <span style=" margin-left: 10px;">
                                                <h5>PESANAN ANDA DITOLAK</h5>
                                                <p>Admin menolak pesanan anda, pastikan data yang dimasukan benar.</p>
                                            </span>
                                        </div>
                                    @elseif ($booking->id_ms_booking == 4)
                                        <!-- <div class="status-alert-diterima d-flex align-items-center">
                                            <span class="card-icon me-2" style="padding-left: 10px;"><i class="fa-solid fa-check" style="color: white;"></i></span>
                                            <span style=" margin-left: 10px;"><b>Pesanan selesai</b><br><small>Pesanan anda telah selesai.</small></span>
                                        </div> -->
                                        <div class="status-alert-diterima d-flex align-items-center mb-3">
                                            <span class="card-icon me-2" style="padding-left: 10px;"><img src="{{ asset('img/icon/icon-lunas.png') }}" alt="icon"></span>
                                            <span style=" margin-left: 10px;">
                                                <h5>PEMESANAN SELESAI</h5>
                                                <p>Pesanan anda telah selesai.  Terima kasih atas kepercayaan Anda.</p>
                                            </span>
                                        </div>
                                    @elseif ($booking->id_ms_booking == 5)
                                        <!-- <div class="status-alert-dibatalkan d-flex align-items-center">
                                            <span class="card-icon me-2" style="padding-left: 10px; color: white;"><i class="fa-solid fa-xmark"></i></span>
                                            <span style=" margin-left: 10px;"><b>Pesanan dibatalkan</b><br><small>Pesanan anda dibatalkan.</small></span>
                                        </div> -->
                                        <div class="status-alert-dibatalkan d-flex align-items-center mb-3">
                                            <span class="card-icon me-2" style="padding-left: 10px; color: white;"><img src="{{ asset('img/icon/icon-ditolak.png') }}" alt="icon"></span>
                                            <span style=" margin-left: 10px;">
                                                <h5>PESANAN ANDA DIBATALKAN</h5>
                                                <p>Admin membatalkan pesanan anda, berdasarkan persetujuan anda.</p>
                                            </span>
                                        </div>
                                    @endif

                                    <!-- <div class="mb-3">
                                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="icon"><i class="fa-solid fa-user"></i></span>
                                            <input type="text" id="namaLengkap" class="form-control" value="{{ $booking->customer->name }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="icon"><i class="fa-solid fa-envelope"></i></span>
                                            <input type="email" id="email" class="form-control" value="{{ $booking->customer->email }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="noTelp" class="form-label">Nomor WhatsApp</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="icon"><i class="fa-solid fa-phone"></i></span>
                                            <input type="text" id="noTelp" class="form-control" value="{{ $booking->customer->number_phone }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" id="alamat" readonly>{{ $booking->customer->address }}</textarea>
                                        </div>
                                    </div> -->

                                    <!-- UNGGAH FILE -->
                                    @if ($booking->id_ms_booking == 2)
                                        @if ($booking->incomes->isNotEmpty())
                                            <div class="row mb-3">
                                                @foreach ($booking->incomes->slice(-2) as $income)
                                                    @if ($income->image_receipt != null)
                                                        <div class="col-6 mb-3">
                                                            <label for="formFile{{ $loop->iteration }}"
                                                                class="form-label">Bukti @if ($income->id_m_income == 1)
                                                                    DP
                                                                @elseif ($income->id_m_income == 2)
                                                                    Pelunasan
                                                                @endif
                                                            </label>
                                                            <img src="{{ asset('storage/' . $income->image_receipt) }}" class="rounded-image w-100" alt="Receipt Image" style="border-radius: 10px;">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                        @if ($booking->id_ms_payment == 2)
                                            <div class="mb-3">
                                                <label for="proof_of_payment_dp" class="form-label">Unggah Bukti DP<span class="text-danger">*</span></label>
                                                <!-- <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="proof_of_payment_dp" name="proof_of_payment_dp" required>
                                                </div> -->
                                                <div class="input-group">
                                                    <span class="input-group-text" id="icon" style="background-color: white !important;"><i class="fa-solid fa-arrow-up-from-bracket"></i></span>
                                                    <input type="file" class="form-control" id="proof_of_payment_dp" name="proof_of_payment_dp" required>
                                                </div>
                                                <small class="text-danger" id="error-file" style="display: none;padding-top: 10px;">Unggah foto bukti DP.</small>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li style="font-size:14px; color:#4180CC; font-weight: 700;">
                                                        Masukan bukti transfer berupa gambar dalam format JPG, PNG atau JPEG. Maksimal ukuran file 2 MB.
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- <div class="mt-5">
                                                <button type="submit" class="btn-kirimdp">Kirim</button>
                                            </div> -->
                                        @elseif ($booking->id_ms_payment == 3)
                                            <div class="mb-3">
                                                <label for="proof_of_payment_pelunasan" class="form-label">Unggah Bukti Pelunasan<span class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="proof_of_payment_pelunasan" name="proof_of_payment_pelunasan" required>
                                                </div>
                                                <small class="text-danger" id="error-file" style="display: none;padding-top: 10px;">Unggah foto bukti Pelunasan.</small>
                                            </div>
                                            <!-- <div class="mt-5">
                                                <button type="submit" class="btn-kirimdp">Kirim</button>
                                            </div> -->
                                        @endif
                                    @endif

                                    @foreach ($destinations as $destination)
                                        <div class="mb-3">
                                            <label for="destination_point" class="form-label">
                                                @if ($loop->count === 1)
                                                    {{-- Jika hanya ada satu destinasi --}}
                                                    Tujuan Akhir
                                                @elseif ($loop->last)
                                                    {{-- Jika iterasi terakhir --}}
                                                    Tujuan Akhir
                                                @else
                                                    {{-- Jika lebih dari satu dan bukan yang terakhir --}}
                                                    Tujuan {{ $loop->iteration }}
                                                @endif
                                                <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="icon"><i class="fa-solid fa-location-dot"></i></span>
                                                <input type="text" class="detail-pemesanan form-control" id="destination_point" name="destination_point" placeholder="Masukkan tujuan perjalanan" value="{{ $destination->name }}" readonly>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <button type="button" class="btn-tambahTujuan mb-4" id="add-field" disabled><i class="fa-solid fa-plus"></i> Tambah Tujuan</button> --}}
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label for="capacity" class="form-label">Jumlah Penumpang<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-user-group"></i></span>
                                                    <input type="number" class="detail-pemesanan form-control" id="capacity" name="capacity" value="{{ $booking->capacity }}" placeholder="Masukkan jumlah penumpang" min="1" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-center mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggle-leg-rest" 
                                                        {{ $booking->legrest == 1 ? 'checked' : '' }} 
                                                        disabled>
                                                    <label class="form-check-label" for="toggle-leg-rest">Leg Rest</label>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_start" class="form-label">Tanggal Mulai<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="icon"><i class="fa-solid fa-calendar-days"></i></span>
                                            <input type="datetime-local" class="detail-pemesanan form-control" id="date_start" name="date_start" value="{{ $booking->date_start }}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pickup_point" class="form-label">Titik Jemput<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="icon"><i class="fa-solid fa-location-dot"></i></span>
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

                                    <!-- BUTTON -->
                                    <!-- @if ($booking->id_ms_booking == 1 || $booking->id_ms_booking == 4)
                                        <div class="mt-5">
                                            <a href="" class="btn btn-hubungi">Hubungi Admin</a>
                                        </div>
                                    @elseif ($booking->id_ms_booking == 3)
                                        <div class="mt-5">
                                            <a href="{{ route('frontend.booking.index') }}" class="btn btn-perbaiki">Pesan ulang</a>
                                        </div>
                                    @elseif ($booking->id_ms_booking == 2)
                                        @if ($booking->incomes->isNotEmpty())
                                            <div class="row mb-3">
                                                @foreach ($booking->incomes->slice(-2) as $income)
                                                    @if ($income->image_receipt != null)
                                                        <div class="col-6 mb-3">
                                                            <label for="formFile{{ $loop->iteration }}"
                                                                class="form-label">Bukti @if ($income->id_m_income == 1)
                                                                    DP
                                                                @elseif ($income->id_m_income == 2)
                                                                    Pelunasan
                                                                @endif
                                                            </label>
                                                            <img src="{{ asset('storage/' . $income->image_receipt) }}"
                                                                class="rounded-image w-100" alt="Receipt Image"
                                                                style="border-radius: 10px;">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                        @if ($booking->id_ms_payment == 2)
                                            <div class="mb-3">
                                                <label for="proof_of_payment_dp" class="form-label">Unggah Bukti DP<span
                                                        class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="proof_of_payment_dp"
                                                        name="proof_of_payment_dp" required>
                                                </div>
                                                <small class="text-danger" id="error-file"
                                                    style="display: none;padding-top: 10px;">Unggah foto bukti DP.</small>
                                            </div>
                                            <div class="mt-5">
                                                <button type="submit" class="btn-kirimdp">Kirim</button>
                                            </div>
                                        @elseif ($booking->id_ms_payment == 3)
                                            <div class="mb-3">
                                                <label for="proof_of_payment_pelunasan" class="form-label">Unggah Bukti
                                                    Pelunasan<span class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="proof_of_payment_pelunasan" name="proof_of_payment_pelunasan"
                                                        required>
                                                </div>
                                                <small class="text-danger" id="error-file"
                                                    style="display: none;padding-top: 10px;">Unggah foto bukti
                                                    Pelunasan.</small>
                                            </div>
                                            <div class="mt-5">
                                                <button type="submit" class="btn-kirimdp">Kirim</button>
                                            </div>
                                        @endif
                                    @endif -->
                                </div>
                        </div>
                        <!-- HEADER -->
                        <!-- <div
                            class="col-md-12 col-lg-6 mb-3 d-flex flex-column justify-content-start align-items-center order-md-1 order-lg-2 d-none d-md-flex">
                            <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">Cek <span
                                    style="color: #FD9C07;">Pesanan</span></h5>
                            <div class="status-pemesanan">
                                <p>Status pemesan Anda saat ini</p>
                            </div>
                            <img src="/img/cek-img.png" class="img-fluid" alt="images"
                                style="padding: 0px 50px 0px 50px;">
                        </div> -->
                        <div class="col-lg-5" style="padding: 40px;">
                            <div class="text-content mb-4">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781; ">Detail <span style="color: #FD9C07;">Kontak</span></h5>
                            </div>
                            <div class="row">
                            <div class="mb-3">
                                <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" id="namaLengkap" class="form-control" value="{{ $booking->customer->name }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" id="email" class="form-control" value="{{ $booking->customer->email }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="noTelp" class="form-label">Nomor WhatsApp</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-wa.png') }}" alt="icon"></span>
                                    <input type="text" id="noTelp" class="form-control" value="{{ $booking->customer->number_phone }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-location-dot"></i></span>
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
                                <!-- <button type="button" class="btn-kirim">Bayar</button> -->
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
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('modalPemesananDiterima'));
                    myModal.show();
                });
            </script>
        @endif
    @endif
    <script>
        new WOW().init();
    </script>
@endsection
