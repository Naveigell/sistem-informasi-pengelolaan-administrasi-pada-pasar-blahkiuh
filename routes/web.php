<?php

use App\Http\Controllers\Auth\PedagangLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\PedagangController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['register' => false]);



Route::get('/', [PedagangLoginController::class, 'showLoginForm'])->name('pedagang.loginform');
Route::post('/pedagang/login', [PedagangLoginController::class, 'login'])->name('pedagang.login');
Route::middleware(['auth:pedagang'])->group(function() {
    Route::get('/pedagang/dashboard', [HomeController::class, 'index']);
    Route::get('/pedagang/logout', [PedagangLoginController::class, 'logout'])->name('pedagang.logout');
    Route::get('/pedagang/pembayaran', [PembayaranController::class, 'index'])->name('pedagang.pembayaran.index');
    Route::get('/pedagang/pembayaran/create', [PembayaranController::class, 'create'])->name('pedagang.pembayaran.create');
    Route::post('/pedagang/pembayaran/store', [PembayaranController::class, 'store'])->name('pedagang.pembayaran.store');
    Route::get('/pedagang/pengeluaran', [PemasukanController::class, 'index'])->name('pedagang.pengeluaran');
    Route::resource('tagihans', \App\Http\Controllers\Pedagang\TagihanController::class);
});

Route::middleware(['auth'])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::name('tempats.')->prefix('tempats/{tempat}')->group(function () {
            Route::resource('kategori', \App\Http\Controllers\Admin\TempatKategoriController::class);
        });
        Route::prefix('kategori/{kategori}')->name('kategori.')->group(function () {
            Route::resource('pemasukan', \App\Http\Controllers\Admin\PemasukanController::class);
        });

        Route::resource('kategori', \App\Http\Controllers\Admin\KategoriController::class);
        Route::resource('tempats', \App\Http\Controllers\Admin\TempatController::class);
        Route::resource('tagihans', \App\Http\Controllers\Admin\TagihanController::class);
        Route::resource('pedagang', PedagangController::class);
        Route::resource('users', UserController::class);
        Route::resource('kwitansi', KwitansiController::class);
        Route::resource('pengeluaran', PengeluaranController::class);
        Route::resource('pembayaran', PembayaranController::class);

        Route::get('laporan/pemasukan', [PemasukanController::class, 'laporan'])->name('pemasukan.laporan');
        Route::get('cetak/pemasukan', [PemasukanController::class, 'cetak'])->name('pemasukan.cetak');
        Route::get('laporan/pengeluaran', [PengeluaranController::class, 'laporan'])->name('pengeluaran.laporan');
        Route::get('cetak/pengeluaran', [PengeluaranController::class, 'cetak'])->name('pengeluaran.cetak');
    });
});

