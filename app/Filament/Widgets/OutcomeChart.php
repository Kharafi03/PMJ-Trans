<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Outcome;
use Carbon\Carbon;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class OutcomeChart extends BarChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Total Pengeluaran';
    protected static string $color = 'danger';
    protected static ?string $icon = 'heroicon-o-cash'; // Ikon untuk pengeluaran
    protected static ?string $iconColor = 'danger';
    protected static ?string $iconBackgroundColor = 'danger';
    protected static ?string $label = 'Monthly Outcome';

    public ?string $filter = 'today'; // Default filter

    //Mengatur pilihan filter untuk periode waktu.
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last Week',
            'month' => 'Last Month',
            'year' => 'This Year',
        ];
    }


    // Mengambil data pengeluaran berdasarkan filter periode waktu yang dipilih.
  
    protected function getData(): array
    {
        // Mengambil tanggal awal berdasarkan filter yang dipilih
        $startDate = match ($this->filter) {
            'today' => Carbon::today(),
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'year' => Carbon::now()->subYear(),
            default => Carbon::now()->subMonths(12),
        };

        // Mengambil data pengeluaran per bulan dari rentang waktu yang dipilih
        $outcomePerMonth = Outcome::selectRaw('DATE_FORMAT(datetime, "%Y-%m") as month, SUM(nominal) as total')
            ->where('datetime', '>=', $startDate)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Membuat array 12 bulan terakhir untuk label dan data
        $months = [];
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m'); // Format bulan (contoh: 2023-09)
            $months[] = Carbon::now()->subMonths($i)->format('M Y'); // Format untuk label (contoh: Sep 2023)
            $data[] = $outcomePerMonth[$month] ?? 0; // Mengambil jumlah pengeluaran atau 0 jika tidak ada
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran',
                    'data' => $data,
                    'backgroundColor' => '#FFA500', // Warna oranye untuk pengeluaran
                    'borderWidth' => 0,
                ],
            ],
            'labels' => $months,
        ];
    }


    // Tipe grafik yang digunakan.
    protected function getType(): string
    {
        return 'bar'; 
    }
}
