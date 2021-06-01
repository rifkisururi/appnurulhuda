<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function () {
    Artisan::call('migrate');
    Artisan::call('db:seed');
});

Route::get('/reset', function () {
    Artisan::call('migrate:reset');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tagihan', [App\Http\Controllers\tagihanController::class, 'index'])->name('tagihan');
Route::POST('/tagihan', [App\Http\Controllers\tagihanController::class, 'store']);
Route::get('/tagihanAction', [App\Http\Controllers\tagihanController::class, 'action']);
Route::get('/tagihanSantri', [App\Http\Controllers\tagihanController::class, 'vw_tagihanPerSantri']);


Route::get('/nominal_tagihan/{id}', [App\Http\Controllers\tagihanController::class, 'nominal_tagihan'])->name('nominal_tagihan');

Route::get('/tagihanMaster', [App\Http\Controllers\tagihanMasterController::class, 'index'])->name('tagihan-master');
Route::POST('/tagihanMaster', [App\Http\Controllers\tagihanMasterController::class, 'store'])->name('tagihanMaster-post');
Route::get('/tagihanMasterHapus/{id}', [App\Http\Controllers\tagihanMasterController::class, 'destroy']);

Route::get('/santri', [App\Http\Controllers\santriController::class, 'index'])->name('santri');
Route::POST('/santri', [App\Http\Controllers\santriController::class, 'store'])->name('santri-post');
Route::get('/user/ubahAkses/{id}', [App\Http\Controllers\santriController::class, 'ubahAkses']);
Route::put('/user/ubahAkses/{id}', [App\Http\Controllers\santriController::class, 'updateAkses']);

Route::get('/laporanTahunan', [App\Http\Controllers\laporanController::class, 'perTahun'])->name('laporan');
Route::get('/laporanTunggakan', [App\Http\Controllers\laporanController::class, 'rekapTunggakan'])->name('laporanTunggakan');

Route::get('/personalinfo', [App\Http\Controllers\santriController::class, 'personalInfo'])->name('personal-info');
Route::POST('/personalinfo', [App\Http\Controllers\santriController::class, 'personalInfoUpdate']);
