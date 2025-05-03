<?php

namespace App\Enums\LaosCourse\Transaksi;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel, HasColor
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILED = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Menunggu',
            self::SUCCESS => 'Sukses',
            self::FAILED => 'Gagal',
        };
    }
    
    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::SUCCESS => 'success',
            self::FAILED => 'danger',
        };
    }
}
