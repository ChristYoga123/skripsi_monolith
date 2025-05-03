<?php

namespace App\Enums\CP\Blog;

use Filament\Support\Contracts\HasLabel;

enum KategoriEnum: string implements HasLabel
{
    case INFORMASI = 'informasi';
    case TUTORIAL = 'tutorial';
    case MITOS_FAKTA = 'mitos-fakta';
    case TIPS_TRIK = 'tips-trik';
    case PRESS_RELEASE = 'press-release';

    public function getLabel(): string
    {
        return match ($this) {
            self::INFORMASI => 'Informasi',
            self::TUTORIAL => 'Tutorial',
            self::MITOS_FAKTA => 'Mitos & Fakta',
            self::TIPS_TRIK => 'Tips & Trik',
            self::PRESS_RELEASE => 'Press Release',
        };
    }
}
