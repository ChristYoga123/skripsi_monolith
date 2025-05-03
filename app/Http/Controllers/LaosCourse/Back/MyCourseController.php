<?php

namespace App\Http\Controllers\LaosCourse\Back;

use App\Models\Kursus;
use App\Models\KursusMurid;
use Illuminate\Http\Request;
use App\Models\KursusMuridProgres;
use App\Http\Controllers\Controller;
use App\Models\KursusBabMateri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyCourseController extends Controller
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
        ->paginate(6);
        return view('pages.laos-course.back.my-courses.index', [
            'courses' => $enrolledKursus, 
            'title' => 'My Courses',
        ]);
    }

    public function search(Request $request)
    {
        $enrolledKursus = KursusMurid::with([
            'kursus' => function($q) use ($request)
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
        ->whereHas('kursus', function($q) use ($request)
        {
            $q->where('judul', 'LIKE', '%'.$request->judul.'%');
        })
        ->latest()
        ->paginate(6);
        return view('pages.laos-course.back.my-courses.index', [
            'courses' => $enrolledKursus, 
            'title' => 'My Courses',
        ]);
    }

    public function show(Kursus $kursus)
    {
        // First get the kursusMurid record that matches the criteria
        $kursusMurid = KursusMurid::where('kursus_id', $kursus->id)
            ->where('student_id', Auth::user()->id)
            ->first();

        // If kursusMurid exists, use its ID in the firstOrCreate method
        if ($kursusMurid) {
            $progres = KursusMuridProgres::with([
                    'kursusMurid' => function($q) {
                        $q->with(['kursus.bab.materi']);
                    },
                    'materi'
                ])
                ->whereIsCurrent(true)
                ->whereKursusMuridId($kursusMurid->id)
                ->first();

            if(!$progres) {
                $progres = KursusMuridProgres::firstOrCreate([
                    'kursus_murid_id' => $kursusMurid->id,
                    'kursus_bab_materi_id' => $kursus->bab->first()->materi->first()->id,
                    'is_current' => true,
                ]);
            }
        }

        return redirect()->route('course.dashboard.my-courses.watch', [
            'kursus' => $progres->kursusMurid->kursus->slug,
            'kursusBabMateri' => $progres->materi->id,
        ]);
    }

    public function watch(Kursus $kursus, KursusBabMateri $kursusBabMateri)
    {
        // update is_current to false
        KursusMuridProgres::whereHas('kursusMurid', function($q) use ($kursus)
        {
            $q->whereKursusId($kursus->id)->whereStudentId(Auth::user()->id);
        })->update(['is_current' => false]);

        // cek apakah materi yang diakses benar benar materi dari kursus yang diambil
        if(Kursus::whereId($kursus->id)->whereHas('bab.materi', function($q) use ($kursusBabMateri)
        {
            $q->whereId($kursusBabMateri->id);
        })->count() === 0) {
            return redirect()->route('course.dashboard.my-courses.index')->with('error', 'Materi tidak ditemukan');
        }

        // update is_current to true
        $progres = KursusMuridProgres::whereKursusBabMateriId($kursusBabMateri->id)
            ->whereHas('kursusMurid', function($q) use ($kursus)
            {
                $q->whereKursusId($kursus->id)->whereStudentId(Auth::user()->id);
            })
            ->first();
        if($progres) {
            $progres->update(['is_current' => true]);
        } else {
            $progres = KursusMuridProgres::create([
                'kursus_murid_id' => KursusMurid::whereKursusId($kursus->id)->whereStudentId(Auth::user()->id)->first()->id,
                'kursus_bab_materi_id' => $kursusBabMateri->id,
                'is_current' => true,
            ]);
        }

        // jika jumlah progres === jumlah materi, update is_selesai pada kursus_murid
        $jumlahMateri = $kursus->loadCount('materi')->materi_count;
        $jumlahProgres = KursusMuridProgres::whereKursusMuridId($progres->kursus_murid_id)->count();
        if($jumlahMateri === $jumlahProgres) {
            KursusMurid::whereKursusId($kursus->id)->whereStudentId(Auth::user()->id)->update(['is_selesai' => true]);
        }
        $kursus->load([
            'bab' => function($q)
            {
                $q->with([
                    'materi.progres'
                ]);
            },
            'reviews' => function($q)
            {
                $q->whereStudentId(Auth::user()->id);
            },
        ]);

        // dd($kursusBabMateri->load('kursusBab'));
        return view('pages.laos-course.back.my-courses.show', [
            'kursus' => $kursus,
            'materi' => $kursusBabMateri->load('bab'),
        ]);
    }

    public function createTestimoni(Request $request, Kursus $kursus)
    {
        // dd($request->all());
        $request->validate([
            'rating_value' => 'required|numeric|min:1|max:5',
            'komentar' => 'required|string',
        ], [
            'rating_value.required' => 'Rating tidak boleh kosong',
            'komentar.required' => 'Testimoni tidak boleh kosong',
            'rating_value.min' => 'Rating minimal 1',
            'rating_value.max' => 'Rating maksimal 5',
        ]);

        DB::beginTransaction();
        try
        {
            KursusMurid::whereKursusId($kursus->id)
                ->whereStudentId(Auth::user()->id)
                ->update([
                    'rating' => $request->rating_value,
                    'komentar' => $request->komentar,
                ]);

            DB::commit();
            return redirect()->back()->with('success', 'Terima kasih telah memberikan testimoni. Masukan dari Anda merupakan hal yang sangat berharga bagi kami.');
        }catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memberikan testimoni. Silahkan coba lagi.');
        }
    }
}
