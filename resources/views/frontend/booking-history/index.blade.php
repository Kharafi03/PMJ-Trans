@extends('frontend.layouts.app')
@push('styles')
    <title>Order History</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/riwayatSewaCustomer-style.css') }}" rel="stylesheet" />
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
                        class="table table-bordered table-hover text-nowrap text-center align-middle w-100">
                        <thead class="align-middle text-center">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Booking</th>
                                <th scope="col">Status</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Titik Jemput</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Jumlah Penumpang</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Minimum DP</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping melalui data booking -->
                            @forelse ($bookings as $index => $booking)
                                <tr>
                                    <td style="text-align: center;"><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $booking->booking_code }}</td>
                                    <td>
                                        <span
                                            class="px-2 py-1 rounded-full text-white 
                                            {{ $booking->ms_booking
                                                ? ($booking->ms_booking->id == 1
                                                    ? 'bg-warning'
                                                    : ($booking->ms_booking->id == 2
                                                        ? 'bg-success'
                                                        : ($booking->ms_booking->id == 3
                                                            ? 'bg-danger'
                                                            : ($booking->ms_booking->id == 4
                                                                ? 'bg-primary'
                                                                : ($booking->ms_booking->id == 5
                                                                    ? 'bg-danger'
                                                                    : 'bg-gray-500')))))
                                                : 'bg-gray-500' }}">
                                            {{ $booking->ms_booking ? $booking->ms_booking->name : 'Tidak Ditemukan' }}
                                        </span>
                                    </td>
                                    <td>{{ $booking->customer ? $booking->customer->name : 'Tidak Ditemukan' }}</td>
                                    <td>{{ $booking->pickup_point }}</td>
                                    <td style="text-align: {{ $destination[$index]->count() > 1 ? 'left' : 'center' }};">
                                        @foreach ($destination[$index] as $dest)
                                            @if ($loop->count > 1)
                                                {{ $loop->iteration }}. {{ $dest->name }}
                                            @else
                                                {{ $dest->name }}
                                            @endif
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $booking->capacity }} penumpang</td>
                                    <td>
                                        @if ($booking->trip_nominal != null)
                                            Rp {{ number_format($booking->trip_nominal, 0, ',', '.') }}
                                        @else
                                            Tidak Ditemukan
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if ($booking->minimum_dp != null)
                                            Rp {{ number_format($booking->minimum_dp, 0, ',', '.') }}
                                        @else
                                            Tidak Ditemukan
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>
                                        @if ($booking->date_end == null)
                                            Tidak Ditemukan
                                        @else
                                            {{ \Carbon\Carbon::parse($booking->date_end)->translatedFormat('l, d F Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($booking->incomes->isNotEmpty())
                                            <a href="{{ route('payment-history', $booking->id) }}"
                                                class="btn btn-primary">Detail</a>
                                        @else
                                            Tidak Ditemukan
                                        @endif
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
@endsection
