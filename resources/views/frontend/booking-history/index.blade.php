@extends('frontend.layouts.app')
@push('styles')
    <title>Order History</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/riwayatSewaCustomer-style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css">
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
            <div class="tabel-riwayat justify-content-between align-items-center p-3">
                <div class="row">
                    <div class="col-md-8" style="padding: 0px 30px;">
                        <p class="title">Detail Riwayat Sewa</p>
                    </div>
                    <div class="col-md-4" style="padding: 0px 30px;">
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-calendar"></i></span>
                                    <input type="date" class="form-control" placeholder="Select Date"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-sliders"></i></span>
                                    <input type="text" class="form-control" placeholder="Filters"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="data-table"
                        class="table table-bordered table-striped table-hover text-nowrap text-center align-middle w-100">
                        <thead class="align-middle text-center">
                            <tr>
                                <th scope="col" style="background-color: #A8A8A840;">No</th>
                                <th scope="col">ID Booking</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Titik Jemput</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping melalui data booking -->
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->booking_code }}</td>
                                    <td>{{ $booking->customer ? $booking->customer->name : 'Tidak Ditemukan' }}</td>
                                    <td>{{ $booking->destination_point }}</td>
                                    <td>{{ $booking->pickup_point }}</td>
                                    <td>{{ $booking->date_start->format('d F Y') }}</td>
                                    <td>{{ $booking->date_end->format('d F Y') }}</td>
                                    <td>
                                        <p class="status">
                                            {{ $booking->ms_booking ? $booking->ms_booking->name : 'Tidak Ditemukan' }}</p>
                                    </td>
                                    <td><button type="button" class="btn-ulasan">Beri Ulasan</button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada riwayat pemesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />
    @include('frontend.layouts.datatable')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
