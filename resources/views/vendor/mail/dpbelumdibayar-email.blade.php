<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Diterima - PMJ Trans</title>
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
            border-top: 5px solid #1E9781;
        }

        .email-header {
            text-align: center;
            background-color: #1E9781;
            color: white;
            border-radius: 8px 8px 0 0;
            display: flex;
            margin-bottom: 0 !important;
            padding: 40px 0px;
        }

        .email-header h2 {
            font-size: 24px;
            margin: auto;
            font-weight: 700;
            padding: auto;
            font-family: 'Poppins', sans-serif !important;
        }

        .email-body {
            margin-top: 0px;
            padding: 10px 20px 30px 20px;
            border-top: none;
            border-bottom: none;
            margin-bottom: 0;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .info-pesanan{
            padding: 10px;
            background-color: #4180CC;
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
            font-weight: 400;
            margin-bottom: 10px;
            padding-top: 0px;
            font-family: 'Poppins', sans-serif !important;
        }

        strong{
            color: #F44C28;
        }

        .email-body p {
            font-size: 16px;
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
            color: #667085 !important;
        }

        .info-content{
            padding: 20px;
            background-color: #1E978126;
            border: 1px solid #1E9781;
            border-radius: 5px;

        }
        .info-content h3{
            text-align: center;
            color: #1E9781;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 20px;
        }


        .pembayaran-info h3 {
            font-size: 20px;
            color: #d9534f;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #d9534f;
            padding-bottom: 10px;
        }

        .pembayaran-info p {
            font-size: 16px;
            margin: 10px 0;
            color: #51545e;
        }

        .ticket-info {
            background-color: #A8A8A81A;
            padding: 20px;
            border: 1px solid #A8A8A8;
            border-radius: 8px;
            margin-bottom: 25px;
            margin-top: 50px;
        }

        .ticket-info h5 {
            font-size: 24px;
            font-weight: 600;
            border-bottom: 2px solid #666666;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .ticket-info td p{
            font-size: 14px;
            color: #51545e;
            padding: 0;
            margin: 3px 0;
            margin-left: 10px;
        }

        .ticket-info strong {
            color: #333;
            font-size: 14px;
        }

        .instruksi{
            padding: 0px 20px;
            color: #666666 !important;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #1E9781;
            color: white !important;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 30px;
            transition: background-color 0.3s ease;
            box-shadow: #4475F236 0px 15px 25px, rgba(86, 167, 221, 0.397) 0px 5px 10px;
        }

        .info{
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .btn:hover {
            background-color: #00BB83;
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

         /* Media Query untuk Mobile */
         @media screen and (max-width: 480px) {
            .email-container {
                width: 100%;
                padding: 10px;
            }

            .email-header {
                font-size: 18px;
            }

            .info-pesanan {
                font-size: 12px;
            }

            .email-body h1 {
                font-size: 16px;
            }

            .btn {
                padding: 8px 15px;
                font-size: 14px;
            }

            table td {
                font-size: 12px;
                padding: 8px;
            }

            .info-content h3 {
                font-size: 16px;
            }

            .instruksi p {
                font-size: 12px;
            }
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

            .pembayaran-info {
                padding: 15px;
            }

            .pembayaran-info h3 {
                font-size: 18px;
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
            <h2>PEMESANAN DITERIMA</h2>
        </div>

        <div class="email-body">
            <h1>Halo, <b>Nida Aulia Karima</b></h1>
            <p class="info-pesanan">Pemesanan Anda diterima!</p>
            <p style="font-family: 'Poppins', sans-serif;color: #666666 !important;">Silahkan <strong>membayar minimum DP </strong>sebesar
            <strong>Rp. {{ number_format($booking->minimum_dp, 0, ',', '.') }}</strong> untuk melanjutkan pemesanan</p>

            <p style="font-family: 'Poppins', sans-serif; color: #666666 !important;">Berikut ini adalah detail pemesanan anda : </p>
            
            <div class="info-content">
                <h3>Detail Pembayaran</h3>
                <div class="pembayaran-info">
                    <center> 
                        <table>
                            <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                                <td>Nominal Pembayaran</td>
                                <td>:</td>
                                <td>Rp {{ number_format($booking->trip_nominal, 0, ',', '.') }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                                <td>Minimum DP yang harus dibayarkan</td>
                                <td>:</td>
                                <td>Rp {{ number_format($booking->minimum_dp, 0, ',', '.') }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                                <td>Total Pembayaran yang diterima</td>
                                <td>:</td>
                                <td>Rp {{ number_format($booking->payment_received, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Total sisa yang harus dibayarkan</td>
                                <td>:</td>
                                <td>Rp {{ number_format($booking->payment_remaining, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </center>
                </div>
                <div class="instruksi">
                    <p>Instruksi Pembayaran :</p>
                    <p style="margin-bottom: 5px;">1.&nbsp; Cek Status Pemesanan:</p>
                    <div style="margin-left:18px;margin-top: 0px;">
                        Silakan cek status pemesanan Anda terlebih dahulu dengan memasukkan Nomor WhatsApp dan Kode Booking.
                    </div>
                    
                    <p style="margin-bottom: 5px;">2.&nbsp; Upload Bukti Pembayaran:</p>
                    <div style="margin-left:18px; margin-top: 0px;">
                        Setelah status pemesanan Anda terverifikasi, Anda diarahkan untuk mengunggah bukti pembayaran. Klik tombol di bawah ini untuk melanjutkan.
                    </div>
                </div>
                <center>
                    <a href="https://api.whatsapp.com/send?phone={{ $setting ? $setting->first()->contact : '#' }}&text=Halo,%20saya%20ingin%20bertanya" class="btn">Cek Pemesanan</a>
                </center>
            </div>
            <div class="ticket-info">
                <h5 style="color: #1E9781;">Detail <span style="color: #FD9C07;">Tiket</span></h5>
                <center> 
                    <table>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Nama Pemesan</td>
                            <td> : </td>
                            <td><p>{{ $booking->customer->name ?? 'John Doe' }}</p></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Kode Booking</td>
                            <td> : </td>
                            <td><p>{{ $booking->booking_code ?? 'PMJ-TC1U5787' }}</p></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Tanggal Berangkat</td>
                            <td> : </td>
                            <td><p>{{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}</p></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #A8A8A8; color: #667085;">
                            <td>Titik Jemput</td>
                            <td> : </td>
                            <td><p>{{ $booking->pickup_point ?? 'Tidak tersedia' }}</p></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 5px;">Tujuan</td>
                            <td style="padding-top: 5px;"> : </td>
                            <td>
                                <p>
                                    @foreach ($destinations as $dest)
                                        @if ($loop->count > 1)
                                            {{ $loop->iteration }}. {{ $dest->name }}<br>
                                        @else
                                            <br>{{ $dest->name }}
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                        </tr>
                    </table>
                </center>     
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
