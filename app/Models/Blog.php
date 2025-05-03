<?php

namespace App\Models;

use App\Enums\CP\Blog\KategoriEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $casts = [
        'kategori' => KategoriEnum::class,
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucwords($value);
        $this->attributes['slug'] = str($value)->slug();
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
