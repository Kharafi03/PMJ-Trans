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
    public ?string $filter = 'daily'; 

    protected function getFilters(): ?array
    {
        
        return [
            'daily' => 'Harian',
            'monthly' => 'Bulanan',
            'yearly' => 'Tahunan',
        ];
    }

    protected function getData(): array
    {
        
        switch ($this->filter) {
            case 'daily':
                $startDate = Carbon::today();
                $incomeData = Income::selectRaw('DATE_FORMAT(datetime, "%Y-%m-%d") as day, SUM(nominal) as total')
                    ->where('datetime', '>=', $startDate)
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get()
                    ->pluck('total', 'day')
                    ->toArray();

                $labels = [];
                $data = [];
                for ($i = 6; $i >= 0; $i--) {
                    $day = Carbon::now()->subDays($i)->format('Y-m-d');
                    $labels[] = Carbon::now()->subDays($i)->format('d M');
                    $data[] = $incomeData[$day] ?? 0;
                }
                break;

            case 'monthly':
                $startDate = Carbon::now()->subYear();
                $incomeData = Income::selectRaw('DATE_FORMAT(datetime, "%Y-%m") as month, SUM(nominal) as total')
                    ->where('datetime', '>=', $startDate)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get()
                    ->pluck('total', 'month')
                    ->toArray();

                $labels = [];
                $data = [];
                for ($i = 11; $i >= 0; $i--) {
                    $month = Carbon::now()->subMonths($i)->format('Y-m');
                    $labels[] = Carbon::now()->subMonths($i)->format('M Y');
                    $data[] = $incomeData[$month] ?? 0;
                }
                break;

            case 'yearly':
                $startDate = Carbon::now()->subYears(5);
                $incomeData = Income::selectRaw('DATE_FORMAT(datetime, "%Y") as year, SUM(nominal) as total')
                    ->where('datetime', '>=', $startDate)
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get()
                    ->pluck('total', 'year')
                    ->toArray();

                $labels = [];
                $data = [];
                for ($i = 5; $i >= 0; $i--) {
                    $year = Carbon::now()->subYears($i)->format('Y');
                    $labels[] = $year;
                    $data[] = $incomeData[$year] ?? 0;
                }
                break;

            default:
                $labels = [];
                $data = [];
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
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
