<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\BarangLabController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanMahasiswa;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mahasiswa/register', function () {
    return view('mahasiswa.register');
});
Route::post('/mahasiswa/register', [AuthController::class, 'registerMahasiswa'])->name('mahasiswa.registerAkun');
Route::middleware(['auth'])->group(function () {
    Route::middleware('role:mahasiswa')->group(function () {
        // Rute-rute yang hanya dapat diakses oleh dosen
        Route::get('/dashboard/mahasiswa/profile', [MahasiswaController::class, 'showFormProfile'])->name('mahasiswa.profile');
        Route::post('/mahasiswa/register-profile', [MahasiswaController::class, 'registerProfile'])->name('mahasiswa.register');
        Route::get('/dashboard/mahasiswa/history', [MahasiswaController::class, 'historyMahasiswa'])->name('mahasiswa.history');
        Route::get('/tracking/{id}', [PeminjamanMahasiswa::class, 'trackingMahasiswa'])->name('tracking.mahasiswa');
        // Route untuk menampilkan halaman pengajuan
        Route::get('/dasboard/mahasiswa/form-pengajuan', [PeminjamanMahasiswa::class, 'showFormPengajuan'])->name('form.pengajuan');
        Route::post('/store-pengajuan-mahasiswa', [PeminjamanMahasiswa::class, 'storePengajuan'])->name('store.pengajuan-mahasiswa');
        
        // Tambahkan rute-rute lain untuk dosen jika diperlukan
    });
    Route::middleware('role:teknisi_lab')->group(function () {
        // Rute-rute yang hanya dapat diakses oleh teknisi lab
        Route::get('/dashboard/teknisi/barang', [BarangLabController::class, 'index'])->name('barang.index');
        Route::get('/dashboard/teknisi/pengajuan-mahasiswa', [TeknisiController::class, 'dashboardPengajuan'])->name('teknisi.pengajuanMahasiswa');
        Route::get('/barang/create', [BarangLabController::class, 'create'])->name('barang.create');
        Route::post('/barang', [BarangLabController::class, 'store'])->name('barang.store');
        Route::get('/barang/{barang}/edit', [BarangLabController::class, 'edit'])->name('barang.edit');
        Route::put('/barang/{barang}', [BarangLabController::class, 'update'])->name('barang.update');
        Route::delete('/barang/{barang}', [BarangLabController::class, 'destroy'])->name('barang.destroy');
        Route::resource('/dashboard/kategori', KategoriController::class)->except('show');
        Route::post('/setuju-teknisi/{id}', [PeminjamanMahasiswa::class, 'setujuTeknisi'])->name('setuju.teknisi');
        Route::post('/reject/teknisi/{id}', [PeminjamanMahasiswa::class, 'reject'])->name('reject.teknisi');


    });
    Route::middleware('role:dosen')->group(function () {
        Route::post('/dosen/register', [DosenController::class, 'registerProfile'])->name('dosen.registerProfile');
        Route::get('/dashboard/dosen/register', [DosenController::class, 'ShowFormProfile'])->name('dosen.register');
        Route::get('/dashboard/dosen/dashboard-pengajuan', [DosenController::class, 'dashboardPengajuan'])->name('dosen.dashboardPengajuan');
        Route::post('/setuju-dosen/{id}', [PeminjamanMahasiswa::class, 'setujuDosen'])->name('setuju.dosen');
        Route::post('/reject/dosen/{id}', [PeminjamanMahasiswa::class, 'reject'])->name('reject.dosen');
    });
    
    Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/dashboard/dosen', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('/dashboard/teknisi', [TeknisiController::class, 'dashboard'])->name('teknisi_lab.dashboard');
    Route::get('/dashboard/kepala_lab', [KepalaController::class, 'dashboard'])->name('kepala_lab.dashboard');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
