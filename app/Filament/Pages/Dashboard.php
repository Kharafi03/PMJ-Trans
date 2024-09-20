<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\IncomeChart;
use App\Filament\Widgets\OutcomeChart;
use Filament\Forms\Form;
use App\Filament\Widgets\LatestBooking;


class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function getWidgets(): array // Pastikan method ini adalah public
    {
        return [
            StatsOverviewWidget::class, // Widget pertama
            IncomeChart::class,       // Widget ketiga
            OutcomeChart::class,       // Widget ketiga
            LatestBooking::class, // Tambah LatestBooking di sini
        ];
    }
}
