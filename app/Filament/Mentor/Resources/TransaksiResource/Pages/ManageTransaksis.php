<?php

namespace App\Filament\Mentor\Resources\TransaksiResource\Pages;

use App\Filament\Mentor\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTransaksis extends ManageRecords
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
