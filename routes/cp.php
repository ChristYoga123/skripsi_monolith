<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CP\Front\BlogController;
use App\Http\Controllers\CP\Front\HomeController;
use App\Http\Controllers\CP\Front\ProgramController;

Route::name('cp.')->group(function()
{
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    // Blog
    Route::prefix('blog')->name('blog.')->group(function()
    {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('show');
    });

    // Program
    Route::prefix('program')->name('program.')->group(function()
    {
        Route::get('/', [ProgramController::class, 'index'])->name('index');
        Route::get('/{program:slug}', [ProgramController::class, 'show'])->name('show');
    });
})
?>