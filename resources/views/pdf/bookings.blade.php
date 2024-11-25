<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f9f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .table-container {
            overflow-x: auto; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            min-width: 600px; 

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            word-wrap: break-word;
        }

        th {
            background-color: #4caf50;
            color: #ffffff;
            font-size: 1rem;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f1f8f1;
        }

        tr:hover {
            background-color: #e8f5e9;
            transition: background-color 0.3s ease;
        }

        td {
            color: #555;
            font-size: 0.95rem;
        }

        td:first-child {
            font-weight: bold;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            table {
                font-size: 0.9rem; 
                min-width: 500px; 
            }

            th,
            td {
                padding: 10px;
            }
        }

        /* Responsif untuk layar sangat kecil */
        @media (max-width: 480px) {
            table {
                font-size: 0.8rem;
                min-width: 400px; 
            }

            th,
            td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <h1>Data Booking PMJ Trans</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Booking</th>
                    <th>Nama Customer</th>
                    <th>Titik Jemput</th>
                    <th>Tujuan</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pemesanan</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bookings as $index => $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->booking_code }}</td>
                        <td>{{ $booking->customer->name }}</td>
                        <td>{{ $booking->pickup_point }}</td>
                        <td>
                        @foreach ($destinations[$index] as $destination)
                            <p>{{ $destination->name }}</p>
                        @endforeach
                        </td>
                        <td>{{ $booking->ms_payment->name }}</td>
                        <td>{{ $booking->ms_booking->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>