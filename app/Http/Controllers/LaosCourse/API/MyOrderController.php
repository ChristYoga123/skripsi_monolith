<?php

namespace App\Http\Controllers\LaosCourse\API;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\ResponseFormatterController;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index()
    {
        $myOrders = Transaksi::whereStudentId(Auth::guard('api')->user()->id)
            ->with(['kursus' => function($query) {
                $query->with(['media' => fn($q) => $q->whereCollectionName('kursus-thumbnail')]);
            }])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return ResponseFormatterController::success($myOrders, 'Berhasil mendapatkan data transaksi');
    }
}
