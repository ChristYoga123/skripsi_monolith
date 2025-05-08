<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Service\MidtransPaymentService;
use App\Http\Controllers\LaosCourse\API\AuthController;
use App\Http\Controllers\LaosCourse\API\KelasController;
use App\Http\Controllers\LaosCourse\API\OrderController;
use App\Http\Controllers\LaosCourse\API\MyOrderController;
use App\Http\Controllers\LaosCourse\API\CheckoutController;
use App\Http\Controllers\LaosCourse\API\MyCourseController;
use App\Http\Controllers\LaosCourse\API\TransactionController;

Route::post('payment-callback', [MidtransPaymentService::class, 'midtransCallback']);
Route::prefix('course')->group(function()
{
    // Guest Middleware
    Route::middleware('guest.api')->group(function()
    {
        // Auth Routes
        Route::prefix('auth')->group(function()
        {
            Route::post('register', [AuthController::class, 'register']);
            Route::post('login', [AuthController::class, 'login']);        
        });

        // Kelas Routes
        Route::prefix('kelas')->group(function()
        {
            Route::get('/', [KelasController::class, 'index']);
            Route::get('/filter', [KelasController::class, 'filter']);
            Route::get('/search', [KelasController::class, 'search']);
            Route::get('/{slug}', [KelasController::class, 'show']);
        });

        // Order Routes
        Route::get('/dashboard/orders', [OrderController::class, 'index']);
    });

    // Auth Middleware
    Route::middleware('auth.api')->group(function()
    {
        // Auth Routes
        Route::prefix('auth')->group(function()
        {
            Route::get('me', [AuthController::class, 'me']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
        });

        // Checkout Routes
        Route::prefix('checkout')->group(function()
        {
            Route::get('/diskon-check', [TransactionController::class, 'discountChecker']);
            Route::get('/{slug}', [TransactionController::class, 'index']);
            Route::post('/{slug}/beli', [TransactionController::class, 'checkout']);
            Route::post('/{slug}/daftar', [TransactionController::class, 'daftar']);
        });

        // Dashboard
        Route::prefix('dashboard')->group(function()
        {
            // My Courses
            Route::prefix('my-courses')->group(function()
            {
                Route::get('/', [MyCourseController::class, 'index']);
                Route::get('/search', [MyCourseController::class, 'search']);
                Route::get('/{slug}', [MyCourseController::class, 'show']);
                Route::get('/{slug}/watch/{kursusBabMateri}', [MyCourseController::class, 'watch'])->name('api.course.dashboard.my-courses.watch');
                Route::post('/{slug}/testimoni', [MyCourseController::class, 'createTestimoni']);
            });

            // My Orders
            Route::get('my-orders', [MyOrderController::class, 'index']);
        });
    });
});

