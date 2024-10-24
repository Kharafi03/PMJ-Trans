<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Income;
use Carbon\Carbon;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class IncomeChart extends BarChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Total Pendapatan'; 
    protected static string $color = 'info'; 
    public ?string $filter = 'today'; // Default 

    protected function getFilters(): ?array
    {
        // Pilihan filter untuk tampilan data berdasarkan rentang waktu
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        // Mengambil tanggal berdasarkan filter yang dipilih
        $startDate = match ($this->filter) {
            'today' => Carbon::today(),
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'year' => Carbon::now()->subYear(),
            default => Carbon::now()->subMonths(12),
        };

        // Mengambil data pendapatan per bulan dari rentang waktu yang dipilih
        $incomePerMonth = Income::selectRaw('DATE_FORMAT(datetime, "%Y-%m") as month, SUM(nominal) as total')
            ->where('datetime', '>=', $startDate)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Array untuk 12 bulan terakhir atau sesuai filter
        $months = [];
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $months[] = Carbon::now()->subMonths($i)->format('M Y');
            $data[] = $incomePerMonth[$month] ?? 0;
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

    protected function getType(): string
    {
        
        return 'bar';
    }
}
