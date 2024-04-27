<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thesenp
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scanner', function () {
    return view('scanner');
});

Route::get('/beranda', [BerandaController::class, 'index']);


Route::get('/peminjaman', [TransaksiController::class, 'peminjaman']);
Route::get('/pengembalian', [TransaksiController::class, 'pengembalian']);
Route::get('/denda', [TransaksiController::class, 'denda']);
Route::get('/riwayat', [TransaksiController::class, 'riwayat']);
Route::post('/validasi', [TransaksiController::class, 'validasi'])->name('validasi');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.registrasi');
});

Route::get('/ganti_password', function () {
    return view('auth.gantiPassword');
});