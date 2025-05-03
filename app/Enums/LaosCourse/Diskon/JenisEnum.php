<?php

namespace App\Enums\LaosCourse\Diskon;

use Filament\Support\Contracts\HasLabel;

enum JenisEnum: string implements HasLabel
{
    case DIBATASI_TANGGAL = 'dibatasi_tanggal';
    case DIBATASI_KUOTA = 'dibatasi_kuota';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DIBATASI_TANGGAL => 'Dibatasi Tanggal',
            self::DIBATASI_KUOTA => 'Dibatasi Kuota',
        };
    }
}
