<?php

use App\Http\Controllers\Auth\PedagangLoginController;
use App\Http\Controllers\HomeController;
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
Route::middleware(['auth:pedagang'])->prefix('pedagang')
                                    ->name('pedagang.')
                                    ->group(function() {

    Route::get('/dashboard', [\App\Http\Controllers\Pedagang\HomeController::class, 'index'])->name('dashboard');
    Route::get('/logout', [PedagangLoginController::class, 'logout'])->name('logout');
    Route::get('/pembayaran', [\App\Http\Controllers\Pedagang\PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create', [\App\Http\Controllers\Pedagang\PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran/store', [\App\Http\Controllers\Pedagang\PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pengeluaran', [\App\Http\Controllers\Pedagang\PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::resource('tagihans', \App\Http\Controllers\Pedagang\TagihanController::class);
    Route::post('biodata/password', [\App\Http\Controllers\Pedagang\BiodataController::class, 'password'])->name('biodata.password');
    Route::resource('biodata', \App\Http\Controllers\Pedagang\BiodataController::class);
});

Route::middleware(['auth'])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');

        Route::prefix('tempats/{tempat}')->name('tempats.')->group(function () {
            Route::resource('kategori', \App\Http\Controllers\Admin\TempatKategoriController::class);
        });
        Route::prefix('kategori/{kategori}')->name('kategori.')->group(function () {
            Route::resource('pemasukan', \App\Http\Controllers\Admin\PemasukanController::class);
        });

        Route::resource('kategori', \App\Http\Controllers\Admin\KategoriController::class);
        Route::resource('tempats', \App\Http\Controllers\Admin\TempatController::class);
        Route::resource('tagihans', \App\Http\Controllers\Admin\TagihanController::class);
        Route::resource('pedagang', \App\Http\Controllers\Admin\PedagangController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('kwitansi', \App\Http\Controllers\Admin\KwitansiController::class);
        Route::resource('pengeluaran', \App\Http\Controllers\Admin\PengeluaranController::class);
        Route::resource('pembayaran', \App\Http\Controllers\Admin\PembayaranController::class);
        Route::post('biodata/password', [\App\Http\Controllers\Admin\BiodataController::class, 'password'])->name('biodata.password');
        Route::resource('biodata', \App\Http\Controllers\Admin\BiodataController::class);

        Route::get('laporan/pemasukan', [\App\Http\Controllers\Admin\PemasukanController::class, 'laporan'])->name('pemasukan.laporan');
        Route::get('cetak/pemasukan', [\App\Http\Controllers\Admin\PemasukanController::class, 'cetak'])->name('pemasukan.cetak');
        Route::get('laporan/pengeluaran', [\App\Http\Controllers\Admin\PengeluaranController::class, 'laporan'])->name('pengeluaran.laporan');
        Route::get('cetak/pengeluaran', [\App\Http\Controllers\Admin\PengeluaranController::class, 'cetak'])->name('pengeluaran.cetak');
    });
});

