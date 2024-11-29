<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;

class BookingsExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    public function query()
    {
        return Booking::with(['customer', 'ms_payment', 'ms_booking', 'destination']);
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Nama Pelanggan',
            'Tujuan',
            'Kapasitas',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Titik Jemput',
            'Jumlah Bus',
            'Legrest',
            'Deskripsi',
            'Total Biaya Trip',
            'DP Minimum',
            'Pembayaran Diterima',
            'Sisa Pembayaran',
            'Total Pengeluaran',
            'Keuntungan',
            'Metode Pembayaran',
            'Status Booking',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->booking_code,
            optional($booking->customer)->name,
            $booking->destination->pluck('name')->implode(', '), // Gabungkan nama tujuan
            $booking->capacity,
            $booking->date_start ? $booking->date_start->format('Y-m-d') : null,
            $booking->date_end ? $booking->date_end->format('Y-m-d') : null,
            $booking->pickup_point,
            $booking->fleet_amount,
            $booking->legrest ? 'Ya' : 'Tidak',
            $booking->description,
            $booking->trip_nominal,
            $booking->minimum_dp,
            $booking->payment_received,
            $booking->payment_remaining,
            $booking->total_booking_spend,
            $booking->profit,
            $booking->ms_payment->name,
            $booking->ms_booking->name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menebalkan dan memberi warna latar belakang pada judul tabel
        $headerRow = 'A1:R1';
        $sheet->getStyle($headerRow)->getFont()->setBold(true)->getColor()->setARGB(Color::COLOR_WHITE);
        $sheet->getStyle($headerRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle($headerRow)->getFill()->getStartColor()->setARGB('0070C0'); // Warna biru

        // Mengatur lebar kolom otomatis
        foreach (range('A', 'R') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Mengatur format angka untuk kolom tertentu
        $sheet->getStyle('K:K')->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('L:L')->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('M:M')->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('N:N')->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('O:O')->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('P:P')->getNumberFormat()->setFormatCode('#,##0');

        // Menambahkan warna untuk baris data (misalnya, bergantian warna)
        $rowCount = count($this->query()->get()) + 1; // Menyesuaikan dengan jumlah baris data
        for ($row = 2; $row <= $rowCount; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle("A{$row}:R{$row}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle("A{$row}:R{$row}")->getFill()->getStartColor()->setARGB('F2F2F2'); // Warna abu-abu muda
            }
        }
    }
}
