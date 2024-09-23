@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Accepted</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesananDiterima-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

     <!-- Modal -->
     <div class="modal fade" id="modalPemesananDiterima" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><img src="img/close.png"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img class="img-fluid" src="img/accepted-img.png">
                    </div>
                    <h5>Pemesanan Anda Diterima.</h5>
                    <form>
                        <div class="mb-3">
                            <label for="kodeBooking" class="form-label">Kode Booking</label>
                            <input type="text" class="form-control" id="kodeBooking" placeholder="PMJOKE123" value="" readonly >                                
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal Pembayaran</label>
                            <input type="text" class="form-control" id="nominal" placeholder="Rp 5.000.000,00" value="" readonly >                                
                        </div>
                        <div class="mb-3">
                            <label for="minDp" class="form-label">Minimum DP</label>
                            <input type="text" class="form-control" id="minDp" placeholder="Rp 2.5000.000,00" value="" readonly >                                
                        </div>

                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <p><span class="text-danger">*</span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia dicta labore, assumenda numquam doloribus consequatur enim cumque.</p>
                        </div>
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-6">
                                <button type="button" class="btn-bayarSekarang" data-bs-dismiss="modal">Bayar Sekarang</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn-bayarNanti" data-bs-dismiss="modal"><a href="../page/statusPemesanan.html">Bayar Nanti</a></button>
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT -->
    <section id="pemesananDiterima">
        <div class="container mt-5">
            <!-- CARD -->
            <div class="card-form card mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <img src="img/image-bus1.png" height="100%" width="100%" alt="...">
                    </div>
                    <!-- FORM -->
                    <div class="col-md-6">
                        <form id="formPemesananDiterima">
                            <div class="pemesanan-diterima">
                                <div class="mb-3">
                                    <label for="kodeBooking" class="form-label">Kode Booking</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-ticket-simple"></i></span>
                                        <input type="text" id="kodeBooking" class="form-control" value=""
                                            placeholder="PMJ777777" readonly>
                                        <!-- tak kasih placeholder dulu buat isinya -->
                                    </div>
                                </div>
                                <div class="status-alert d-flex align-items-center">
                                    <span class="card-icon me-2" style="padding-left: 10px;"><i class="fa-solid fa-calendar"
                                            style="color: white;"></i></span>
                                    <span style=" margin-left: 10px;"><b>Pesanan diterima admin</b><br><small>Admin telah
                                            menerima pesanan anda, silahkan lanjutkan ke upload bukti DP
                                            Pemesanan.</small></span>
                                </div>
                                <div class="rekening d-flex align-items-center">
                                    <span class="card-icon me-2" style="padding-left: 10px;"><i
                                            class="fa-solid fa-building-columns" style="color: white;"></i></span>
                                    <span style=" margin-left: 10px;"><b>Kirim Nomor Rekening</b><br><small>9876543212345 sejumlah Rp 50.000.000,-</small></span> 
                                            <!-- nominal -->
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="../asset/img/image1.png" class="rounded-image me-2" alt="Bus Image"
                                        height="70px" width="106px" style="border-radius: 4px;">
                                    <div>
                                        <strong>BUS PMJ Trans 01</strong>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-user"></i></span>
                                        <input type="text" id="namaLengkap" class="form-control"
                                            placeholder="Nida Aulia Karima" value="" aria-label="Username"
                                            aria-describedby="icon" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-envelope"></i></span>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="nida@gmail.com" value="" aria-label="Username"
                                            aria-describedby="icon" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="noTelp" class="form-label">Nomor Telephone</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-phone"></i></span>
                                        <input type="text" id="noTelp" class="form-control"
                                            placeholder="0897654321234" value="" aria-label="Username"
                                            aria-describedby="icon" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" id="alamat"
                                            placeholder="Jl. Nakula Raya, No.20, Pendrikan Kidul, Semarang Tengah, semarang, Jawa Tengah" value=""></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Unggah Bukti DP<span
                                            class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="formFile" hidden required>
                                        <label class="custom-file-label" for="formFile">
                                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                            <span id="fileName" class="file-name" style="padding-left: 10px;">Tidak ada
                                                file.</span>
                                        </label>
                                    </div>
                                    <small class="text-danger" id="error-file"
                                        style="display: none;padding-top: 10px;">Unggah foto bukti DP.</small>
                                </div>
                                <!-- BUTTON -->
                                <div class="mb-3">
                                    <div
                                        class="input-group mt-5 d-flex align-items-center justify-content-center flex-column text-left mb-5">
                                        <button type="submit" class="btn-kirimdp" onclick="kirimDP()">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

    <script>
        document.getElementById('formFile').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('fileName').textContent = fileName;
        });

        //SCRIPT ALERT
        function kirimDP() {
            // Ambil DP
            var formFile = document.getElementById('formFile').value;

            // Flag validasi
            var isValid = true;

            // Reset error messages
            document.getElementById('error-file').style.display = 'none';

            if (formFile === "") {
                document.getElementById('error-file').style.display = 'block';
                isValid = false;
            }

            if (isValid) {
                swal({
                    title: "Berhasil!",
                    text: "Bukti berhasil dikirim.",
                    icon: "success",
                    button: true
                }).then(() => {
                    document.getElementById('formPemesananDiterima').reset(); // Reset form
                });
            } else {
                swal({
                    title: "Error!",
                    text: "Silahkan unggah bukti pembayaran DP.",
                    icon: "error",
                    button: true
                });
            }
        }

        //SCRIPT MODAL

        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('modalPemesananDiterima'));
            myModal.show();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
