<?php

namespace App\Http\Controllers\CP\Front;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
        return view('pages.cp.front.program.index', [
            'title' => 'Program',
            'programs' => Program::with('media')->get(),
        ]);
    }

    public function show(Program $program)
    {
        $program->load(['media', 'divisi']);
        $documentations = $program->media->where('collection_name', 'program-dokumentasi')->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->getUrl(),
                'name' => $item->file_name,
            ];
        });

        return view('pages.cp.front.program.show', [
            'title' => $program->judul_kegiatan,
            'program' => $program,
            'documentations' => $documentations->toArray(),
        ]);
    }
}
