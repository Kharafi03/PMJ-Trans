<?php

namespace App\Filament\Resources\BusKirResource\Pages;

use App\Models\Bus;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BusKirResource;
use App\Models\Outcome;

class EditBusKir extends EditRecord
{
    protected static string $resource = BusKirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void {
        $nameBus = Bus::where('id', $this->record->id_bus)->value('name');
        $nameUser = User::where('id', $this->record->id_user)->value('name');
        Outcome::updateOrCreate(
            ['code_outcome' => $this->record->kir_code],
            [
                'id_m_outcome' => 3,
                'check' => 1,
                'image_receipt' => $this->record->image,
                'nominal' => $this->record->nominal,
                'id_m_method_payment' => $this->record->id_m_method_payment,
                'description' =>'KIR Bus ' . $nameBus .' yang berakhir pada ' . $this->record->expiration . ' oleh ' . $nameUser . ' Dengan deskripsi : ' . $this->record->description,
                'datetime' => $this->record->date_test,
            ]);
    }
}
