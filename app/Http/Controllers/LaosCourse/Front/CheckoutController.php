<?php

namespace App\Http\Controllers\LaosCourse\Front;

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
use App\Enums\LaosCourse\Diskon\JenisEnum;
use App\Http\Controllers\Helpers\ResponseFormatterController;

class CheckoutController extends Controller
{
    public function __construct(
        private PaymentInterface $paymentService,
    )
    {}

    public function index(Kursus $kursus)
    {
        $kursus->load('flashSale')->loadCount(['bab', 'materi', 'mentors', 'students'])->loadAvg('reviews as reviews_avg', 'rating');
        
        // Common checkout validation
        [$hasil, $errorMessage] = $this->checkoutValidation($kursus);

        if(!$hasil)
        {
            return redirect()->route('course.kelas.show', $kursus->slug)->with('error', $errorMessage);
        }

        return view('pages.laos-course.front.checkout.index', [
            'title' => 'Checkout',
            'course' => $kursus,
        ]);
    }

    public function discountChecker(Request $request)
    {
        // jika kode diskon tidak ada
        if(!$request->input('kode'))
        {
            return ResponseFormatterController::error('Kode diskon tidak boleh kosong', 400);
        }

        $diskon = Diskon::whereKode($request->kode)->first();

        if(!$diskon)
        {
            return ResponseFormatterController::error('Kode diskon tidak ditemukan', 404);
        }

        if(!$diskon->isActive)
        {
            return ResponseFormatterController::error('Kode diskon tidak valid', 400);
        }
        
        // Jika semua pengecekan berhasil, kembalikan data diskon
        return ResponseFormatterController::success($diskon, 'Kode diskon berhasil ditemukan');
    }

    // Kursus Premium
    public function checkout(Request $request, Kursus $kursus)
    {
        $request->validate([
            'kode' => 'nullable|string|exists:diskons,kode',
        ], [
            'kode.string' => 'Kode diskon harus berupa teks',
            'kode.exists' => 'Kode diskon tidak ditemukan',
        ]);
        
        $harga = $kursus->flashSale ? $kursus->harga * (1 - $kursus->flashSale->persentase / 100) : $kursus->harga;
        
        // cek diskon
        $diskon = null;
        if(!$kursus->flashSale)
        {
            if($request->kode)
            {
                $diskon = Diskon::whereKode($request->kode)->first();
                if(!$diskon->isActive)
                {
                    return ResponseFormatterController::error('Kode diskon tidak valid', 400);
                }
            }
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
            $transaksi = Transaksi::updateOrCreate([
                'student_id' => Auth::user()->id,
                'kursus_id' => $kursus->id,
            ], [
                'status' => 'pending',
                'order_id' => 'LCRS-' . Str::random(6),
                'diskon_kode' => $diskon ? $diskon->kode : null,
                'total_harga' => $diskon ? $harga - ($harga * $diskon->persentase / 100) + 5000 : $harga + 5000,
            ]);

            $snapToken = $this->paymentService->pay($transaksi);

            DB::commit();
            return ResponseFormatterController::success([
                'snap_token' => $snapToken,
            ], 'Berhasil melakukan checkout');
        }catch(Exception $e)
        {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return ResponseFormatterController::error('Terjadi kesalahan saat memproses transaksi', 500);
        }
    }

    // Kursus Gratis
    public function daftar(Kursus $kursus)
    {
        // Validasi checkout
        [$hasil, $errorMessage] = $this->checkoutValidation($kursus);
        if(!$hasil)
        {
            return redirect()->back()->with('error', $errorMessage);
        }

        DB::beginTransaction();
        try
        {
            Transaksi::create([
                'order_id' => 'LCRS-' . Str::random(6),
                'student_id' => Auth::user()->id,
                'kursus_id' => $kursus->id,
                'status' => 'success',
                'total_harga' => 0,
            ]);

            KursusMurid::firstOrCreate([
                'student_id' => Auth::user()->id,
                'kursus_id' => $kursus->id,
            ]);

            DB::commit();
            return redirect()->route('course.dashboard.my-courses.show', $kursus->slug);
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
        return in_array(Auth::user()->id, $kursus->mentors()->pluck('id')->toArray());
    }

    private function checkIsRegistered($kursus)
    {
        return KursusMurid::whereKursusId($kursus->id)->whereStudentId(Auth::user()->id)->exists();
    }

    private function checkIsAdmin()
    {
        return Auth::user()->hasRole('super_admin');
    }
}
