@extends('frontend.layouts.app')
@push('styles')
    <title>
        Booking Processed</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesananDiproses-style.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesananDiterima-style.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesananDitolak-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- Modal -->
    <div class="modal fade" id="modalPemesananDiterima" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><img
                            src="img/close.png"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img class="img-fluid" src="img/accepted-img.png">
                    </div>
                    <h5>Pemesanan Anda Diterima.</h5>
                    <form>
                        <div class="mb-3">
                            <label for="kodeBooking" class="form-label">Kode Booking</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i
                                        class="fa-solid fa-ticket-simple"></i></span>
                                <input type="text" class="form-control" id="kodeBooking"
                                    value="{{ $booking->booking_code }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal Pembayaran</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i class="fa-solid fa-wallet"></i></span>
                                <input type="text" class="form-control" id="nominal"
                                    value="Rp. {{ number_format($booking->trip_nominal, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="minDp" class="form-label">Minimum DP</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i class="fa-solid fa-wallet"></i></span>
                                <input type="text" class="form-control" id="minDp"
                                    value="Rp. {{ number_format($booking->minimum_dp, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <!-- TAMABAHAN -->
                        <div class="mb-3">
                            <label for="noRek" class="form-label">Nomor Rekening</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="icon"><i
                                        class="fa-solid fa-building-columns"></i></span>
                                <input type="text" class="form-control" id="noRek" placeholder="1234567890" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="text-danger">Tekan "Bayar Sekarang" untuk unggah bukti transfer, atau pilih "Bayar
                                Nanti" jika menunda.</p>
                        </div>
                        <div class="mb-3">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bayarSekarang" data-bs-dismiss="modal">Bayar
                                        Sekarang</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn-bayarNanti" data-bs-dismiss="modal"><a
                                            href="{{ route('history.index') }}">Bayar Nanti</a></button>
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
    <section id="pemesananDiproses">
        <div class="container mt-5">
            <!-- CARD -->
            <div class="mb-3">
                <div class="row">
                    <!-- FORM -->
                    <div class="col-md-12 col-lg-6 mb-3 order-md-2 order-lg-1">
                        <form action="{{ route('booking.uploadProof', $booking->id) }}" method="POST"
                            enctype="multipart/form-data" id="formUploadDP">
                            <div class="form-header text-center mb-5">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781;">Cek <span
                                        style="color: #FD9C07;">Pesanan</span></h5>
                            </div>
                            @csrf
                            <div class="pemesanan-diproses">
                                <div class="mb-3">
                                    <label for="kodeBooking" class="form-label">Kode Booking</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-ticket-simple"></i></span>
                                        <input type="text" id="kodeBooking" class="form-control"
                                            value="{{ $booking->booking_code }}" readonly>
                                    </div>
                                </div>

                                @if ($booking->id_ms_booking == 1)
                                    <div class="status-alert-diproses d-flex align-items-center">
                                        <span class="card-icon me-2" style="padding-left: 10px; color: white;"><i
                                                class="fa-solid fa-calendar"></i></span>
                                        <span style=" margin-left: 10px;"><b>Pesanan diproses </b><br><small>Admin sedang
                                                memproses pesanan anda, silakan cek status pemesanan secara
                                                berkala.</small></span>
                                    </div>
                                @elseif ($booking->id_ms_booking == 2)
                                    @if ($booking->id_ms_payment == 4)
                                        <div class="status-alert-diterima d-flex align-items-center">
                                            <span class="card-icon me-2" style="padding-left: 10px;"><i
                                                    class="fa-solid fa-check" style="color: white;"></i></span>
                                            <span style=" margin-left: 10px;"><b>Pembayaran Lunas</b><br><small>
                                                    Pemesanan anda telah lunas</small></span>
                                        </div>
                                    @else
                                        <div class="status-alert-diterima d-flex align-items-center">
                                            <span class="card-icon me-2" style="padding-left: 10px;"><i
                                                    class="fa-solid fa-calendar" style="color: white;"></i></span>
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
                                        </div>
                                        <div class="rekening d-flex align-items-center">
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
                                            </span>
                                            <!-- nominal -->
                                        </div>
                                    @endif
                                @elseif ($booking->id_ms_booking == 3)
                                    <div class="status-alert-ditolak d-flex align-items-center">
                                        <span class="card-icon me-2" style="padding-left: 10px; color: white;"><i
                                                class="fa-solid fa-triangle-exclamation"></i></span>
                                        <span style=" margin-left: 10px;"><b>Pesanan ditolak admin</b><br><small>Admin
                                                menolak pesanan anda, pastikan data yang dimasukan benar.</small></span>
                                    </div>
                                @elseif ($booking->id_ms_booking == 4)
                                    <div class="status-alert-diterima d-flex align-items-center">
                                        <span class="card-icon me-2" style="padding-left: 10px;"><i
                                                class="fa-solid fa-check" style="color: white;"></i></span>
                                        <span style=" margin-left: 10px;"><b>Pesanan selesai</b><br><small>Pesanan
                                                anda telah selesai.</small></span>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-user"></i></span>
                                        <input type="text" id="namaLengkap" class="form-control"
                                            value="{{ $booking->customer->name }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-envelope"></i></span>
                                        <input type="email" id="email" class="form-control"
                                            value="{{ $booking->customer->email }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="noTelp" class="form-label">Nomor WhatsApp</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-phone"></i></span>
                                        <input type="text" id="noTelp" class="form-control"
                                            value="{{ $booking->customer->number_phone }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" id="alamat" readonly>{{ $booking->customer->address }}</textarea>
                                    </div>
                                </div>
                                <!-- BUTTON -->
                                @if ($booking->id_ms_booking == 1 || $booking->id_ms_booking == 4)
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
                                @endif
                            </div>
                        </form>
                    </div>
                    <!-- HEADER -->
                    <div
                        class="col-md-12 col-lg-6 mb-3 d-flex flex-column justify-content-start align-items-center order-md-1 order-lg-2 d-none d-md-flex">
                        <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">Cek <span
                                style="color: #FD9C07;">Pesanan</span></h5>
                        <div class="status-pemesanan">
                            <p>Status pemesan Anda saat ini</p>
                        </div>
                        <img src="/img/cek-img.png" class="img-fluid" alt="images"
                            style="padding: 0px 50px 0px 50px;">
                    </div>
                </div>
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
@endsection
