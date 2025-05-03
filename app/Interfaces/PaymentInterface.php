<?php

namespace App\Interfaces;

use App\Models\Transaksi;

interface PaymentInterface
{
    public function pay(Transaksi $transaksi);
}
