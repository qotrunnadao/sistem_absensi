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

    Route::resource('user', UserController::class);
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');



    // route untuk Absensi
    Route::get('absensi', [AbsensiController::class, 'index']);
    Route::get('absensi/data', [AbsensiController::class, 'data_json'])->name('absensi.data');
    Route::get('absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('absensi/edit/{id}', [AbsensiController::class, 'edit']);
    Route::put('absensi/update/{id}', [AbsensiController::class, 'update']);
    Route::get('absensi/delete/{id}', [AbsensiController::class, 'delete']);
    Route::get('absensi/cari', [AbsensiController::class, 'cari']);
    Route::get('absensi/show/{id}', [AbsensiController::class, 'show']);
    Route::get('absensi/kamera', function () {
        return view('absensi.kamera');
    });
    Route::get('/formcetak', [AbsensiController::class, 'cetak'])->name('cetak');
    Route::get('/cetakabsensi/{dari}/{sampai}', [AbsensiController::class, 'cetakabsensi'])->name('cetakabsensi');
    Route::get('absensi/pulang', [AbsensiController::class, 'pulang'])->name('absensi.pulang');



    // route untuk Izin

    // Route::get('izin', [IzinController::class, 'index']);
    // Route::get('izin/data', [IzinController::class, 'data_json'])->name('izin.data');
    // Route::get('izin/create', [IzinController::class, 'create']);
    Route::post('izin/store', [IzinController::class, 'store']);
    // Route::get('izin/edit', [IzinController::class, 'edit']);
    // Route::put('izin/update', [IzinController::class, 'update']);
    Route::get('izin/delete', [IzinController::class, 'destroy']);
    Route::get('izin/diterima', [IzinController::class, 'diterima'])->name('izin.diterima');
    Route::get('izin/ditolak', [IzinController::class, 'ditolak'])->name('izin.ditolak');
    // Route::get('izin/cari', [IzinController::class, 'cari']);
    // Route::get('izin/show/{id}', [IzinController::class, 'show']);
    Route::resource('izin', IzinController::class);


    //route untuk tabel libur


    Route::get('libur', [LiburController::class, 'index']);
    Route::get('libur/data', [LiburController::class, 'data_json'])->name('libur.data');
    Route::get('libur/create', [LiburController::class, 'create']);
    Route::post('libur/store', [LiburController::class, 'store']);
    Route::get('libur/edit/{id}', [LiburController::class, 'edit']);
    Route::put('libur/update/{id}', [LiburController::class, 'update']);
    Route::get('libur/delete/{id}', [LiburController::class, 'delete']);
    Route::get('libur/cari', [LiburController::class, 'cari']);
    Route::get('libur/show/{id}', [LiburController::class, 'show']);
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';
