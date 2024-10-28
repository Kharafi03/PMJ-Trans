<?php

namespace Database\Seeders;

use App\Models\MsPaymentBooking;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MsUserSeeder::class);
        $this->call(UserSeeder::class); 
        $this->call(MsBusSeeder::class);
        $this->call(MMaintenanceSeeder::class);
        $this->call(MSpendSeeder::class);
        $this->call(MsPaymentBookingSeeder::class);
        //$this->call(MsTripFinishedSeeder::class);
        $this->call(MIncomeSeeder::class);
        $this->call(MOutcomeSeeder::class);
        $this->call(MMethodPaymentSeeder::class);
        $this->call(MsIncomeSeeder::class);
        $this->call(MsBookingSeeder::class);
        $this->call(MsTripSeeder::class);
        $this->call(BusSeeder::class);
        $this->call(BusImageSeeder::class);
        $this->call(TestSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(TermsAndConditionsSeeder::class);
        //$this->call(ShieldSeeder::class);
        // $this->call(PermisionsSeeder::class);
    }
}
