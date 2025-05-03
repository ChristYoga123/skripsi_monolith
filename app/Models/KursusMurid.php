<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusMurid extends Model
{
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function progres()
    {
        return $this->hasMany(KursusMuridProgres::class);
    }
}
