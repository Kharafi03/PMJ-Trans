@extends('frontend.layouts.app')
@push('styles')
    <title>Detail Trip</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/dashboardDetail-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <section id="dashboardDetail">
        <div class="dashboard-container container p-3">
            <x-header-driver/>

            <!-- TEXT CONTENT -->
            <div class="text-content">
                <p>Semangat.. Hari ini ada trip!</p>
            </div>

            <!-- TITLE -->
            <div class="title">
                <p>Booking yang akan datang</p>
            </div>       
            <!-- CARD -->
            <div class="detail">
                <div class="detail-sewa mb-5">
                    <div class="tabel-detail d-flex align-items-center">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <h5>PMJ 1</h5>
                                        <p>PMJ-7654435</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="keterangan">Tanggal</td>
                                    <td>
                                        <div class="tgl">
                                            21 september 2024
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="keterangan ">Customer</td>
                                    <td >Nida Aulia Karima</td>
                                </tr>
                                <tr>
                                    <td class="keterangan ">Nomor Telephone</td>
                                    <td >089876542232</td>
                                </tr>
                                <tr>
                                    <td class="keterangan ">Email</td>
                                    <td >nida@gmail.com</td>
                                </tr>
                                <tr>
                                    <td class="keterangan ">Titik Jemput</td>
                                    <td >Pekalongan</td>
                                </tr>
                                <tr>
                                    <td class="keterangan ">Tujuan</td>
                                    <td >Itali</td>
                                </tr>
                                <tr></tr>
                                    <td class="keterangan ">Kapasitas</td>
                                    <td >40</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- NAVBAR -->
            <x-navbar-driver/>
        </div>
    </section>
@endsection