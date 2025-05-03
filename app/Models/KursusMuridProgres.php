<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusMuridProgres extends Model
{
    public function kursusMurid()
    {
        return $this->belongsTo(KursusMurid::class);
    }

    public function materi()
    {
        return $this->belongsTo(KursusBabMateri::class, 'kursus_bab_materi_id');
    }
}
