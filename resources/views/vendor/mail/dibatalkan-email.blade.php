<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembatalan Pemesanan PMJ Trans</title>
    <style>
        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
        }
        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins-Medium.woff2') format('woff2');
            font-weight: 500;
            font-style: normal;
        }
        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins-SemiBold.woff2') format('woff2');
            font-weight: 600;
            font-style: normal;
        }
        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins-Bold.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('/fonts/PlusJakartaSans-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('/fonts/PlusJakartaSans-Medium.woff2') format('woff2');
            font-weight: 500;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('/fonts/PlusJakartaSans-SemiBold.woff2') format('woff2');
            font-weight: 600;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('/fonts/PlusJakartaSans-Bold.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f7f9;
            color: #51545e;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            width: 100%;
            box-sizing: border-box;
            
        }

        .email-container {
            max-width: 100%;
            box-sizing: border-box;
            width: 650px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #F44C28;
        }

        .email-header {
            text-align: center;
            background-color: #F44C28;
            color: white;
            border-radius: 8px 8px 0 0;
            display: flex;
            margin-bottom: 0 !important;
        }

        .email-header img{
            margin: 0;
            padding: 0;
        }
        .email-header h2 {
            font-size: 24px;
            margin: auto;
            font-weight: 600;
            padding: auto;
        }

        .email-body {
            margin-top: 0px;
            padding: 10px 20px 30px 20px;
            /* border: 2px solid #00000040; */
            border-top: none;
            border-bottom: none;
            margin-bottom: 0;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .info-pesanan{
            padding: 10px;
            background-color: #F44C28;
            border-radius: 5px;
            color: white;
            font-weight: 700;
            width: 50%;
            font-size: 15px;
            font-family: 'Poppins', sans-serif !important;
        }

        .email-body h1 {
            font-size: 18px;
            color: #313234;
            font-weight: 700;
            margin-bottom: 10px;
            padding-top: 0px;
        }

        strong{
            color: #F44C28;
        }

        .email-body p {
            font-size: 16px;
            /* color: #6F6C90; */
            /* line-height: 1.6; */
            margin-bottom: 20px;
        }

        table{
            border-radius: 5px;
            background-color: white;
            border-collapse: collapse;
            margin-bottom: 25px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        tr:nth-child(even) {
            background-color: #F9F9FC;
        }

        table td{
            padding: 15px;
            font-size: 14px;
            font-weight: 500;
        }

        .info-content{
            padding: 20px;
            background-color: #F44C283D;
            border: 1px solid #F44C28;
            border-radius: 5px;

        }
        .info-content h3{
            text-align: center;
            color: #F44C28;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .ticket-info {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .ticket-info h3 {
            font-size: 20px;
            color: #d9534f;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #d9534f;
            padding-bottom: 10px;
        }

        .ticket-info p {
            font-size: 16px;
            margin: 10px 0;
            color: #51545e;
        }

        .email-footer {
            text-align: center;
            font-size: 14px;
            color: black;
            margin-top: 0px;
            padding: 20px;
            background-color: #E4E4E4;
        }

        .email-footer p {
            margin: 5px 0;
        }

        .social-links {
            text-align: center;
            font-size: 14px;
            color: #999;
            margin-top: 3px;
            padding: 10px;
            background-color: #E4E4E4;
        }

        @media screen and (max-width: 600px) {
            .email-container {
                width: 100%;
                padding: 15px;
                margin: 0 auto;
                box-sizing: border-box;
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

            .ticket-info {
                padding: 15px;
            }

            .ticket-info h3 {
                font-size: 18px;
            }

            .email-footer {
                font-size: 12px;
            }
            .info-pesanan{
                font-size: 14px;
                width: 70%;
            }
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="email-header">
            <h2>Pemesanan Dibatalkan</h2>
            <img src="{{ asset('/img/template-email-img.png') }}">
        </div>

        <div class="email-body">
            <h1>Terimakasih telah memilih PMJ Trans! </h1>
            <p class="info-pesanan">Pemesanan Anda Dibatalkan!</p>
            <p style="font-family: 'Poppins', sans-serif;">Kami informasikan kepada Anda, bahwa pemesanan dengan kode booking 
                <strong>{{ $booking->booking_code ?? '#' }} telah dibatalkan!</strong></p>

            <p style="font-family: 'Poppins', sans-serif;">Berikut ini adalah detail pemesanan anda :</p>
            
                <!-- <h3>Detail Pemesanan</h3>
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
                @endif -->
            <div class="info-content">
                <h3>Detail Pemesanan</h3>
                <div class="ticket-info">
                    <table>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Nama Pemesan</td>
                            <td>:</td>
                            <td>{{ $booking->customer->name ?? 'John Doe' }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Kode Booking</td>
                            <td>:</td>
                            <td>{{ $booking->booking_code ?? 'PMJ-TC1U5787' }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Tanggal Berangkat</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Titik Jemput</td>
                            <td>:</td>
                            <td>{{ $booking->pickup_point ?? 'Tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>:</td>
                            <td>
                                @foreach ($destinations as $dest)
                                    @if ($loop->count > 1)
                                        {{ $loop->iteration }}. {{ $dest->name }}<br>
                                    @else
                                        <br>{{ $dest->name }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="email-footer">
            <p>&copy; {{ date('Y') }} PMJ Trans</p>
            <p>{{ $setting->first()->address }}</p>
        </div>
        <div class="social-links">
            <a href="{{ $setting->first()->sosmed_ig }}">Instagram</a> |
            <a href="{{ $setting->first()->sosmed_fb }}">Facebook</a> |
            <a href="{{ $setting->first()->sosmed_yt }}">Youtube</a>
        </div>
    </div>

</body>

</html>
