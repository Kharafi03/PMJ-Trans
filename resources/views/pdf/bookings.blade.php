<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #555;
        }
    </style>
</head>

<body>
    <h1>Data Booking PMJ Trans</h1>
    <table>
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Nama Customer</th>
                <th>Titik Jemput</th>
                <th>Tujuan</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->booking_code }}</td>
                    <td>{{ $booking->customer->name }}</td>
                    <td>{{ $booking->pickup_point }}</td>
                    <td>{{ $booking->destination_point }}</td>
                    <td>{{ $booking->ms_payment->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
