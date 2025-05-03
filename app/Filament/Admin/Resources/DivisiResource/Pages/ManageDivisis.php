<?php

namespace App\Filament\Admin\Resources\DivisiResource\Pages;

use App\Filament\Admin\Resources\DivisiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDivisis extends ManageRecords
{
    protected static string $resource = DivisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->closeModalByClickingAway(false),
        ];
    }
}
