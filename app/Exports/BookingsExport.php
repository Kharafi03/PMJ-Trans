<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    protected $bookings;

    public function __construct($bookings)
    {
        $this->bookings = $bookings; // Menggunakan data yang dipilih
    }

    public function collection()
    {
        return $this->bookings; // Mengembalikan data yang dipilih
    }

    public function headings(): array
    {
        return [
            'Booking Code',
            'Customer ID',
            'Destination Point',
            'Capacity',
            'Date Start',
            'Date End',
            'Pickup Point',
            'Fleet Amount',
            'Legrest',
            'Description',
            'Trip Nominal',
            'Minimum DP',
        ];
    }
}
