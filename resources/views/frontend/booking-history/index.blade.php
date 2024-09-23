@extends('frontend.layouts.app')
@push('styles')
    <title>Order History</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/riwayatSewaCustomer-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <section id="riwayatSewa">
        <div class="container mt-5">
            <div class="mb-3">
                <h3>Riwayat Sewa</h3>
            </div>
            <div class="tabel-riwayat justify-content-between align-items-center">
                <div class="row">
                    <div class="col-md-8" style="padding: 0px 30px;">
                        <p class="title">Detail Riwayat Sewa</p>
                    </div>
                    <div class="col-md-4" style="padding: 0px 30px;">
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar"></i></span>
                                    <input type="date" class="form-control" placeholder="Select Date" aria-describedby="basic-addon1">
                                </div> 
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sliders"></i></span>
                                    <input type="text" class="form-control" placeholder="Filters" aria-describedby="basic-addon1">
                                </div> 
                            </div>
                        </div>
                    </div>                                    
                </div>
                <div style="overflow-x: auto;">
                    <table class="table-sewa table table-responsive align-items-center">
                        <thead>
                          <tr>
                            <th scope="col" style="background-color: #A8A8A840;">ID Booking</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Titik Jemput</th>
                            <th scope="col">Jenis Armada</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>B0001</td>
                            <td>Nida Aulia Karima</td>
                            <td>Semarang</td>
                            <td>Jl. Nakula Raya, No. 20, Pendrikan Kidul, Seamrang, Jawa Tengah</td>
                            <td>PMJ Express</td>
                            <td>30 Agustus 2024</td>
                            <td><p class=status>Diproses</p></td>
                            <td><button type="button" class="btn-ulasan">Beri Ulasan</button></td>
                          </tr>
                          <tr>
                            <td>B0001</td>
                            <td>Nida Aulia Karima</td>
                            <td>Semarang</td>
                            <td>Jl. Nakula Raya, No. 20, Pendrikan Kidul, Seamrang, Jawa Tengah</td>
                            <td>PMJ Express</td>
                            <td>30 Agustus 2024</td>
                            <td><p class="status">Diproses</p></td>
                            <td><button type="button" class="btn-ulasan">Beri Ulasan</button></td>
                          </tr>
                        </tbody>
                    </table>
    
                </div>
        
                <div class="card-footer d-flex justify-content-between align-items-start" style="padding: 0px 20px;">
                    <span>
                        <p class="caption">Showing 1-5 from 1,269</p>
                    </span>
                    <nav >
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                            <li class="page-item "><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection