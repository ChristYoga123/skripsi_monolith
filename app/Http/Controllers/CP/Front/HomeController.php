<?php

namespace App\Http\Controllers\CP\Front;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.cp.front.home.index', [
            'title' => 'Selamat Datang',
            'programs' => Program::with(['media'])->get(),
        ]);
    }
}
