<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TechStack extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function kursus()
    {
        return $this->belongsToMany(Kursus::class, 'kursus_tech_stacks', 'tech_stack_id', 'kursus_id');
    }
}
