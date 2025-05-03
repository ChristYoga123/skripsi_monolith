<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class DiskonPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Diskon';

    protected static string $view = 'filament.admin.pages.diskon-page';

    public function getTitle(): string|Htmlable
    {
        return 'Diskon';
    }
}
