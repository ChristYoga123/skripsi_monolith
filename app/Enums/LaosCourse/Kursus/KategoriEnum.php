<?php

namespace App\Enums\LaosCourse\Kursus;

use Filament\Support\Contracts\HasLabel;

enum KategoriEnum: string implements HasLabel
{
    case PROGRAMMING = 'programming';
    case CYBER_SECURITY = 'cyber-security';
    case DESIGN = 'design';
    case DIGITAL_MARKETING = 'digital-marketing';

    public function getLabel(): string
    {
        return match($this) {
            self::PROGRAMMING => 'Programming',
            self::CYBER_SECURITY => 'Cyber Security',
            self::DESIGN => 'Design',
            self::DIGITAL_MARKETING => 'Digital Marketing',
        };
    }
}
