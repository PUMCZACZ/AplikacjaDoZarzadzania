<?php

use App\Domains\Client\Controllers\ClientController;
use App\Domains\Order\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/', [ClientController::class, 'store'])->name('store');
        Route::get('/{client}', [ClientController::class, 'edit'])->name('edit');
        Route::post('/{client}', [ClientController::class, 'update'])->name('update');
        Route::get('/{client}/show', [ClientController::class, 'show'])->name('show');
        Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [OrderController::class, 'edit'])->name('edit');
        Route::post('/{order}', [OrderController::class, 'update'])->name('update');
        Route::get('/{order}/show', [OrderController::class, 'show'])->name('show');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });
});



require __DIR__.'/auth.php';
