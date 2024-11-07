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
    protected static ?string $icon = 'heroicon-o-cash';
    protected static ?string $iconColor = 'danger';
    protected static ?string $iconBackgroundColor = 'danger';

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
                $outcomeData = Outcome::selectRaw('DATE_FORMAT(datetime, "%Y-%m-%d") as day, SUM(nominal) as total')
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
                    $data[] = $outcomeData[$day] ?? 0;
                }
                break;

            case 'monthly':
                $startDate = Carbon::now()->subYear();
                $outcomeData = Outcome::selectRaw('DATE_FORMAT(datetime, "%Y-%m") as month, SUM(nominal) as total')
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
                    $data[] = $outcomeData[$month] ?? 0;
                }
                break;

            case 'yearly':
                $startDate = Carbon::now()->subYears(5);
                $outcomeData = Outcome::selectRaw('DATE_FORMAT(datetime, "%Y") as year, SUM(nominal) as total')
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
                    $data[] = $outcomeData[$year] ?? 0;
                }
                break;

            default:
                $labels = [];
                $data = [];
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
            'labels' => $labels,
        ];
    }

    
    protected function getType(): string
    {
        return 'bar';
    }
}
