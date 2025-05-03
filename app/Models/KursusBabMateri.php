<?php

namespace App\Models;

use App\Enums\LaosCourse\KursusBabMateri\TipeEnum;
use Illuminate\Database\Eloquent\Model;

class KursusBabMateri extends Model
{
    protected $casts = [
        'tipe' => TipeEnum::class,
    ];
    
    public function bab()
    {
        return $this->belongsTo(KursusBab::class, 'kursus_bab_id');
    }

    public function progres()
    {
        return $this->hasMany(KursusMuridProgres::class);
    }
}
