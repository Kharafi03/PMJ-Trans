@extends('frontend.layouts.app')
@push('styles')
    <title>Booking</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesanan-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- CONTENT -->
    <!-- TITLE -->
    <section id="pemesanan">
        <div class="container mt-5">
            <h5><b>PEMESANAN</b></h5>
            <p class="caption">Pilih jadwal, destinasi, serta tipe kendaraan yang sesuai dengan kebutuhan Anda. Rasakan
                pengalaman perjalanan yang nyaman bersama layanan PMJ Trans</p>
        </div>
    </section>

    <!-- FORM -->
    <section id="form">
        <div class="container">
            <form id="formPemesanan">
                <div class="row">
                    <div class="col-lg-6" style="padding: 40px;">
                        <div class="text-content">
                            <h5><b>Detail Pemesanan</b></h5>
                            <p class="caption">Silahkan isi formulir detail pemesanan di bawah ini untuk melakukan pemesanan
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="tujuan" class="form-label"><b>Tujuan</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="tujuan"
                                        placeholder="Masukkan tujuan perjalanan" required autofocus>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-location-dot"></i></span>
                                </div>
                                <small class="text-danger" id="error-tujuan" style="display: none;">Lengkapi data tujuan
                                    anda.</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="kapasitas" class="form-label"><b>Kapasitas Bus</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="detail-pemesanan form-control" id="kapasitas"
                                        placeholder="Masukkan kapasitas penumpang" required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-person"></i></i></span>
                                </div>
                                <small class="text-danger" id="error-kapasitas" style="display: none;">Lengkapi data
                                    kapasitas penumpang.</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tglMulai" class="form-label"><b>Tanggal Mulai</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="datetime-local" class="detail-pemesanan form-control" id="tglMulai" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-calendar"></i></span>
                                </div>
                                <small class="text-danger" id="error-tglmulai" style="display: none;">Lengkapi tanggal mulai
                                    perjalanan anda.</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tglSelesai" class="form-label"><b>Tanggal Selesai</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="date" class="detail-pemesanan form-control" id="tglSelesai" required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-calendar"></i>
                                    </span>
                                </div>
                                <small class="text-danger" id="error-tglselesai" style="display: none;">Lengkapi tanggal
                                    selesai perjalanan anda.</small>
                            </div>
                            <!-- <div class="col-md-6 mb-4">
                                <label for="waktuJemput" class="form-label"><b>Waktu Jemput</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="time" class="detail-pemesanan form-control" id="waktuJemput" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-clock"></i></span>
                                </div>
                                <small class="text-danger" id="error-waktujemput" style="display: none;">Lengkapi waktu
                                    penjemputan.</small>
                            </div> -->
                            <!-- <div class="col-md-6 mb-4">
                                <label for="jmlArmada" class="form-label"><b>Jumlah Bus</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="detail-pemesanan form-control" id="jmlArmada"
                                        placeholder="Masukkan jumlah armada" min="1" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-bus"></i></span>
                                </div>
                                <small class="text-danger" id="error-jmlarmada" style="display: none;">Lengkapi jumlah
                                    armada yang dibutuhkan.</small>
                            </div> -->
                            <div class="mb-4">
                                <label for="titikJemput" class="form-label"><b>Titik Jemput</b><span
                                        class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Masukkan alamat lengkap" id="titikJemput" style="height: 100px;" required></textarea>
                                </div>
                                <small class="text-danger" id="error-titikjemput" style="display: none;">Lengkapi alamat titik jemput anda.</small> 
                            </div>
                            <div>
                                <p class="text-danger" style="font-size:18px;">*Wajib Diisi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding: 40px;">
                        <div class="text-content">
                            <h5><b>Detail Kontak</b></h5>
                            <p class="caption">Silahkan lengkapi formulir detail kontak di bawah ini untuk melakukan
                                pemesanan</p>
                        </div>
                        <div class="row">
                            <div class="mb-4">
                                <label for="namaLengkap" class="form-label"><b>Nama Lengkap</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="namaLengkap"
                                        placeholder="Masukkan nama lengkap" required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-user"></i></i></span>
                                </div>
                                <small class="text-danger" id="error-nama" style="display: none;">Lengkapi data nama
                                    lengkap anda.</small>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label"><b>Email</b></label>
                                <div class="input-group">
                                    <input type="email" class="detail-pemesanan form-control" id="email"
                                        placeholder="Masukkan alamat email">
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-envelope"></i></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="noTelp" class="form-label"><b>Nomor Telephone</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="noTelp"
                                        placeholder="Masukkan nomor telepon aktif dan dapat dihubungi." required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-phone"></i></i></span>
                                </div>
                                <small class="text-danger" id="error-notelp" style="display: none;">Lengkapi data nomor
                                    telepon anda.</small>
                            </div>
                            <div class="mb-4">
                                <label for="alamat" class="form-label"><b>Alamat</b><span class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Alamat Lengkap" id="alamat" style="height: 100px" required></textarea>
                                </div>
                                <small class="text-danger" id="error-alamat" style="display: none;">Lengkapi data alamat anda.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container d-flex justify-content-end">
                <button type="button" onclick="submitPemesanan()">Kirim</button>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />


    <!-- SCRIPT -->
    <script>
        function submitPemesanan() {
            //Ambil nilai
            var tujuan = document.getElementById('tujuan').value;
            var kapasitas = document.getElementById('kapasitas').value;
            var tglMulai = document.getElementById('tglMulai').value;
            var tglSelesai = document.getElementById('tglSelesai').value;
            var jmlArmada = document.getElementById('jmlArmada').value;
            var titikJemput = document.getElementById('titikJemput').value;
            var namaLengkap = document.getElementById('namaLengkap').value;
            var noTelp = document.getElementById('noTelp').value;
            var alamat = document.getElementById('alamat').value;

            // Flag validasi
            var isValid = true;

            // Reset error messages
            document.getElementById('error-tujuan').style.display = 'none';
            document.getElementById('error-kapasitas').style.display = 'none';
            document.getElementById('error-tglmulai').style.display = 'none';
            document.getElementById('error-tglselesai').style.display = 'none';
            document.getElementById('error-jmlarmada').style.display = 'none';
            document.getElementById('error-titikjemput').style.display = 'none';
            document.getElementById('error-nama').style.display = 'none';
            document.getElementById('error-notelp').style.display = 'none';
            document.getElementById('error-alamat').style.display = 'none';

            //Validasi
            if (tujuan === "") {
                document.getElementById('error-tujuan').style.display = 'block';
                isValid = false;
            }
            if (kapasitas === "" || kapasitas <= 0) {
                document.getElementById('error-kapasitas').style.display = 'block';
                isValid = false;
            }
            if (tglMulai === "") {
                document.getElementById('error-tglmulai').style.display = 'block';
                isValid = false;
            }
            if (tglSelesai === "") {
                document.getElementById('error-tglselesai').style.display = 'block';
                isValid = false;
            }
            if (jmlArmada === "") {
                document.getElementById('error-jmlarmada').style.display = 'block';
                isValid = false;
            }
            if (titikJemput.trim() === "") {
                document.getElementById('error-titikjemput').style.display = 'block';
                isValid = false;
            }
            if (namaLengkap === "") {
                document.getElementById('error-nama').style.display = 'block';
                isValid = false;
            }
            if (noTelp === "") {
                document.getElementById('error-notelp').style.display = 'block';
                isValid = false;
            }
            if (alamat.trim() === "") {
                document.getElementById('error-alamat').style.display = 'block';
                isValid = false;
            }

            if (isValid) {
                swal({
                    title: "Berhasil!",
                    text: "Data Pengeluaran berhasil dikirim.",
                    icon: "success",
                    button: true
                }).then(() => {
                    document.getElementById('formPemesanan').reset(); // Reset form
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
