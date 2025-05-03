<?php

namespace App\Http\Controllers\LaosCourse\Front;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('pages.laos-course.front.kelas.index', [
            'title' => 'Kelas',
            'courses' => Kursus::withCount(['mentors', 'students'])->with(['materi', 'flashSale'])->withAvg('reviews as avg_rating', 'kursus_murids.rating')->whereIsPublished(true)->latest()->paginate(6),
        ]);
    }

    public function filter(Request $request)
    {
        $kategori = $request->has('kategori') ? explode(',', $request->kategori) : [];

        $courses = Kursus::with(['flashSale', 'materi'])->withCount(['mentors', 'students'])
            ->whereIsPublished(true)
            ->withAvg('reviews as avg_rating', 'kursus_murids.rating')
            ->when(!empty($kategori), function ($query) use ($kategori) {
                return $query->whereIn('kategori', $kategori);
            })
            ->latest()
            ->paginate(6);

        // Preserve query parameters in pagination links
        $courses->appends($request->all());

        if ($request->ajax()) {
            return view('pages.laos-course.front.kelas.index', [
                'title' => 'Kelas',
                'courses' => $courses,
                'selectedCategory' => $kategori,
            ]);
        }

        return view('pages.laos-course.front.kelas.index', [
            'title' => 'Kelas',
            'courses' => $courses,
            'selectedCategory' => $request->kategori,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Ensure query is at least 3 characters
        if (!$query || strlen($query) < 3) {
            return response()->json(['courses' => []]);
        }
        
        // Get matching courses
        $courses = Kursus::with('media')->whereIsPublished(true)
                        ->where('judul', 'like', "%{$query}%")
                        ->orWhere('kategori', 'like', "%{$query}%")
                        ->limit(8) // Limit to 8 results for better UX
                        ->get()
                        ->map(function($course) {
                            return [
                                'id' => $course->id,
                                'title' => $course->judul,
                                'slug' => $course->slug,
                                'category' => $course->kategori->getLabel(),
                                'thumbnail' => $course->getFirstMediaUrl('kursus-thumbnail'),
                                'price' => $course->price ? 'Rp ' . number_format($course->harga, 0, ',', '.') : 'Free',
                                'url' => route('course.kelas.show', $course->slug), // Change this to the actual course URL
                            ];
                        });
        if ($courses->isEmpty()) {
            return response()->json([
                'message' => 'Kelas tidak ditemukan',
            ], 404);
        }
        
        return response()->json(['courses' => $courses]);
    }

    public function show(Kursus $kursus)
    {
        if ($kursus->is_published == false) {
            return redirect()->back()->with('error', 'Kursus tidak ditemukan');
        }
        $kursus
            ->load(['media', 'bab.materi', 'mentors', 'techStacks.media', 'materi', 'reviews' => function ($query) {
                $query->with('student');
            }, 'flashSale'])
            ->loadCount(['bab', 'mentors', 'students', 'materi', 'reviews'])
            ->loadAvg('reviews as avg_rating', 'kursus_murids.rating');
        return view('pages.laos-course.front.kelas.show', [
            'title' => $kursus->judul,
            'course' => $kursus,
        ]);
    }
}
