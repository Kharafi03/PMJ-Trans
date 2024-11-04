<?php

namespace App\Filament\Resources\BusMaintenanceResource\Pages;

use App\Filament\Resources\BusMaintenanceResource;
use App\Models\Bus;
use App\Models\MMaintenance;
use App\Models\Outcome;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusMaintenance extends EditRecord
{
    protected static string $resource = BusMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void {
        $nameBus = Bus::where('id', $this->record->id_bus)->value('name');
        $nameUser = User::where('id', $this->record->id_user)->value('name');
        $nameMaintenance = MMaintenance::where('id', $this->record->id_m_maintenance)->value('name');
        //dd($nameBus, $nameUser, $nameMaintenance);
        Outcome::updateOrCreate(
            ['outcome_code' => $this->record->maintenance_code],
            [
                'id_m_outcome' => 3,
                'check' => 1,
                //'code_outcome' => $get('maintenance_code'),
                'image_receipt' => $this->record->image_receipt,
                'nominal' => $this->record->nominal,
                'id_m_method_payment' => $this->record->id_m_method_payment,
                'description' => $nameMaintenance . ' Bus ' . $nameBus . ' oleh ' . $nameUser . ' Dengan deskripsi : ' . $this->record->description,
                'datetime' => now(),
            ]);
    }
}
