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
                        class="table table-bordered table-hover text-nowrap text-center align-middle w-100">
                        <thead class="align-middle text-center">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Booking</th>
                                <th scope="col">Status</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Titik Jemput</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col">DP</th>
                                <th scope="col">Pelunasan</th>
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
                                    <td style="text-align: left;">
                                        @foreach ($destination[$index] as $dest)
                                            {{ $loop->iteration }}. {{ $dest->name }}
                                            <br>
                                        @endforeach
                                        @php
                                            $totalDestinations = count($destination[$index]);
                                        @endphp
                                    </td>
                                    <td>{{ $booking->pickup_point }}</td>
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
                                        @if ($booking->incomes->where('id_m_income', 1)->isNotEmpty())
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dpModal{{ $booking->id }}">
                                                Detail
                                            </button>
                                    
                                            <!-- Modal DP -->
                                            <div class="modal fade" id="dpModal{{ $booking->id }}" tabindex="-1" aria-labelledby="dpModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="dpModalLabel">Detail DP - {{ $booking->booking_code }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @foreach ($booking->incomes->where('id_m_income', 1) as $income)
                                                                    <div class="col-md-6 {{ $loop->last && $loop->count % 2 != 0 ? 'mx-auto' : '' }}">
                                                                        @if ($loop->count === 1)
                                                                            <p>DP: Rp {{ number_format($income->nominal, 0, ',', '.') }}</p>
                                                                        @else
                                                                            <p>DP ke-{{ $loop->iteration }}: Rp {{ number_format($income->nominal, 0, ',', '.') }}</p>
                                                                        @endif
                                                                        <p>Status: {{ $income->ms_income->name }}</p>
                                                                        <img src="{{ asset('storage/' . $income->image_receipt) }}" alt="Bukti Pembayaran" class="img-fluid" style="width: 100%;">
                                                                        <hr>
                                                                    </div>
                                    
                                                                    @if ($loop->iteration % 2 == 0 && !$loop->last)
                                                                        </div><div class="row">
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <button type="button" class="btn btn-secondary" disabled>Tidak Ada DP</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($booking->incomes->where('id_m_income', 2)->isNotEmpty())
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pelunasanModal{{ $booking->id }}">
                                                Detail
                                            </button>
                                    
                                            <!-- Modal Pelunasan -->
                                            <div class="modal fade" id="pelunasanModal{{ $booking->id }}" tabindex="-1" aria-labelledby="pelunasanModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="pelunasanModalLabel">Detail Pelunasan - {{ $booking->booking_code }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @foreach ($booking->incomes->where('id_m_income', 2) as $income)
                                                                    <div class="col-md-6 {{ $loop->last && $loop->count % 2 != 0 ? 'mx-auto' : '' }}">
                                                                        @if ($loop->count === 1)
                                                                            <p>Pelunasan: Rp {{ number_format($income->nominal, 0, ',', '.') }}</p>
                                                                        @else
                                                                            <p>Pelunasan ke-{{ $loop->iteration }}: Rp {{ number_format($income->nominal, 0, ',', '.') }}</p>
                                                                        @endif
                                                                        <p>Status: {{ $income->ms_income->name }}</p>
                                                                        <img src="{{ asset('storage/' . $income->image_receipt) }}" alt="Bukti Pelunasan" class="img-fluid" style="width: 100%;">
                                                                        <hr>
                                                                    </div>
                                    
                                                                    @if ($loop->iteration % 2 == 0 && !$loop->last)
                                                                        </div><div class="row">
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <button type="button" class="btn btn-secondary" disabled>Tidak Ada Pelunasan</button>
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

    <!-- SCRIPT JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
