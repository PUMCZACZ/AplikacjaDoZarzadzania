<?php

use App\Domains\Order\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::post('/orders', [OrderController::class, 'getOrders'])->name('get.orders');
    Route::get('/data', [\App\Domains\Dashboard\Controllers\Api\DashboardController::class, 'data'])->name('get.data');
});

