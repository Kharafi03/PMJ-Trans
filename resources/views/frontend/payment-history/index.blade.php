@extends('frontend.layouts.app')
@push('styles')
    <title>Payment History</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/riwayatPembayaranCustomer-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <section id="riwayatPembayaran">
        <div class="container mt-5 mb-5>">
            <div class="text-content mb-5">
                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Pembayaran
                        - </span><span style="color:black;">{{ $booking->booking_code }}</span></h5>
                <p style="font-size: 16px; font-weight: 500; color: #666666B5;">Berikut Detail Pembayaran selama menyewa bus
                    PMJ Trans.</p>
            </div>
            <div class="dp-content mb-5">
                <p class="dp-title">Detail <span style="color: #FD9C07;">DP</span></p>
                <div class="row g-3">
                    @foreach ($booking->incomes->where('id_m_income', 1) as $income)
                        <div class="col-lg-3 col-md-6 mb-4 riwayat-content">
                            <div class="content">
                                <div
                                    class="header text-center d-flex flex-column justify-content-center align-items-center">
                                    <p class="bayar-title">DP ke-{{ $loop->iteration }}</p>
                                    <h5>Rp {{ number_format($income->nominal, 0, ',', '.') }}</h5>
                                    <p class="status">Status: {{ $income->ms_income->name }}</p>
                                    <img src="{{ asset('storage/' . $income->image_receipt) }}" alt="Bukti Pembayaran" class="img-fluid" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="pelunasan-content mb-5">
                <p class="pelunasan-title">Detail <span style="color: #FD9C07;">Pelunasan</span></p>
                <div class="row g-3">
                    @foreach ($booking->incomes->where('id_m_income', 2) as $income)
                        <div class="col-lg-3 col-md-6 mb-4 riwayat-content">
                            <div class="content">
                                <div
                                    class="header text-center d-flex flex-column justify-content-center align-items-center">
                                    <p class="bayar-title">Pelunasan ke-{{ $loop->iteration }}</p>
                                    <h5>Rp {{ number_format($income->nominal, 0, ',', '.') }}</h5>
                                    <p class="status">Status: {{ $income->ms_income->name }}</p>
                                    <img src="{{ asset('storage/' . $income->image_receipt) }}" alt="Bukti Pembayaran" class="img-fluid" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />
@endsection
