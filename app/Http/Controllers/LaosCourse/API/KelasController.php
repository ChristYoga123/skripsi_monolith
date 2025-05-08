<?php

namespace App\Http\Controllers\LaosCourse\API;

use App\Models\Kursus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\ResponseFormatterController;

class KelasController extends Controller
{
    public function index()
    {
        $kursus = Kursus::withCount(['mentors', 'students'])
            ->latest()
            ->get();
        $kursus->map(function ($item) {
            $item->thumbnail = $item->getFirstMediaUrl('kursus-thumbnail');
            unset($item->media);
            return $item;
        });
        return ResponseFormatterController::success($kursus, 'Berhasil mendapatkan data kursus');
    }
}
