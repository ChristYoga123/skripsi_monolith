<?php

namespace App\Http\Controllers\LaosCourse\API;

use App\Models\Kursus;
use App\Models\KursusMurid;
use Illuminate\Http\Request;
use App\Models\KursusBabMateri;
use App\Models\KursusMuridProgres;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helpers\ResponseFormatterController;

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
        ->whereStudentId(Auth::guard('api')->user()->id)
        ->latest()
        ->paginate(6);
        return ResponseFormatterController::success($enrolledKursus,  'Berhasil mendapatkan data kursus yang terdaftar');
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
        ->whereStudentId(Auth::guard('api')->user()->id)
        ->whereHas('kursus', function($q) use ($request)
        {
            $q->where('judul', 'LIKE', '%'.$request->judul.'%');
        })
        ->latest()
        ->paginate(6);
        return ResponseFormatterController::success($enrolledKursus,  'Berhasil mendapatkan data kursus yang terdaftar');
    }

    public function show($slug)
    {
        $kursus = Kursus::whereIsPublished(true)
            ->whereSlug($slug)
            ->first();
        if(!$kursus)
        {
            return ResponseFormatterController::error('Kursus tidak ditemukan', 404);
        }
        // First get the kursusMurid record that matches the criteria
        $kursusMurid = KursusMurid::where('kursus_id', $kursus->id)
            ->where('student_id', Auth::guard('api')->user()->id)
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

        return redirect()->route('api.course.dashboard.my-courses.watch', [
            'slug' => $progres->kursusMurid->kursus->slug,
            'kursusBabMateri' => $progres->materi->id,
        ]);
    }

    public function watch($slug, $kursusBabMateri)
    {
        $kursus = Kursus::whereIsPublished(true)
            ->whereSlug($slug)
            ->first();
        if(!$kursus)
        {
            return ResponseFormatterController::error('Kursus tidak ditemukan', 404);
        }

        $kursusBabMateri = KursusBabMateri::whereId($kursusBabMateri)->first();
        if(!$kursusBabMateri)
        {
            return ResponseFormatterController::error('Materi tidak ditemukan', 404);
        }

        // update is_current to false
        KursusMuridProgres::whereHas('kursusMurid', function($q) use ($kursus)
        {
            $q->whereKursusId($kursus->id)->whereStudentId(Auth::guard('api')->user()->id);
        })->update(['is_current' => false]);

        // cek apakah materi yang diakses benar benar materi dari kursus yang diambil
        if(Kursus::whereId($kursus->id)->whereHas('bab.materi', function($q) use ($kursusBabMateri)
        {
            $q->whereId($kursusBabMateri->id);
        })->count() === 0) {
            return ResponseFormatterController::error('Materi kursus yang diakses tidak ditemukan', 404);
        }

        // update is_current to true
        $progres = KursusMuridProgres::whereKursusBabMateriId($kursusBabMateri->id)
            ->whereHas('kursusMurid', function($q) use ($kursus)
            {
                $q->whereKursusId($kursus->id)->whereStudentId(Auth::guard('api')->user()->id);
            })
            ->first();
        if($progres) {
            $progres->update(['is_current' => true]);
        } else {
            $progres = KursusMuridProgres::create([
                'kursus_murid_id' => KursusMurid::whereKursusId($kursus->id)->whereStudentId(Auth::guard('api')->user()->id)->first()->id,
                'kursus_bab_materi_id' => $kursusBabMateri->id,
                'is_current' => true,
            ]);
        }

        // jika jumlah progres === jumlah materi, update is_selesai pada kursus_murid
        $jumlahMateri = $kursus->loadCount('materi')->materi_count;
        $jumlahProgres = KursusMuridProgres::whereKursusMuridId($progres->kursus_murid_id)->count();
        if($jumlahMateri === $jumlahProgres) {
            KursusMurid::whereKursusId($kursus->id)->whereStudentId(Auth::guard('api')->user()->id)->update(['is_selesai' => true]);
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
                $q->whereStudentId(Auth::guard('api')->user()->id);
            },
        ]);

        return ResponseFormatterController::success([
            'kursus' => $kursus,
            'materi' => $kursusBabMateri->load('bab'),
        ], 'Berhasil mendapatkan data kursus yang terdaftar');
    }

    public function createTestimoni(Request $request, $slug)
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

        $kursus = Kursus::whereIsPublished(true)
            ->whereSlug($slug)
            ->first();

        if(!$kursus)
        {
            return ResponseFormatterController::error('Kursus tidak ditemukan', 404);
        }

        // dd($kursus->id);

        DB::beginTransaction();
        try
        {
            $kursusMurid = KursusMurid::whereKursusId($kursus->id)
                ->whereStudentId(Auth::guard('api')->user()->id)
                ->first();

            if(!$kursusMurid)
            {
                return ResponseFormatterController::error('Anda tidak terdaftar di kursus ini', 404);
            }

            if($kursusMurid->rating)
            {
                return ResponseFormatterController::error('Anda sudah memberikan testimoni', 422);
            }

            $kursusMurid->update([
                'rating' => $request->rating_value,
                'komentar' => $request->komentar,
            ]);

            DB::commit();
            return ResponseFormatterController::success(null, 'Berhasil memberikan testimoni');
        }catch(\Exception $e)
        {
            DB::rollBack();
            return ResponseFormatterController::error('Gagal memberikan testimoni ' . $e->getMessage(), 500);
        }
    }
}
