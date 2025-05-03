<?php

namespace App\Http\Controllers\LaosCourse\Back;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index()
    {
        return view('pages.laos-course.back.my-orders.index', [
            'title' => 'My Orders',
            'transactions' => Transaksi::whereStudentId(Auth::user()->id)
                ->with('kursus.media')
                ->latest()
                ->paginate(10)
                ->withQueryString(),
        ]);
    }
}
