@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Details</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/detailPemesanan-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- BOOKING DETAILS -->
    <section id="detail-sewa">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-sewa mb-5">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <h3>Detail Sewa</h3>
                            </div>
                        </div>
                        <div class="tabel-detail d-flex align-items-center" style="overflow-x: auto;">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="align-middle" style="padding-left: 20px; font-size: 18px;">Detail Sewa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="keterangan align-middle">Nama Lengkap</td>
                                        <td class="align-middle">Nida Aulia K</td>
                                    </tr>
                                    <tr>
                                        <td class="keterangan align-middle">Email</td>
                                        <td class="align-middle">nida@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td class="keterangan align-middle">Nomor Telephone</td>
                                        <td class="align-middle">089xxxx</td>
                                    </tr>
                                    <tr>
                                        <td class="keterangan align-middle">Alamat</td>
                                        <td class="align-middle">Jl. Nakula Raya, No.20, Pendrikan Kidul, Semarang</td>
                                    </tr>
                                    <tr>
                                        <td class="keterangan align-middle">Tujuan Akhir</td>
                                        <td class="align-middle">Pemalang</td>
                                    </tr>
                                    <tr>
                                        <td class="keterangan align-middle">Tanggal Mulai</td>
                                        <td class="align-middle">6 Agustus 2024</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ulasan">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <h3>Berikan Ulasan</h3>
                            </div>
                            <div class="form-ulasan">
                                <form>
                                    <div class="mb-3">
                                        <label for="ulasan" class="form-label">Berikan ulasan di bawah ini.</label>
                                        <textarea class="form-control" id="ulasan" rows="3" placeholder="Tulis di sini..."></textarea>
                                    </div>
                                    <div class="text-rating d-flex justify-content-between align-items-center mt-5">
                                        <div>
                                            <p>Memberi Rating</p>
                                        </div>
                                        <div id="rating-info" class="rating-info">
                                            <p>0/5</p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star" data-value="1"></span>
                                        <span class="fa fa-star" data-value="2"></span>
                                        <span class="fa fa-star" data-value="3"></span>
                                        <span class="fa fa-star" data-value="4"></span>
                                        <span class="fa fa-star" data-value="5"></span>
                                    </div>
                                    <button type="submit" class="btn-ulasan">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.rating .fa-star');
            const ratingInfo = document.getElementById('rating-info');

            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    const value = star.getAttribute('data-value');
                    stars.forEach(s => {
                        if (s.getAttribute('data-value') <= value) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                });

                star.addEventListener('mouseout', () => {
                    stars.forEach(s => {
                        if (s.classList.contains('selected')) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                });

                star.addEventListener('click', () => {
                    const value = star.getAttribute('data-value');
                    stars.forEach(s => {
                        if (s.getAttribute('data-value') <= value) {
                            s.classList.add('selected');
                        } else {
                            s.classList.remove('selected');
                        }
                    });
                    ratingInfo.textContent = `${value}/5`;
                });
            });
        });
    </script>
@endsection