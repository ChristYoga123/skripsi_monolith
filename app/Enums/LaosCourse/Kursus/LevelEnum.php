<?php

namespace App\Enums\LaosCourse\Kursus;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum LevelEnum: string implements HasLabel, HasColor
{
    case BEGINNER = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED = 'advanced';

    public function getLabel(): string
    {
        return match($this) {
            self::BEGINNER => 'Beginner',
            self::INTERMEDIATE => 'Intermediate',
            self::ADVANCED => 'Advanced',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this) {
            self::BEGINNER => 'success',
            self::INTERMEDIATE => 'warning',
            self::ADVANCED => 'danger',
        };
    }
}
