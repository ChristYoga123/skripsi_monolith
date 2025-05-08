<?php

namespace App\Http\Controllers\LaosCourse\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\ResponseFormatterController;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::latest()
            ->limit(40)
            ->get();

        return ResponseFormatterController::success($transaksi, 'Data Seluruh Transaksi Berhasil Diambil');
    }
}
