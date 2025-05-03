<?php

namespace App\Http\Controllers\LaosCourse\Front;

use App\Models\Kursus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\LaosCourse\Kursus\KategoriEnum;
use App\Enums\LaosCourse\KursusBabMateri\TipeEnum;
use App\Models\KursusMurid;

class HomeController extends Controller
{
    public $title = 'Selamat Datang';

    public function index()
    {
        $courseCountsByCategory = Kursus::where('is_published', true)
            ->whereIn('kategori', [
                KategoriEnum::PROGRAMMING,
                KategoriEnum::CYBER_SECURITY,
                KategoriEnum::DESIGN,
                KategoriEnum::DIGITAL_MARKETING
            ])
            ->selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();
        
        $latestCourses = Kursus::
            with([
                'materi' => function($query)
                {
                    $query->whereTipe(TipeEnum::VIDEO);
                }, 
                'flashSale'])
            ->withCount(['mentors', 'students', 'materi'])
            ->withAvg('reviews as avg_rating', 'kursus_murids.rating')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $reviews = KursusMurid::with('student')->whereRating(5)->latest()->limit(3)->get();
        
        return view('pages.laos-course.front.home.index', [
            'title' => $this->title,
            'courseCountsByCategory' => $courseCountsByCategory,
            'latestCourses' => $latestCourses,
            'reviews' => $reviews,
        ]);
    }
}
