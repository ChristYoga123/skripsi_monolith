<?php

namespace App\Http\Controllers\LaosCourse\API;

use App\Enums\LaosCourse\Kursus\TipeEnum;
use Exception;
use App\Models\Diskon;
use App\Models\Kursus;
use App\Models\Transaksi;
use App\Models\KursusMurid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Interfaces\PaymentInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helpers\ResponseFormatterController;

class CheckoutController extends Controller
{
    // Kursus Gratis
    public function daftar($slug)
    {   
        $kursus = Kursus::whereSlug($slug)->whereIsPublished(true)->first();

        if(!$kursus)
        {
            return ResponseFormatterController::error('Kursus tidak ditemukan', 404);
        }

        if($kursus->tipe === TipeEnum::PREMIUM)
        {
            return ResponseFormatterController::error('Anda tidak bisa mendaftar kursus premium sebelum membeli kelas', 400);
        }

        // Validasi checkout
        [$hasil, $errorMessage] = $this->checkoutValidation($kursus);
        if(!$hasil)
        {
            return ResponseFormatterController::error($errorMessage);
        }

        DB::beginTransaction();
        try
        {
            Transaksi::create([
                'order_id' => 'LCRS-' . Str::random(6),
                'student_id' => Auth::guard('api')->user()->id,
                'kursus_id' => $kursus->id,
                'status' => 'success',
                'total_harga' => 0,
            ]);

            KursusMurid::firstOrCreate([
                'student_id' => Auth::guard('api')->user()->id,
                'kursus_id' => $kursus->id,
            ]);

            DB::commit();
            return ResponseFormatterController::success(null, 'Berhasil mendaftar kursus');
        }catch(Exception $e)
        {
            DB::rollBack();
            Log::error('Daftar error: ' . $e->getMessage());
            return ResponseFormatterController::error('Terjadi kesalahan saat mendaftar kursus', 500);
        }
    }

    /**
     * Validasi checkout/daftar untuk kursus
     * 
     * @param Kursus $kursus
     * @return bool true jika validasi berhasil, false jika gagal
     */
    private function checkoutValidation(Kursus $kursus)
    {
        $errors = [
            'admin' => 'Admin tidak bisa membeli course',
            'creator' => 'Anda tidak bisa membeli course yang anda buat sendiri',
            'registered' => 'Anda sudah terdaftar di course ini. Silahkan masuk ke dashboard untuk mempelajari course ini',
        ];
        
        $hasil = true;
        $errorMessage = '';
        
        // Periksa kondisi error
        if ($this->checkIsAdmin()) {
            $hasil = false;
            $errorMessage = $errors['admin'];
        } elseif ($this->checkIfCourseIsCreatedByUser($kursus)) {
            $hasil = false;
            $errorMessage = $errors['creator'];
        } elseif ($this->checkIsRegistered($kursus)) {
            $hasil = false;
            $errorMessage = $errors['registered'];
        }
        
        return [$hasil, $errorMessage];
    }

    private function checkIfCourseIsCreatedByUser($kursus)
    {
        return in_array(Auth::guard('api')->user()->id, $kursus->mentors()->pluck('id')->toArray());
    }

    private function checkIsRegistered($kursus)
    {
        return KursusMurid::whereKursusId($kursus->id)->whereStudentId(Auth::guard('api')->user()->id)->exists();
    }

    private function checkIsAdmin()
    {
        return Auth::guard('api')->user()->hasRole('super_admin');
    }
}
