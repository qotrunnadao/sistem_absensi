<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LiburController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // route untuk user
    Route::resource('user', UserController::class);
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('curl', [UserController::class, 'curl']);
    Route::get('user/fotomaster/{id}', [UserController::class, 'fotomaster'])->name('user.fotomaster');
    Route::post('user/simpanfoto', [UserController::class, 'simpanfoto'])->name('user.simpanfoto');

    // route untuk Absensi
    Route::get('absensi', [AbsensiController::class, 'index']);
    Route::get('absensi/data', [AbsensiController::class, 'data_json'])->name('absensi.data');
    Route::get('absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('absensi/edit/{id}', [AbsensiController::class, 'edit']);
    Route::put('absensi/update/{id}', [AbsensiController::class, 'update']);
    Route::get('absensi/delete/{id}', [AbsensiController::class, 'delete'])->name('absensi.delete');
    Route::get('absensi/cari', [AbsensiController::class, 'cari']);
    Route::get('absensi/show/{id}', [AbsensiController::class, 'show'])->name('absensi.show');
    Route::get('absensi/kamera', [AbsensiController::class, 'kamera']);
    Route::get('/formcetak', [AbsensiController::class, 'cetak'])->name('cetak');
    Route::get('/cetakabsensi/{dari}/{sampai}', [AbsensiController::class, 'cetakabsensi'])->name('cetakabsensi');
    Route::get('/absensi/verifikasi', [AbsensiController::class, 'verifikasi']);
    // Route::get('/cetakuser/{id}', [AbsensiController::class, 'cetakuser'])->name('cetakuser');
    // Route::get('/laporan', [AbsensiController::class, 'laporan']);




    // route untuk Izin
    Route::post('izin/store', [IzinController::class, 'store']);
    Route::get('izin/delete/{id}', [IzinController::class, 'destroy'])->name('izin.destroy');
    Route::get('izin/diterima/{izin}', [IzinController::class, 'diterima'])->name('izin.diterima');
    Route::get('izin/ditolak/{izin}', [IzinController::class, 'ditolak'])->name('izin.ditolak');
    Route::resource('izin', IzinController::class);


    //route untuk libur
    Route::get('libur', [LiburController::class, 'index']);
    Route::get('libur/data', [LiburController::class, 'data_json'])->name('libur.data');
    Route::get('libur/create', [LiburController::class, 'create']);
    Route::post('libur/store', [LiburController::class, 'store']);
    Route::get('libur/edit/{id}', [LiburController::class, 'edit'])->name('libur.edit');
    Route::put('libur/update/{id}', [LiburController::class, 'update'])->name('libur.update');
    Route::get('libur/delete/{id}', [LiburController::class, 'delete'])->name('libur.destroy');
    Route::get('libur/cari', [LiburController::class, 'cari']);
    Route::get('libur/show/{id}', [LiburController::class, 'show'])->name('libur.show');
});



require __DIR__ . '/auth.php';
