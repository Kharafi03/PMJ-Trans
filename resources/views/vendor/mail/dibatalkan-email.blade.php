<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembatalan Pemesanan PMJ Trans</title>
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
            border-top: 5px solid #e53935;
        }

        .email-header {
            text-align: center;
            padding: 20px 0;
            background: linear-gradient(to right, #e53935, #f44336);
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
            color: #e53935;
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
            color: #e53935;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #e53935;
            padding-bottom: 10px;
        }

        .ticket-info p,
        .invoice-info p {
            font-size: 16px;
            margin: 10px 0;
            color: #51545e;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #e53935;
            color: white !important;
            text-decoration: none;
            font-size: 18px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #c62828;
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
            <h2>Pemesanan Dibatalkan - PMJ Trans</h2>
        </div>

        <div class="email-body">
            <h1>Pemesanan Anda Telah Dibatalkan</h1>
            <p>Kami informasikan bahwa pemesanan Anda dengan kode
                <strong>{{ $booking->booking_code ?? '#' }}</strong> telah dibatalkan.</p>
            <p>Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi kami.</p>

            <div class="ticket-info">
                <h3>Detail Pemesanan</h3>
                <p><strong>Nama Pemesan:</strong> {{ $booking->customer->name ?? 'John Doe' }}</p>
                <p><strong>Kode Booking:</strong> {{ $booking->booking_code ?? 'PMJ-TC1U5787' }}</p>
                <p><strong>Tanggal Berangkat:</strong>
                    {{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}</p>
                <p><strong>Titik Jemput:</strong> {{ $booking->pickup_point ?? 'Tidak tersedia' }}</p>
                <p><strong>Tujuan:</strong></p>
                @if ($booking->destination->isNotEmpty())
                    @foreach ($booking->destination as $destination)
                        <p>{{ $loop->iteration }}. {{ $destination->name }}</p>
                    @endforeach
                @else
                    <p>Tidak tersedia</p>
                @endif
            </div>

            <a href="https://api.whatsapp.com/send?phone={{ $setting ? $setting->first()->contact : '#' }}&text=Halo,%20saya%20ingin%20bertanya" class="btn">Hubungi Admin</a>
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
