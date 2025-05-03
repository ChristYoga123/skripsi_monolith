<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaosCourse\Front\AuthController;
use App\Http\Controllers\LaosCourse\Front\HomeController;
use App\Http\Controllers\LaosCourse\Front\KelasController;
use App\Http\Controllers\LaosCourse\Back\MyOrderController;
use App\Http\Controllers\LaosCourse\Back\MyCourseController;
use App\Http\Controllers\LaosCourse\Front\CheckoutController;
use App\Http\Controllers\LaosCourse\Back\HomeController as BackHomeController;
use App\Http\Controllers\LaosCourse\Back\SettingController;

Route::prefix('course')->name('course.')->group(function()
{
    /** Guest */
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // Kelas
    Route::prefix('kelas')->name('kelas.')->group(function()
    {
        Route::get('/', [KelasController::class, 'index'])->name('index');
        Route::get('/filter', [KelasController::class, 'filter'])->name('filter');
        Route::get('/search', [KelasController::class, 'search'])->name('search');
        Route::get('/{kursus:slug}', [KelasController::class, 'show'])->name('show');
    });

    // Auth
    Route::name('auth.')->group(function()
    {
        Route::middleware('guest')->group(function()
        {
            Route::get('login', [AuthController::class, 'loginIndex'])->name('login');
            Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
            Route::get('register', [AuthController::class, 'registerIndex'])->name('register');
            Route::post('register', [AuthController::class, 'register'])->name('create-account');
        });

        Route::middleware('auth')->group(function()
        {
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        });
    });

    /** Auth */
    Route::middleware('auth')->group(function()
    {
        // Checkout
        Route::prefix('checkout')->name('checkout.')->group(function()
        {
            Route::get('/diskon-check', [CheckoutController::class, 'discountChecker'])->name('diskon-check');
            Route::get('/{kursus:slug}', [CheckoutController::class, 'index'])->name('index');
            Route::post('/{kursus:slug}', [CheckoutController::class, 'checkout'])->name('beli');
            Route::post('/{kursus:slug}/daftar', [CheckoutController::class, 'daftar'])->name('daftar');
        });

        Route::prefix('dashboard')->name('dashboard.')->group(function()
        {
            // Dashboard
            Route::get('/', [BackHomeController::class, 'index'])->name('index');

            // My Course
            Route::prefix('my-courses')->name('my-courses.')->group(function()
            {
                Route::get('/', [MyCourseController::class, 'index'])->name('index');
                Route::get('/search', [MyCourseController::class, 'search'])->name('search');
                Route::get('/{kursus:slug}/learn', [MyCourseController::class, 'show'])->name('show');
                Route::get('/{kursus:slug}/watch/{kursusBabMateri}', [MyCourseController::class, 'watch'])->name('watch');
                Route::put('/{kursus:slug}/testimoni', [MyCourseController::class, 'createTestimoni'])->name('testimoni.create');
            });

            // My Order
            Route::get('my-orders', [MyOrderController::class, 'index'])->name('my-orders.index');

            // Setting
            Route::prefix('setting')->name('setting.')->group(function()
            {
                Route::get('/', [SettingController::class, 'index'])->name('index');
                Route::put('/', [SettingController::class, 'update'])->name('update');
            });
        });
    });

    
});
?>