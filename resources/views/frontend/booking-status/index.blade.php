@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Processed</title>
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
                            <input type="text" class="form-control" id="kodeBooking" value="{{ $booking->booking_code }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal Pembayaran</label>
                            <input type="text" class="form-control" id="nominal" value="{{ $booking->trip_nominal }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="minDp" class="form-label">Minimum DP</label>
                            <input type="text" class="form-control" id="minDp" value="{{ $booking->minimum_dp }}"
                                readonly>
                        </div>

                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <p><span class="text-danger">*</span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Quia dicta labore, assumenda numquam doloribus consequatur enim cumque.</p>
                        </div>
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-6">
                                <button type="button" class="btn-bayarSekarang" data-bs-dismiss="modal">Bayar
                                    Sekarang</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn-bayarNanti" data-bs-dismiss="modal"><a
                                        href="../page/statusPemesanan.html">Bayar Nanti</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <section id="pemesananDiproses">
        <div class="container mt-5">
            <!-- CARD -->
            <div class="card-form card mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <img src="img/image-bus1.png" height="100%" width="100%" alt="Bus Image">
                    </div>
                    <!-- FORM -->
                    <div class="col-md-6">
                        <form action="{{ route('booking.uploadProof', $booking->id) }}" method="POST"
                            enctype="multipart/form-data" id="formUploadDP">
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
                                        <span class="card-icon me-2" style="padding-left: 10px;"><i
                                                class="fa-solid fa-calendar"></i></span>
                                        <span style=" margin-left: 10px;"><b>Pesanan diproses </b><br><small>Admin sedang
                                                memproses pesanan anda, silakan cek status pemesanan secara
                                                berkala.</small></span>
                                    </div>
                                @elseif ($booking->id_ms_booking == 2)
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
                                                Rp {{ $booking->payment_received === null ? $booking->payment_received : $booking->minimum_dp }} untuk menyelesaikan DP
                                            @elseif ($booking->id_ms_payment == 3)
                                                Rp {{ $booking->payment_remaining }} untuk menyelesaikan pelunasan
                                            @endif
                                        </span>
                                        <!-- nominal -->
                                    </div>
                                @elseif ($booking->id_ms_booking == 3)
                                    <div class="status-alert-ditolak d-flex align-items-center">
                                        <span class="card-icon me-2" style="padding-left: 10px;"><i
                                                class="fa-solid fa-triangle-exclamation"></i></span>
                                        <span style=" margin-left: 10px;"><b>Pesanan ditolak admin</b><br><small>Admin
                                                menolak pesanan anda, pastikan data yang dimasukan benar.</small></span>
                                    </div>
                                @endif

                                {{-- <div class="d-flex align-items-center mb-3">
                                    <img src="img/image1.png" class="rounded-image me-2" alt="Bus Image" height="70px" width="106px" style="border-radius: 4px;">
                                    <div>
                                        <strong>{{ $booking->bus->name }}</strong>
                                    </div>
                                </div> --}}

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
                                    <label for="noTelp" class="form-label">Nomor Telephone</label>
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
                                @if ($booking->id_ms_booking == 1 || $booking->id_ms_booking == 3 || $booking->id_ms_booking == 4)
                                    <div class="mb-3">
                                        <div
                                            class="input-group mt-5 d-flex align-items-center justify-content-center flex-column text-left mb-5">
                                            <button type="submit" class="btn-hubungi">Hubungi Admin</button>
                                        </div>
                                    </div>
                                @elseif ($booking->id_ms_booking == 2)
                                    @if ($booking->id_ms_payment == 2)
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Unggah Bukti DP<span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="formFile"
                                                    name="proof_of_payment" required>
                                            </div>
                                            <small class="text-danger" id="error-file"
                                                style="display: none;padding-top: 10px;">Unggah foto bukti DP.</small>
                                        </div>
                                        <div class="mb-3">
                                            <div
                                                class="input-group mt-5 d-flex align-items-center justify-content-center flex-column text-left mb-5">
                                                <button type="submit" class="btn-kirimdp">Kirim</button>
                                            </div>
                                        </div>
                                    @elseif ($booking->id_ms_payment == 3)
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Unggah Bukti Pelunasan<span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="formFile"
                                                    name="proof_of_payment" required>
                                            </div>
                                            <small class="text-danger" id="error-file"
                                                style="display: none;padding-top: 10px;">Unggah foto bukti
                                                Pelunasan.</small>
                                        </div>
                                        <div class="mb-3">
                                            <div
                                                class="input-group mt-5 d-flex align-items-center justify-content-center flex-column text-left mb-5">
                                                <button type="submit" class="btn-kirimdp">Kirim</button>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </form>
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
