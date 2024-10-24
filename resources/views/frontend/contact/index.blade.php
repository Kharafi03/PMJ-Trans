@extends('frontend.layouts.app')
@push('styles')
    <title>Contact</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/hubungiKami-style.css') }}" rel="stylesheet" />

@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="mb-4" style="font-size: 44px; font-weight: 700; color: #1E9781;">Kontak <span style="color: #FD9C07;">Kami</span></h1>
                    <p class="mb-4" style="font-size: 16px; font-weight: 500; color: #666666B5;">Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak yang tersedia di halaman Kontak Kami.</p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="img/contact-img.png" style="width: 100%; height: 100%; align-items:center; padding: 30px;" alt="gambar">
                    <!-- src="{{ asset('frontend/img/carousel/carousel-2.jpg') }}" -->
                </div>
            </div>
        </div>

    <!-- CONTACT -->
    <section id="contact">
        <div class="container">
            <!-- TITLE -->
            <!-- <div class="contact-title">
                <h3>Hubungi Kami</h3>
                <p>Mempunyai Pertanyaan terkait Trans PMJ? Tim kami siap membantu anda.</p>
            </div> -->
            <!-- ICON CARD -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-5 mt-3">
                <div class="col">
                    <div class="contact-card card h-100 text-center d-flex justify-content-center align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="card-body flex-column align-items-end">
                            <h5 class="card-title">Nomor WhatsApp</h5>
                            <p class="card-text">0812-2562-5255</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="contact-card card h-100 text-center d-flex justify-content-center align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">buspmjtrans@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="contact-card card h-100 text-center d-flex justify-content-center align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Lokasi</h5>
                            <p class="card-text">Jl. Lingkar Timur, Ngembal Rejo, Kecamatan Jati, Kabupaten Kudus</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="contact-card card h-100 text-center d-flex justify-content-center align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Jam Buka</h5>
                            <p class="card-text">Setiap hari jam 07.00 - 17.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FORM -->
    <section id="contact-form">
        
        <div class="container mb-5">
            @include('frontend.assets.alert')
            <div class="row mt-5">
                <div class="col-md-6 mb-3">
                    <form id="formHubungiKami" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-header">
                            <p>Kontak Kami</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="namaLengkap" class="form-label">Nama Lengkap<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="namaLengkap" name="namaLengkap"
                                    placeholder="Masukkan nama lengkap" required>
                                <small class="text-danger" id="error-nama" style="display: none;">Lengkapi data nama lengkap
                                    anda.</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="kategori" class="form-label">Kategori<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option selected>Pilih Kategori</option>
                                    <option value="Pertanyaan">Pertanyaan</option>
                                    <option value="Komplain">Komplain</option>
                                </select>
                                <small class="text-danger" id="error-kategori" style="display: none;">Pilih kategori yang
                                    anda inginkan.</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="noTelp" class="form-label">Nomor WhatsApp<span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="noTelp" name="noTelp"
                                    placeholder="Masukkan nomor whatsapp" required>
                                <small class="text-danger" id="error-notelp" style="display: none;">Lengkapi data nomor
                                    telepon anda.</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan alamat email" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-3">
                                <label for="pesan" class="form-label">Pesan<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="pesan" rows="3" placeholder="Tuliskan Pesan yang ingin disampaikan..." required name="pesan"></textarea>
                                <small class="text-danger" id="error-pesan" style="display: none;">Lengkapi pesan yang ingin
                                    anda kirim.</small>
                            </div>
                            <div class="mt-3">
                                <p class="text-danger">*Wajib Diisi.</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn-kirim" onclick="submitHubungiKami()">KIRIM PESAN</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 d-flex justify-content-end mb-3">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12978.348270618128!2d110.8778704!3d-6.8190866!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70c5cdd4042793%3A0x22dfa84ed6ce52de!2sGarasi%20Bus%20PMJ%20Trans!5e1!3m2!1sid!2sid!4v1724347397670!5m2!1sid!2sid"
                        width="450" height="530" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

    <!-- SCRIPT -->
    <script>
        //SCRIPT ALERT
        function submitHubungiKami() {
            // Ambil nilai dari setiap field
            var namaLengkap = document.getElementById('namaLengkap').value;
            var kategori = document.getElementById('kategori').value;
            var noTelp = document.getElementById('noTelp').value;
            var pesan = document.getElementById('pesan').value;

            // Flag validasi
            var isValid = true;

            // Reset error messages
            document.getElementById('error-nama').style.display = 'none';
            document.getElementById('error-kategori').style.display = 'none';
            document.getElementById('error-notelp').style.display = 'none';
            document.getElementById('error-pesan').style.display = 'none';

            if (namaLengkap === "") {
                document.getElementById('error-nama').style.display = 'block';
                isValid = false;
            }
            if (kategori === "Pilih Kategori") {
                document.getElementById('error-kategori').style.display = 'block';
                isValid = false;
            }
            if (noTelp === "") {
                document.getElementById('error-notelp').style.display = 'block';
                isValid = false;
            }
            if (pesan === "") {
                document.getElementById('error-pesan').style.display = 'block';
                isValid = false;
            }
        }
    </script>
@endsection
