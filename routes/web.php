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
Route::get('/tagihan', [App\Http\Controllers\tagihanController::class, 'index'])->name('tagihanIndex');

Route::get('/nominal_tagihan/{id}', [App\Http\Controllers\tagihanController::class, 'nominal_tagihan'])->name('nominal_tagihan');
