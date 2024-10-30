<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DP Dibayarkan - PMJ Trans</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f7f9;
            color: #51545e;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 650px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #1E9781;
        }

        .email-header {
            text-align: center;
            padding: 20px 0;
            background: linear-gradient(to right, #1E9781, #27b19b);
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .email-header h2 {
            font-size: 24px;
            margin: 0;
            font-weight: 600;
        }

        .email-body {
            margin-top: 20px;
        }

        .email-body h1 {
            font-size: 22px;
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .email-body p {
            font-size: 16px;
            color: #6F6C90;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .ticket-info,
        .invoice-info {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .ticket-info h3,
        .invoice-info h3 {
            font-size: 20px;
            color: #1E9781;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #1E9781;
            padding-bottom: 10px;
        }

        .ticket-info p,
        .invoice-info p {
            font-size: 16px;
            margin: 10px 0;
            color: #51545e;
        }

        .invoice-info {
            background-color: #fff6e5;
            border: 2px solid #f5c13d;
            box-shadow: 0px 4px 10px rgba(245, 193, 61, 0.2);
        }

        .invoice-info h3 {
            color: #d99b00;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #1E9781;
            color: white !important;
            text-decoration: none;
            font-size: 18px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #138f6f;
        }

        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #999;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }

        .email-footer p {
            margin: 5px 0;
        }

        @media screen and (max-width: 600px) {
            .email-container {
                width: 95%;
                padding: 15px;
            }

            .email-header h2 {
                font-size: 20px;
            }

            .email-body h1 {
                font-size: 20px;
            }

            .btn {
                padding: 12px 20px;
                font-size: 16px;
            }

            .ticket-info,
            .invoice-info {
                padding: 15px;
            }

            .ticket-info h3,
            .invoice-info h3 {
                font-size: 18px;
            }

            .email-footer {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="email-header">
            <h2>Invoice PMJ Trans</h2>
        </div>

        <div class="email-body">
            <h1>Terima kasih telah memilih PMJ Trans!</h1>
            <p>Pembayaran DP diterima!</p>
            <p>Silahkan membayar pelunasan sebesar <strong>Rp. {{ number_format($booking->payment_remaining, 0, ',', '.') }}</strong> untuk melanjutkan pemesanan</p>
            <p>Berikut ini adalah detail invoice pesanan Anda:</p>

            <div class="ticket-info">
                <h3>Detail Tiket</h3>
                <p><strong>Nama Pemesan:</strong> {{ $booking->customer->name ?? 'John Doe' }}</p>
                <p><strong>Kode Booking:</strong> {{ $booking->booking_code ?? 'PMJ-TC1U5787' }}</p>
                <p><strong>Tanggal Berangkat:</strong>
                    {{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}</p>
                <p><strong>Titik Jemput:</strong> {{ $booking->pickup_point ?? 'Tidak tersedia' }}</p>
                <p><strong>Tujuan:</strong></p>
                @if($booking->destination->isNotEmpty())
                    @foreach ($booking->destination as $destination)
                        <p>{{ $loop->iteration }}. {{ $destination->name }}</p>
                    @endforeach
                @else
                    <p>Tidak tersedia</p>
                @endif
            </div>

            <div class="invoice-info">
                <h3>Detail Pembayaran</h3>
                <p><strong>Nominal Perjalanan:</strong> Rp {{ number_format($booking->trip_nominal, 0, ',', '.') }}</p>
                <p><strong>Minimum DP yang harus dibayarkan:</strong> Rp {{ number_format($booking->minimum_dp, 0, ',', '.') }}</p>
                <p><strong>Total pembayaran yang diterima:</strong> Rp {{ number_format($booking->payment_received, 0, ',', '.') }}</p>
                <p><strong>Total sisa harus dibayarkan:</strong> Rp {{ number_format($booking->payment_remaining, 0, ',', '.') }}</p>
            </div>

            <a href="{{ route('booking.code', $booking->booking_code) }}" class="btn">Lihat Tiket Anda</a>
        </div>

        <div class="email-footer">
            <p>&copy; {{ date('Y') }} PMJ Trans</p>
            <p>{{ $setting->first()->address }}</p>
            <div class="social-links">
                <a href="{{ $setting->first()->sosmed_ig }}">Instagram</a> |
                <a href="{{ $setting->first()->sosmed_fb }}">Facebook</a> |
                <a href="{{ $setting->first()->sosmed_yt }}">Youtube</a>
            </div>
        </div>
    </div>

</body>

</html>