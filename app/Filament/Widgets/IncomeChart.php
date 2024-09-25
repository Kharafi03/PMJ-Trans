<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Income;
use Carbon\Carbon;

class IncomeChart extends BarChartWidget
{
    protected static ?string $heading = 'Total Pendapatan';

    protected function getData(): array
    {
        // Mengambil tanggal 12 bulan yang lalu
        $twelveMonthsAgo = Carbon::now()->subMonths(12);

        // Mengambil data pendapatan per bulan dari 12 bulan terakhir
        $incomePerMonth = Income::selectRaw('DATE_FORMAT(datetime, "%Y-%m") as month, SUM(nominal) as total')
            ->where('datetime', '>=', $twelveMonthsAgo) // Hanya data dari 12 bulan terakhir
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // array dari 12 bulan terakhir
        $months = [];
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m'); // Format bulan (contoh: 2023-09)
            $months[] = Carbon::now()->subMonths($i)->format('M Y'); // Format untuk label (contoh: Sep 2023)
            $data[] = $incomePerMonth[$month] ?? 0; // Mengambil jumlah pendapatan atau 0 jika tidak ada
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data,
                    'backgroundColor' => '#1A56DB',
                    'borderWidth' => 0,
                ],
            ],
            'labels' => $months,
        ];
    }
}
