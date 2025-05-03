<?php

namespace App\Filament\Admin\Resources\KursusResource\Pages;

use App\Filament\Admin\Resources\KursusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKursuses extends ManageRecords
{
    protected static string $resource = KursusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
