@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Status</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/statusPemesanan-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- NAVBAR -->
    <!-- CONTENT -->
    <section id="statusPemesanan">
        <div class="container mt-5">
            <!-- CARD -->
            <div class="card-form card mb-3">
                <div class="row">
                    <!-- IMAGE -->
                    <div class="col-md-6">
                        <img src="img/image-bus1.png" height="100%" width="100%" alt="...">
                    </div>
                    <!-- FORM -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <form id="formStatusPemesanan">
                                <div class="form-header text-center mb-5">
                                    <h3>Cek Status Pemesanan</h3>
                                    <p>Cek status pemesanan dengan mengisikan kode booking dan no hp yang digunakan saat
                                        menyewa bus</p>
                                </div>
                                <div class="kolom-input d-flex align-items-center justify-content-center flex-column text-left mb-5"
                                    style="height: 100%;">
                                    <div class="mb-3">
                                        <label for="kodeBooking" class="form-label">Kode Booking<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="icon"><i
                                                    class="fa-solid fa-ticket-simple"></i></span>
                                            <input type="text" id="kodeBooking" class="form-control"
                                                placeholder="Masukkan kode booking" required autofocus>
                                        </div>
                                        <small class="text-danger" id="error-kode" style="display: none;">Masukkan kode
                                            booking yang telah diterima.</small> <!-- tak tambahin dulu jaga2 -->
                                    </div>
                                    <div class="mb-3">
                                        <label for="noTelp" class="form-label">No Telp<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="icon"><i
                                                    class="fa-solid fa-phone"></i></span>
                                            <input type="text" id="noTelp" class="form-control"
                                                placeholder="Masukkan nomor telephone aktif" required>
                                        </div>
                                        <small class="text-danger" id="error-notelp" style="display: none;">Masukkan nomor
                                            telephone aktif anda.</small>
                                    </div>
                                    <!-- BUTTON -->
                                    <div>
                                        <div class="input-group mt-5">
                                            <div class="form-footer text-center">
                                                <p>Pastikan data yang dimasukan sudah benar</p>
                                                <button type="button" class="btn-cek" onclick="cekStatus()">Cek</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NAVBAR -->

    <!-- SCRIPT -->
    <script>
        //jaga2 tak isi dulu, scriptnya juga belum tau bener/ngga
        function cekStatus() {
            // Verifikasi Login
            var isLoggedIn = false;

            if (!isLoggedIn) {
                swal({
                    title: "Belum Login!",
                    text: "Untuk mengecek pemesanan, silahkan login terlebih dahulu",
                    icon: "warning",
                    buttons: {
                        login: {
                            text: "Login",
                            value: "login"
                        }
                    }
                }).then((value) => {
                    if (value === "login") {
                        window.location.href = "login.html"; // Ganti dengan URL halaman login Anda
                    }
                });
                return;
            }

            // Ambil data
            var kodeBooking = document.getElementById('kodeBooking').value;
            var noTelp = document.getElementById('noTelp').value;

            // Flag validasi
            var isValid = true;

            // Reset error messages
            document.getElementById('error-kode').style.display = 'none';
            document.getElementById('error-notelp').style.display = 'none';

            if (kodeBooking === "") {
                document.getElementById('error-kode').style.display = 'block';
                isValid = false;
            }
            if (noTelp === "") {
                document.getElementById('error-notelp').style.display = 'block';
                isValid = false;
            }

            if (isValid) {
                swal({
                    title: "Berhasil!",
                    text: "Pesan berhasil dikirim",
                    icon: "success",
                    button: true
                }).then(() => {
                    document.getElementById('formHubungiKami').reset(); // Reset form
                    // window.location.href = "kodeBooking.html";
                });

            } else {
                swal({
                    title: "Error!",
                    text: "Semua data harus diisi.",
                    icon: "error",
                    button: true
                });
            }
        }
    </script>

    <!-- FOOTER -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
