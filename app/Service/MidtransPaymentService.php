<?php

namespace App\Service;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaksi;
use Midtrans\Transaction;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Interfaces\PaymentInterface;
use App\Enums\LaosCourse\Transaksi\StatusEnum;
use App\Http\Controllers\Helpers\ResponseFormatterController;
use App\Models\KursusMurid;

class MidtransPaymentService implements PaymentInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    private const STATUS_MAPPING = [
        'capture' => [
            'challenge' => StatusEnum::PENDING,
            'accept' => StatusEnum::SUCCESS,
        ],
        'cancel' => StatusEnum::FAILED,
        'deny' => StatusEnum::FAILED,
        'settlement' => StatusEnum::SUCCESS,
        'pending' => StatusEnum::PENDING,
        'expire' => StatusEnum::FAILED,
    ];

    public function pay(Transaksi $transaksi)
    {
        try
        {
            $itemDetails = [
                'id' => $transaksi->order_id,
                'price' => $transaksi->total_harga,
                'quantity' => 1,
                'name' => "Pembayaran untuk transaksi {$transaksi->order_id}",
            ];
    
            $customerDetails = [
                'first_name' => $transaksi->student->name,
                'email' => $transaksi->student->email,
            ];
    
            $midtransParam = [
                'transaction_details' => [
                    'order_id' => $transaksi->order_id,
                    'gross_amount' => $transaksi->total_harga,
                ],
                'item_details' => [$itemDetails],
                'customer_details' => $customerDetails,
            ];
            return Snap::getSnapToken($midtransParam);
        } catch(Exception $e)
        {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return ResponseFormatterController::error('Gagal mendapatkan token Midtrans', 500);
        }
    }

    public function midtransCallback(Request $request)
    {
        DB::beginTransaction();
        try {
            $notif = $request->method() == 'POST' 
                ? new Notification() 
                : Transaction::status($request->order_id);

            $checkout = Transaksi::whereOrderId($notif->order_id)->firstOrFail();
            
            $status = self::STATUS_MAPPING[$notif->transaction_status] ?? 'failed';
            if ($notif->transaction_status === 'capture' || $notif->transaction_status === 'cancel') {
                $status = self::STATUS_MAPPING[$notif->transaction_status][$notif->fraud_status] ?? 'failed';
            }

            $checkout->status = $status;

            $checkout->save();

            // jika checkout sukses maka enroll ke kursus
            if($checkout->status == StatusEnum::SUCCESS)
            {
                KursusMurid::create([
                    'student_id' => $checkout->student_id,
                    'kursus_id' => $checkout->kursus_id,
                ]);
            }

            DB::commit();
            return ResponseFormatterController::success($checkout, 'Transaksi berhasil');
            
        } catch(Exception $e) {
            DB::rollBack();
            Log::error('Midtrans callback error: ' . $e->getMessage());
            return ResponseFormatterController::error('Gagal memproses callback Midtrans', 500);
        }
    }
}
