<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket PMJ Trans</title>

    <script src="{{ asset('js/fontawesome.js') }}"></script>

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
        }

        .email-container {
            max-width: 650px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 25px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #1E9781;
        }

        .email-header {
            text-align: center;
            padding: 20px 0;
            background-color: #1E9781;
            color: white;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0px 50px;
        }

        /* .email-header img {
            margin-bottom: 10px;
        } */

        .email-header h2 {
            font-size: 24px;
            margin: 0px 0px 0px 20px;
            font-weight: 600;
        }

        .email-body {
            margin: 20px 80px 50px 80px;
        }

        .email-body h1 {
            font-size: 22px;
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
            margin-top: 50px;
        }

        .email-body p {
            font-size: 16px;
            color: #6F6C90;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        table{
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            border-radius: 5px;
            background-color: white;
            border-collapse: collapse;
            margin-bottom: 25px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            margin: 0px 10px
        }
        tr:nth-child(even) {
            background-color: #F9F9FC;
        }

        table td{
            padding: 10px;
            font-size: 14px;
            font-weight: 500;
        }
        .ticket-info {
            background-color: #E4E4E454;
            padding: 20px;
            /* border: 1px solid #A8A8A8; */
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
            color: #667085;
            padding: 0;
            margin: 3px 0;
            margin-left: 10px;
        }

        .ticket-info strong {
            color: #333;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 15px 20px;
            background-color: #1E9781;
            color: white !important;
            text-decoration: none;
            font-size: 14px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            transition: background-color 0.3s ease;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
        }

        .btn:hover {
            background-color: #138f6f;
        }

        .email-footer {
            text-align: center;
            color: white;
            margin: 5px 50px;
            padding: 15px;
            /* border-top: 1px solid #e0e0e0; */
            background-color:#1E9781;
        }
        .email-footer h5{
            font-size: 18px;
            font-weight: 700;
            margin: 10px 0px;
        }
        .email-footer p {
            margin: 10px 30px;
            font-size: 15px;
            font-weight: 400;

        }
        .sosmed{
            margin: 20px 0px;
        }
        .sosmed a{
            text-decoration: none;
            color: white;
        }
        .sosmed i{
            border: none;
            border-radius: 50%;
            background-color: #FE9A07;
            margin: 0px 8px;
            font-size: 20px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
        }

        /* Media Queries for Responsive Design */
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

            .ticket-info {
                padding: 15px;
            }

            .ticket-info h3 {
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
        <!-- Header -->
        <div class="email-header">
            <!-- <img src="{{ asset('img/logo.png')}}" width="80px" height="40px" alt="logo"> -->
            <h2>E-Ticket PMJ-Trans</h2>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h1>Terima kasih telah memilih PMJ Trans!</h1>
            <p style="font-family: 'Poppins', sans-serif;">Kami sangat menghargai kepercayaan Anda. Berikut ini adalah detail tiket pesanan Anda:</p>

            <!-- Ticket Info -->
            <div class="ticket-info">
                <h5 style="color: #1E9781;">Detail <span style="color: #FD9C07;">Tiket</span></h5>
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
            </div>

            <a href="{{ route('booking.code', $booking->booking_code) }}" class="btn">Lihat Tiket Anda</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <!-- <h5>Temukan Kami</h5>
            <div class="sosmed">
                <a href="{{ $setting->first()->sosmed_fb }}"><i class="fa-brands fa-facebook-f" style="padding: 10px 13px;"></i></a>
                <a href="{{ $setting->first()->sosmed_ig }}"><i class="fa-brands fa-instagram" style="padding: 13px"></i></a>
                <a href="{{ $setting->first()->sosmed_yt }}"><i class="fa-brands fa-youtube" style="padding: 10px 8px;"></i></a>
            </div> -->
            <!-- <p>&copy; {{ date('Y') }} PMJ Trans</p> -->
            <p>{{ $setting->first()->address }}</p>
            <!-- <div class="social-links">
                <a href="{{ $setting->first()->sosmed_ig }}">Instagram</a> |
                <a href="{{ $setting->first()->sosmed_fb }}">Facebook</a> |
                <a href="{{ $setting->first()->sosmed_yt }}">Youtube</a>
            </div> -->
            <p style="font-size: 12px; padding-top: 10px;">0812-2562-5255</p>
        </div>
        <div class="email-footer">
            <h5>Terima Kasih</h5>
        </div>
    </div>

</body>
</html>