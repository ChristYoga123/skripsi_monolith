<?php

namespace App\Models;

use App\Enums\LaosCourse\Diskon\JenisEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $casts = [
        'jenis' => JenisEnum::class,
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'diskon_kode', 'kode');
    }

    public function getIsActiveAttribute(): bool
    {
        // jika jenis diskon adalah dibatasi tanggal
        if ($this->jenis->value === JenisEnum::DIBATASI_TANGGAL->value) {
            return $this->tanggal_mulai <= now() && $this->tanggal_selesai >= now();
        } elseif($this->jenis->value === JenisEnum::DIBATASI_KUOTA->value) {
            // jika jenis diskon adalah dibatasi jumlah
            return $this->kuota > $this->transaksi->count();
        }

        return false;
    }
}
