<?php

namespace App\Http\Controllers\CP\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;
        
        $popularArticlesQuery = Blog::with('media')->whereIsUnggulan(true)->latest();
        $latestArticlesQuery = Blog::with('media')->latest();
        
        // Filter by category if provided
        if ($kategori && $kategori !== 'semua') {
            $latestArticlesQuery->where('kategori', $kategori);
        }
        
        $popularArticles = $popularArticlesQuery->limit(3)->get();
        $latestArticles = $latestArticlesQuery->paginate(6);
        
        return view('pages.cp.front.blog.index', [
            'title' => 'Blog',
            'articles' => $latestArticles,
            'popularArticles' => $popularArticles,
            'activeKategori' => $kategori ?? 'semua',
            'categories' => [
                'semua' => 'Semua',
                'informasi' => 'Informasi',
                'tutorial' => 'Tutorial',
                'mitos-fakta' => 'Mitos dan Fakta',
                'tips-trik' => 'Tips dan Trik',
                'press-release' => 'Press Release',
            ],
        ]);
    }

    public function show(Blog $blog)
    {   
        $blog->load('divisi');
        return view('pages.cp.front.blog.show', [
            'title' => $blog->judul,
            'article' => $blog,
        ]);
    }
}
