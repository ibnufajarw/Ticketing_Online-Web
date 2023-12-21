<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisTiketController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// landing page
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::get('/{code}/pembayaran', [LandingPageController::class, 'midtrans'])->name('landing-page.midtrans');
Route::get('success', [LandingPageController::class, 'successPage'])->name('landing-page.success');

// acara
Route::get('get-keuntungan-tiket', [AcaraController::class, 'getKeuntunganTiket'])->name('landing-page.acara.get_keuntungan_tiket');
Route::post('beli-tiket', [AcaraController::class, 'beliTiket'])->name('landing-page.acara.beli_tiket');
Route::get('{kodeTransaksi}/pembayaran', [AcaraController::class, 'lanjut'])->name('landing-page.acara.lanjutkan_pembayaran');
Route::group(['prefix' => 'acara'], function () {
    Route::get('/{slug}', [AcaraController::class, 'landingPageShow'])->name('landing-page.acara.show');
    Route::get('/{slug}/{jenisTiketId}/detail-tiket', [AcaraController::class, 'detailTiket'])->name('landing-page.acara.detail_tiket');
});

// kategori
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'landingPageIndex'])->name('landing-page.kategori.index');
});

// auth
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::post('/logout', [AuthController::class, 'doLogout'])->name('logout');
Route::group(['prefix' => 'register'], function () {
    Route::get('/', [AuthController::class, 'getRegister'])->name('register');
    Route::get('/reset', [AuthController::class, 'reset'])->name('reset');
    Route::post('/reset_password', [AuthController::class, 'reset_password'])->name('reset_password');
    Route::get('/reset-password-last/{token}/{email}', [AuthController::class, 'reset_password_last'])->name('reset_password_last');
    Route::put('/reset-password-save', [AuthController::class, 'reset_password_save'])->name('reset_password_save');

    Route::post('/', [AuthController::class, 'doRegister']);
    Route::get('/verifikasi/{token}', [AuthController::class, 'doVerifikasi']);
});

// dashboard
Route::middleware(['auth', 'CheckDeletedUser'])->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        // pages
        Route::get('/', [DashboardController::class, 'getIndex'])->name('dashboard.index');

        // kategori
        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/datatable-json', [KategoriController::class, 'datatableJson'])->name('dashboard.kategori.datatable-json');
        });
        Route::resource('kategori', KategoriController::class, ['as' => 'dashboard'])->except('show');

        // slider
        Route::group(['prefix' => 'slider'], function () {
            Route::get('/datatable-json', [SliderController::class, 'datatableJson'])->name('dashboard.slider.datatable-json');
        });
        Route::resource('slider', SliderController::class, ['as' => 'dashboard'])->except('show');

        // lokasi
        Route::group(['prefix' => 'lokasi'], function () {
            Route::get('/datatable-json', [LokasiController::class, 'datatableJson'])->name('dashboard.lokasi.datatable-json');
        });
        Route::resource('lokasi', LokasiController::class, ['as' => 'dashboard'])->except('show');

        // kampus
        Route::group(['prefix' => 'kampus'], function () {
            Route::get('/datatable-json', [KampusController::class, 'datatableJson'])->name('dashboard.kampus.datatable-json');
        });
        Route::resource('kampus', KampusController::class, ['as' => 'dashboard'])->except('show')->parameters(['kampus' => 'kampus']);

        // metode pembayaran
        Route::group(['prefix' => 'metode-pembayaran'], function () {
            Route::get('/datatable-json', [MetodePembayaranController::class, 'datatableJson'])->name('dashboard.metode-pembayaran.datatable-json');
        });
        Route::resource('metode-pembayaran', MetodePembayaranController::class, ['as' => 'dashboard'])->except('show');

        // user
        Route::group(['prefix' => 'user'], function () {
            Route::get('/datatable-json', [UsersController::class, 'datatableJson'])->name('dashboard.user.datatable-json');
        });
        Route::put('reset', [UsersController::class, 'reset'])->name('dashboard.user.reset');
        Route::delete('delete', [UsersController::class, 'delete'])->name('dashboard.user.delete');
        Route::resource('user', UsersController::class, ['as' => 'dashboard'])->only(['index', 'destroy']);

        // acara
        Route::name('transaksi.')->group(function () {
            Route::get('transaksi', [TransaksiController::class, 'index'])->name('index');
            Route::get('{kode_transaksi}/detail-transaksi', [TransaksiController::class, 'detail'])->name('detail');
            Route::get('{kode_transaksi}/invoice', [TransaksiController::class, 'invoice'])->name('invoice');
            Route::put('confirm', [TransaksiController::class, 'confirm'])->name('confirm');
            Route::put('upload-bukti-transfer', [TransaksiController::class, 'uploadReceipt'])->name('upload_receipt');
        });
        Route::name('pembelian.')->group(function () {
            Route::get('pembelian', [TransaksiController::class, 'pembelianIndex'])->name('index');
        });
        Route::group(['prefix' => 'acara'], function () {
            Route::put('/confirm', [AcaraController::class, 'confirm'])->name('dashboard.acara.confirm');
            Route::get('/datatable-json', [AcaraController::class, 'datatableJson'])->name('dashboard.acara.datatable-json');

            Route::get('/{acara}/jenis-tiket', [JenisTiketController::class, 'index'])->name('dashboard.jenis-tiket.index');
            Route::post('/{acara}/jenis-tiket', [JenisTiketController::class, 'store'])->name('dashboard.jenis-tiket.store');
            Route::delete('/{acara}/jenis-tiket', [JenisTiketController::class, 'delete'])->name('dashboard.jenis-tiket.delete');

            Route::get('/{acara}/tiket/datatable-json', [TiketController::class, 'datatableJson'])->name('dashboard.tiket.datatable-json');
            Route::post('/{acara}/tiket', [TiketController::class, 'store'])->name('dashboard.tiket.store');
            Route::post('store-profit-of-tiket', [TiketController::class, 'storeProfit'])->name('dashboard.tiket.storeProfit');
            Route::get('get-profit-of-tiket', [TiketController::class, 'getProfit'])->name('dashboard.tiket.getProfit');
            Route::delete('delete-profit-of-tiket', [TiketController::class, 'deleteProfit'])->name('dashboard.tiket.deleteProfit');
            Route::delete('/tiket/{tiket}', [TiketController::class, 'destroy'])->name('dashboard.tiket.destroy');
        });
        Route::resource('acara', AcaraController::class, ['as' => 'dashboard'])->except('show');
    });

    Route::name('profile.')->prefix('profile')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::put('update-account', [ProfileController::class, 'update_account'])->name('update_account');
        Route::put('update-password', [ProfileController::class, 'update_password'])->name('update_password');
    });
});
