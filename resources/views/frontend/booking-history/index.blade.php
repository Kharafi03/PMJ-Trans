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
                                <th scope="col">Titik Jemput</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Jumlah Penumpang</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Minimum DP</th>
                                <th scope="col">Status Pembayaran</th>
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
                                            class="badge fs-6
                                            @if ($booking->ms_booking->id == 1) bg-warning
                                            @elseif ($booking->ms_booking->id == 2)
                                                bg-success
                                            @elseif ($booking->ms_booking->id == 3)
                                                bg-danger
                                            @elseif ($booking->ms_booking->id == 4)
                                                bg-primary
                                            @elseif ($booking->ms_booking->id == 5)
                                                bg-danger @endif">
                                            {{ $booking->ms_booking->name }}
                                        </span>
                                    </td>
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
                                    <td>{{ $booking->ms_payment->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center text-center">
                                            <a href="{{ route('history.show', ['booking_code' => $booking->booking_code]) }}"
                                                class="btn btn-primary me-2 text-center align-items-center">Detail</a>
                                            @if ($booking->ms_booking->id == 4)
                                                @if (!$booking->review)
                                                    <button class="btn btn-success text-center"
                                                        data-bs-toggle="modal" data-bs-target="#feedbackModal"
                                                        data-id-booking="{{ $booking->id }}">
                                                        Beri Ulasan
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary text-center" disabled>Anda sudah
                                                        memberikan feedback</button>
                                                @endif
                                            @endif
                                            <div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($bookings->count() > 0)
                <!-- Feedback Modal -->
                <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="feedbackModalLabel">Ulasan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('history.storeReview') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_booking" id="id_booking" value="{{ $booking->id }}">
                                    <div class="mb-3">
                                        <label for="feedback">Feedback</label>
                                        <span class="text-danger text-lg">*</span>
                                        <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rating">Rating</label>
                                        <span class="text-danger text-lg">*</span>
                                        <div class="rating-stars">
                                            <span class="star" data-rating="1"><i
                                                    class="fas fa-star text-secondary"></i></span>
                                            <span class="star" data-rating="2"><i
                                                    class="fas fa-star text-secondary"></i></span>
                                            <span class="star" data-rating="3"><i
                                                    class="fas fa-star text-secondary"></i></span>
                                            <span class="star" data-rating="4"><i
                                                    class="fas fa-star text-secondary"></i></span>
                                            <span class="star" data-rating="5"><i
                                                    class="fas fa-star text-secondary"></i></span>
                                        </div>
                                        <input type="hidden" name="rating" id="rating" value="0" required>
                                    </div>
                                    <p class="text-danger">* Wajib diisi</p>
                                    <button type="submit" class="btn btn-primary">Kirim Feedback</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />
    @include('frontend.layouts.datatable')
    @push('scripts')
        <script>
            var feedbackModal = document.getElementById('feedbackModal');
            feedbackModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id_booking = button.getAttribute('data-id-booking');

                var modalBookingCode = feedbackModal.querySelector('#id_booking');

                modalBookingCode.value = id_booking;
            });

            document.addEventListener("DOMContentLoaded", function() {
                const stars = document.querySelectorAll(".rating-stars .star");
                const ratingValue = document.getElementById("rating");

                stars.forEach((star) => {
                    star.addEventListener("click", function() {
                        const rating = parseInt(star.getAttribute("data-rating"));
                        ratingValue.value = rating;

                        stars.forEach((s) => {
                            s.querySelector("i").classList.remove("text-warning");
                            s.querySelector("i").classList.add("text-secondary");
                        });

                        for (let i = 0; i < rating; i++) {
                            stars[i].querySelector("i").classList.add("text-warning");
                            stars[i].querySelector("i").classList.remove("text-secondary");
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
