<?php

namespace App\Filament\Resources\TripBusResource\Widgets;

use Guava\Calendar\Widgets\CalendarWidget;
use Filament\Actions\CreateAction;
use App\Models\Foo; // Pastikan Anda mengimpor model Foo
use Filament\Forms\Form;
use Illuminate\Support\Facades\Event;

class MyCalendar extends CalendarWidget
{
    protected bool $dateClickEnabled = true;
    protected bool $dateSelectEnabled = true;
   // protected string $calendarView = 'resourceTimeGridWeek';

    public function viewAction(): CreateAction
    {
        return CreateAction::make('View')
            ->url(fn ($record) => $record ? route('trip-bus.show', $record->id) : '#'); // Menangani kasus null
    }

    public function getDateClickContextMenuActions(): array
    {
        return [
            CreateAction::make('Add Event')
                ->model(Foo::class)
                ->mountUsing(function ($arguments, Form $form = null) { // Menambahkan default null untuk $form
                    if ($form) {
                        $dateStr = data_get($arguments, 'dateStr'); // Ambil dateStr
                        if ($dateStr) {
                            $form->fill([
                                'starts_at' => $dateStr,
                                'ends_at' => $dateStr,
                            ]);
                        } else {
                            \Log::error('dateStr is null when trying to mount CreateAction', [
                                'arguments' => $arguments,
                            ]);
                        }
                    } else {
                        \Log::error('Form is null when trying to mount CreateAction', [
                            'arguments' => $arguments,
                        ]);
                    }
                }),
        ];
    }

    public function getDateSelectContextMenuActions(): array
    {
        return [
            CreateAction::make('Add Event Range')
                ->model(Foo::class)
                ->mountUsing(function ($arguments, Form $form = null) { // Menambahkan default null untuk $form
                    if ($form) {
                        $startStr = data_get($arguments, 'startStr');
                        $endStr = data_get($arguments, 'endStr');
                        if ($startStr && $endStr) {
                            $form->fill([
                                'starts_at' => $startStr,
                                'ends_at' => $endStr,
                            ]);
                        } else {
                            \Log::error('startStr or endStr is null when trying to mount CreateAction', [
                                'arguments' => $arguments,
                            ]);
                        }
                    } else {
                        \Log::error('Form is null when trying to mount CreateAction', [
                            'arguments' => $arguments,
                        ]);
                    }
                }),
        ];
    }

    public function getEventClickContextMenuActions(): array
    {
        return [
            $this->viewAction(),
            // Anda bisa menambahkan lebih banyak aksi seperti edit dan delete di sini
        ];
    }

    public function getNoEventsClickContextMenuActions(): array
    {
        return [
            CreateAction::make('Add Event')
                ->model(Foo::class),
        ];
    }
}
