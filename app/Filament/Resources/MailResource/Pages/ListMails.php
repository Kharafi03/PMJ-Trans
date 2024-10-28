<?php

namespace App\Filament\Resources\MailResource\Pages;

use App\Filament\Resources\MailResource;
use App\Models\Mail;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListMails extends ListRecords
{
    protected static string $resource = MailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make()->label('Tambah Pesan'),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make(label: 'Semua')
                ->badge($this->getTotalCount()),
            'question' => Tab::make(label: 'Pertanyaan')
                ->badge($this->getCountByCategory('Pertanyaan'))
                ->modifyQueryUsing(function ($query) {
                    return $query->where('category', 'Pertanyaan');
                }),
            'complain' => Tab::make(label: 'Komplain')
                ->badge($this->getCountByCategory('Komplain'))
                ->modifyQueryUsing(function ($query) {
                    return $query->where('category', 'Komplain');
                }),
        ];
    }

    protected function getTotalCount()
    {
        return Mail::count();
    }
    protected function getCountByCategory($category)
    {
        return Mail::where('category', $category)->count();
    }
}
