<?php

namespace App\Models;

use App\Enums\LaosCourse\Transaksi\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $casts = [
        'status' => StatusEnum::class,
    ];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }
}
