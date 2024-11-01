<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\BusKir;
use App\Models\BusMaintenance;
use App\Models\BusTax;
use App\Models\Destination;
use App\Models\Income;
use App\Models\Review;
use App\Models\TripBus;
use App\Models\TripBusSpend;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Booking::create([
            'booking_code' => 'PMJ-RASE8280',
            'id_cus' => '5',
            'capacity' => '100',
            'date_start' => '2024-10-25 11:00:00',
            'date_end' => '2024-10-28',
            'pickup_point' => 'Jl. Pandanaran Raya No.37',
            'fleet_amount' => '2',
            'legrest' => '0',
            'description' => 'tidak menggunakan legrest',
            'trip_nominal' => '15000000',
            'minimum_dp' => '5000000',
            'id_ms_booking' => '2',
            'id_ms_payment' => '3',
            'payment_received' => '5000000',
            'payment_remaining' => '10000000',
        ]);

        Review::create([
            'id_booking' => '1',
            'feedback' => 'Saya suka PMJ Trans, ini adalah tempat terbaik untuk memesan bus dan membantu saya menemukan liburan impian saya. Pelayanannya bagus, Saya sangat terbantu',
            'rating' => '5',
        ]);

        Destination::create([
            'id_booking' => '1',
            'name' => 'Masjid Agung Jawa Tengah (MAJT), Semarang',
        ]);

        Destination::create([
            'id_booking' => '1',
            'name' => 'Sampokong, Semarang',
        ]);

        Destination::create([
            'id_booking' => '1',
            'name' => 'Firdaus Fatimah Zahra, Semarang',
        ]);

        Income::create([
            'id_booking' => '1',
            'id_m_income' => '1',
            'id_m_method_payment' => '1',
            'description' => 'Pembayaran DP untuk kode pemesanan PMJ-RASE8280',
            'nominal' => '5000000',
            'id_ms_income' => '2',
            'datetime' => '2024-10-20 12:32:16'
        ]);

        TripBus::create([
            'id_booking' => '1',
            'id_bus' => '1',
            'id_driver' => '3',
            'id_codriver' => '1',
            'km_start' => '12319872',
            'km_end' => '12319999',
            'nominal' => '5000000',
            'legrest' => '0',
            'id_ms_trip' => '1',
        ]);

        TripBus::create([
            'id_booking' => '1',
            'id_bus' => '2',
            'id_driver' => '4',
            'id_codriver' => '2',
            'km_start' => '12319872',
            'km_end' => '12319999',
            'nominal' => '5000000',
            'legrest' => '0',
            'id_ms_trip' => '1',
        ]);

        TripBusSpend::create([
            'id_trip_bus' => '1',
            'id_m_spend' => '1',
            'description' => 'Pengisian BBM di SPBU KendalJati',
            'nominal' => '150000',
            'kilometer' => '13212314',
            //'image_receipt' => '',
            'datetime' => '2024-10-20 12:32:16',
            'latitude' => '456172931',
            'longitude' => '4512318213',
        ]);

        TripBusSpend::create([
            'id_trip_bus' => '1',
            'id_m_spend' => '2',
            'description' => 'Pembayaran gerbang tol Kalipancur',
            'nominal' => '1000000',
            'kilometer' => '12312412',
            //'image_receipt' => '',
            'datetime' => '2024-10-20 12:32:16',
            'latitude' => '082736542',
            'longitude' => '2345678923',
        ]);

        TripBusSpend::create([
            'id_trip_bus' => '2',
            'id_m_spend' => '1',
            'description' => 'Pengisian BBM di SPBU KendalJati',
            'nominal' => '1500000',
            'kilometer' => '12312412',
            //'image_receipt' => '',
            'datetime' => '2024-10-20 12:32:16',
            'latitude' => '082736542',
            'longitude' => '2345678923',
        ]);

        TripBusSpend::create([
            'id_trip_bus' => '1',
            'id_m_spend' => '5',
            'description' => 'Perbaikan ban bocor',
            'nominal' => '50000',
            'kilometer' => '12312412',
            //'image_receipt' => '',
            'datetime' => '2024-10-20 12:32:16',
            'latitude' => '082736542',
            'longitude' => '2345678923',
        ]);

        BusMaintenance::create([
            'maintenance_code' => 'MTC-RASE828a',
            'id_bus' => '1',
            'id_user' => '3',
            'id_m_maintenance' => '2',
            'description' => 'Kanvas rem habis, peggantian kanavas rem',
            'image' => '',
            'date' => '2024-10-10',
            'location' => 'Garasi PMJ-Trans',
            'nominal' => '500000',
            'image_receipt' => '',
            'id_m_method_payment' => 1,
            'latitude' => '-6.819167',
            'longitude' => '110.877858',
        ]);

        BusMaintenance::create([
            'maintenance_code' => 'MTC-RASE828b',
            'id_bus' => '1',
            'id_user' => '3',
            'id_m_maintenance' => '1',
            'description' => 'Maintenance Mesin rutin',
            'image' => '',
            'date' => '2024-10-9',
            'location' => 'Garasi PMJ-Trans',
            'nominal' => '300000',
            'image_receipt' => '',
            'id_m_method_payment' => 1,
            'latitude' => '-6.819167',
            'longitude' => '110.877858',
        ]);

        BusMaintenance::create([
            'maintenance_code' => 'MTC-RASE828c',
            'id_bus' => '2',
            'id_user' => '3',
            'id_m_maintenance' => '1',
            'description' => 'Maintenance Mesin rutin',
            'image' => '',
            'date' => '2024-10-9',
            'location' => 'Garasi PMJ-Trans',
            'nominal' => '300000',
            'image_receipt' => '',
            'id_m_method_payment' => 1,
            'latitude' => '-6.819167',
            'longitude' => '110.877858',
        ]);

        BusMaintenance::create([
            'maintenance_code' => 'MTC-RASE828d',
            'id_bus' => '2',
            'id_user' => '3',
            'id_m_maintenance' => '3',
            'description' => 'Pergantian Oli',
            'image' => '',
            'date' => '2024-10-11',
            'location' => 'Garasi PMJ-Trans',
            'nominal' => '400000',
            'image_receipt' => '',
            'id_m_method_payment' => 1,
            'latitude' => '-6.819167',
            'longitude' => '110.877858',
        ]);

        BusKir::create([
            'kir_code' => 'KIR-RASE828a',
            'id_bus' => '1',
            'id_user' => '3',
            'description' => 'Pengujian Kir bus PMJ 02 di dinas perhubungan',
            'date_test' => '2024-6-11',
            'expiration' => '2024-12-11',
            'nominal' => '100000',
            'image' => '',
            'id_m_method_payment' => 1,
        ]);

        BusKir::create([
            'kir_code' => 'KIR-RASE828b',
            'id_bus' => '2',
            'id_user' => '3',
            'description' => 'Pengujian Kir bus PMJ 03 di dinas perhubungan',
            'date_test' => '2024-4-11',
            'expiration' => '2024-10-11',
            'nominal' => '100000',
            'image' => '',
            'id_m_method_payment' => 1,
        ]);

        BusTax::create([
            'tax_code' => 'TAX-RASE828a',
            'id_bus' => '1',
            'id_user' => '3',
            'description' => 'Pajak bus PMJ 02 di Samsat',
            'date' => '2023-11-11',
            'expiration' => '2024-11-11',
            'expiration_number_bus' => '2024-11-11',
            'nominal' => '100000',
            'image' => '',
            'id_m_method_payment' => 1,
        ]);

        BusTax::create([
            'tax_code' => 'TAX-RASE828b',
            'id_bus' => '2',
            'id_user' => '3',
            'description' => 'Pajak bus PMJ 03 di Samsat',
            'date' => '2023-9-20',
            'expiration' => '2024-9-20',
            'expiration_number_bus' => '2028-9-20',
            'nominal' => '100000',
            'image' => '',
            'id_m_method_payment' => 1,
        ]);
    }
}
