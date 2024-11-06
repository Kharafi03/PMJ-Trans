<?php

namespace App\Filament\Pages;

use App\Filament\Resources\TripBusResource\Widgets\MyCalendar;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\IncomeChart;
use App\Filament\Widgets\OutcomeChart;
use Filament\Forms\Form;
use App\Filament\Widgets\LatestBooking;
use Filament\Actions\Modal\Actions\Action;
use Filament\Forms\Components\Actions;
use Illuminate\Support\Arr;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    protected function getHeaderActions(): array
    {
        return[
            // Actions\Action::make('calendar')
            //     ->label('Kalender')
        ];
    }
    public static function getPages(): array{
        return[
            //'calendar' => MyCalendar::route('/{record}/edit')
        ];
    }

    public function getWidgets(): array 
    {
        return [
            //MyCalendar::class,
            StatsOverviewWidget::class, // Widget pertama
            IncomeChart::class,       // Widget kedua
            OutcomeChart::class,       // Widget ketiga
            LatestBooking::class, // Widget keempat
        ];
    }
}
