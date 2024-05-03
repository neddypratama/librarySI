<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\LevelModel;
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

Route::get('/scan', function () {
    return view('scan');
});
Route::get('/validasi/{kode}', [BerandaController::class, 'validasi']);

Route::group(['prefix' => 'action', 'middleware' => ['ceklevel:2']], function() {
    Route::get('/denda', [ActionController::class, 'denda']);
    Route::post('/listDenda', [ActionController::class, 'listDenda']);
    Route::get('/riwayat', [ActionController::class, 'riwayat']);
    Route::post('/listRiwayat', [ActionController::class, 'listRiwayat']);
    Route::get('/peminjaman', [ActionController::class, 'peminjaman']);
    Route::get('/validasi/{kode}', [ActionController::class, 'validasi']);
    Route::post('/store', [ActionController::class, 'store']);
    Route::get('/pengembalian', [ActionController::class, 'pengembalian']);
    Route::post('/listPengembalian', [ActionController::class, 'listPengembalian']);
    Route::get('/{id}/scan_kembali', [ActionController::class, 'scan_kembali']);
    Route::get('/kembali/{id}/{kode}', [ActionController::class, 'kembali']); 
});

Route::group(['prefix' => 'user', 'middleware' => ['ceklevel:1']], function() {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'level', 'middleware' => ['ceklevel:1']], function() {
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/list', [LevelController::class, 'list']);
    Route::get('/create', [LevelController::class, 'create']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::get('/{id}/edit', [LevelController::class, 'edit']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
});

Route::group(['prefix' => 'buku', 'middleware' => ['ceklevel:1']], function() {
    Route::get('/', [BukuController::class, 'index']);
    Route::post('/list', [BukuController::class, 'list']);
    Route::get('/create', [BukuController::class, 'create']);
    Route::post('/', [BukuController::class, 'store']);
    Route::get('/{id}', [BukuController::class, 'show']);
    Route::get('/{id}/edit', [BukuController::class, 'edit']);
    Route::put('/{id}', [BukuController::class, 'update']);
    Route::delete('/{id}', [BukuController::class, 'destroy']);
    Route::get('/{id}/barcode', [BukuController::class, 'barcode']);
});

Route::group(['prefix' => 'transaksi', 'middleware' => ['ceklevel:1']], function() {
    Route::get('/', [TransaksiController::class, 'index']);
    Route::post('/list', [TransaksiController::class, 'list']);
    Route::get('/create', [TransaksiController::class, 'create']);
    Route::post('/', [TransaksiController::class, 'store']);
    Route::get('/{id}', [TransaksiController::class, 'show']);
    Route::get('/{id}/edit', [TransaksiController::class, 'edit']);
    Route::put('/{id}', [TransaksiController::class, 'update']);
    Route::delete('/{id}', [TransaksiController::class, 'destroy']);
});


Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/proses_register', [AuthController::class, 'register_proses'])->name('proses_register');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('proses_login', [AuthController::class, 'login_proses'])->name('proses_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/ganti_password', [AuthController::class, 'gantiPassword'])->name('ganti_password');
Route::put('/proses_ganti', [AuthController::class, 'proses_ganti'])->name('proses_ganti');
Route::get('/lupa_password', [AuthController::class, 'lupaPassword'])->name('lupa_password');
Route::get('/proses_lupa', [AuthController::class, 'proses_lupa'])->name('proses_lupa');

Route::group(['middleware' => ['ceklevel:1,2']], function() {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
});