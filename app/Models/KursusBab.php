<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusBab extends Model
{
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function materi()
    {
        return $this->hasMany(KursusBabMateri::class);
    }
}
