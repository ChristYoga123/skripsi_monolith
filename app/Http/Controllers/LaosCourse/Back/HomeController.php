<?php

namespace App\Http\Controllers\LaosCourse\Back;

use App\Http\Controllers\Controller;
use App\Models\KursusMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $enrolledKursus = KursusMurid::with([
                'kursus' => function($q)
                {
                    $q->with(['media'])->withCount(['mentors', 'materi']);
                },
                'progres' => function($q)
                {
                    $q->with('materi')->where('is_current', true);
                },
            ])
            ->withCount('progres')
            ->whereStudentId(Auth::user()->id)
            ->latest()
            ->take(3)
            ->get();
        // dd($enrolledKursus);
        return view('pages.laos-course.back.home.index',[
            'title' => 'Dashboard',
            'myCourses' => $enrolledKursus,
        ]);
    }
}
