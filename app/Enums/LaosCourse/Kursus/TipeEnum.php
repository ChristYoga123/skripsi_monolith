<?php

namespace App\Enums\LaosCourse\Kursus;

use Filament\Support\Contracts\HasLabel;

enum TipeEnum: string implements HasLabel
{
    case FREE = 'free';
    case PREMIUM = 'premium';

    public function getLabel(): ?string
    {
        return match($this) {
            self::FREE => 'Free',
            self::PREMIUM => 'Premium',
        };
    }
}
