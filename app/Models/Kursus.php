<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\Enums\LaosCourse\Kursus\TipeEnum;
use App\Enums\LaosCourse\Kursus\LevelEnum;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\LaosCourse\Kursus\KategoriEnum;

class Kursus extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $casts = [
        'keypoints' => 'json',
        'kategori' => KategoriEnum::class,
        'level' => LevelEnum::class,
        'tipe' => TipeEnum::class,
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucwords($value);
        $this->attributes['slug'] = str($value)->slug();
    }

    public function mentors()
    {
        return $this->belongsToMany(User::class, 'kursus_mentors', 'kursus_id', 'mentor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'kursus_murids', 'kursus_id', 'student_id');
    }
}
