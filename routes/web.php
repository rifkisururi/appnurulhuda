<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tagihan', [App\Http\Controllers\tagihanController::class, 'index'])->name('tagihan');
Route::POST('/tagihan', [App\Http\Controllers\tagihanController::class, 'store']);
Route::get('/tagihanAction', [App\Http\Controllers\tagihanController::class, 'action']);

Route::get('/nominal_tagihan/{id}', [App\Http\Controllers\tagihanController::class, 'nominal_tagihan'])->name('nominal_tagihan');

Route::get('/tagihanMaster', [App\Http\Controllers\tagihanMasterController::class, 'index'])->name('tagihan-master');
Route::POST('/tagihanMaster', [App\Http\Controllers\tagihanMasterController::class, 'store'])->name('tagihanMaster-post');

Route::get('/santri', [App\Http\Controllers\santriController::class, 'index'])->name('santri');
Route::POST('/santri', [App\Http\Controllers\santriController::class, 'store'])->name('santri-post');

Route::get('/laporanTahunan', [App\Http\Controllers\laporanController::class, 'perTahun'])->name('laporan');
