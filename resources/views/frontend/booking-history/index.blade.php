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
                </div>

                <div class="table-responsive">
                    <table id="data-table"
                        class="table table-bordered table-striped table-hover text-nowrap text-center align-middle w-100">
                        <thead class="align-middle text-center">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Booking</th>
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
                            @forelse ($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->booking_code }}</td>
                                    <td>{{ $booking->customer ? $booking->customer->name : 'Tidak Ditemukan' }}</td>
                                    <td style="text-align: left;">
                                        @foreach ($destination[$index] as $dest)
                                            {{ $loop->iteration }}. {{ $dest->name }}
                                            <br>
                                        @endforeach
                                        @php
                                            $totalDestinations = count($destination[$index]);
                                        @endphp
                                        {{ $totalDestinations + 1 }}. {{ $booking->destination_point }}
                                    </td>
                                    <td>{{ $booking->pickup_point }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}</td>
                                    <td>
                                        @if ($booking->date_end == null)
                                            Tidak Ditemukan
                                        @else
                                            {{ \Carbon\Carbon::parse($booking->date_end)->translatedFormat('l, d F Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $booking->ms_booking ? $booking->ms_booking->name : 'Tidak Ditemukan' }}
                                    </td>
                                    <td><button type="button" class="btn-ulasan">Beri Ulasan</button></td>
                                </tr>
                            @empty
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
