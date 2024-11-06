<?php

namespace App\Filament\Resources\BusKirResource\Pages;

use App\Filament\Resources\BusKirResource;
use App\Models\Bus;
use App\Models\Outcome;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusKir extends CreateRecord
{
    protected static string $resource = BusKirResource::class;

    public function getTitle(): string
    {
        return 'Tambah KIR';
    }

    protected function afterCreate(): void {
        $nameBus = Bus::where('id', $this->record->id_bus)->value('name');
        $nameUser = User::where('id', $this->record->id_user)->value('name');
        Outcome::updateOrCreate(
            ['outcome_code' => $this->record->kir_code],
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
