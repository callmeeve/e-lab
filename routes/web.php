<?php

use App\Http\Controllers\barang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


Route::get('/', function () {
    return view('mahasiswa.login');
});
Route::resource('barang', barang::class);
Route::post('register-mahasiswa', [AuthController::class, 'registerMahasiswa']);