<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\TransaksiController;

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

// kampus
Route::group(['prefix' => 'kampus'], function() {
    Route::get('/{kampus}', [KampusController::class, 'getApiDetail'])->name('dashboard.api.kampus.show');
});
Route::post('/midtrans-callback', [TransaksiController::class, 'callback']);