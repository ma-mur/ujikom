<?php

use Illuminate\Support\Facades\Route;

// Adm Controller
use App\Http\Controllers\Adm\InformasiController;
use App\Http\Controllers\Adm\KompetensiController;
use App\Http\Controllers\Adm\JadwalController;
use App\Http\Controllers\Adm\PesertaController;
use App\Http\Controllers\Adm\HasilController;
use App\Http\Controllers\Adm\LaporanController;
use App\Http\Controllers\Adm\PembayaranController;
use App\Http\Controllers\Adm\AsesorController;

// Peserta Controller
use App\Http\Controllers\Peserta\HomeController;

// Controller
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;

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


// ============= depan =============
Route::get('/', [IndexController::class, 'index']);

Route::get('/masuk', [LoginController::class, 'index'])->middleware('guest:peserta','guest:admin')->name('login');
Route::post('/masuk', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

// Daftar
Route::get('/daftar', [DaftarController::class,'index']);
Route::post('/daftar/store', [DaftarController::class,'store']);
Route::get('/sukses', function(){
	return view('sukses');
});



// ============= peserta =============
// Home
Route::get('/home/{status}', [HomeController::class, 'index'])->middleware('auth:peserta');
Route::post('/home', [HomeController::class, 'bayar'])->middleware('auth:peserta');
Route::get('/bukti', [HomeController::class, 'bukti'])->middleware('auth:peserta');

// Jadwal
Route::get('/jadwal', [HomeController::class, 'jadwal'])->middleware('auth:peserta');

// Pembayaran
Route::get('/pembayaran', [HomeController::class, 'pembayaran'])->middleware('auth:peserta');

// hasil
Route::get('/hasil', [HomeController::class, 'hasil'])->middleware('auth:peserta');

// Profile
Route::get('/profile', [HomeController::class, 'profile'])->middleware('auth:peserta');
Route::put('/profile', [HomeController::class, 'ubahPass'])->middleware('auth:peserta');



// ============= adm =============
Route::get('/adm/admin', [AsesorController::class, 'admin'])->middleware('auth:admin');
Route::post('/adm/admin', [AsesorController::class, 'add'])->middleware('auth:admin');
Route::delete('/adm/admin/{id}', [AsesorController::class, 'delete'])->middleware('auth:admin');

// Asesor
Route::get('/adm/asesor', [AsesorController::class, 'index'])->middleware('auth:admin');
Route::post('/adm/asesor', [AsesorController::class, 'store'])->middleware('auth:admin');
Route::delete('/adm/asesor/{id}', [AsesorController::class, 'destroy'])->middleware('auth:admin');
Route::put('/adm/asesor/aktif/{id}', [AsesorController::class,'status_aktif'])->middleware('auth:admin');
Route::put('/adm/asesor/nonaktif/{id}', [AsesorController::class,'status_nonaktif'])->middleware('auth:admin');

// Hasil
Route::get('/adm/hasil', [HasilController::class,'index'])->middleware('auth:admin');
Route::post('/adm/hasil', [HasilController::class,'saveNilai'])->middleware('auth:admin');
Route::get('/adm/hasil/{id}', [HasilController::class,'nilai'])->middleware('auth:admin');
Route::post('/adm/hasil/cetak', [HasilController::class,'cetak'])->middleware('auth:admin');

// Informasi
Route::get('/adm/informasi', [InformasiController::class,'index'])->middleware('auth:admin');
Route::get('/adm/informasi/{id}', [InformasiController::class,'update'])->middleware('auth:admin');

// Jadwal
Route::resource('/adm/jadwal', JadwalController::class)->middleware('auth:admin');

// Laporan
Route::get('/adm/laporan', [LaporanController::class, 'index'])->middleware('auth:admin');
Route::post('/adm/laporan', [LaporanController::class, 'index'])->middleware('auth:admin');
Route::post('/adm/laporan/pdf', [LaporanController::class, 'pdf'])->middleware('auth:admin');

// Pembayaran
Route::get('/adm/pembayaran/{status}', [PembayaranController::class, 'index'])->middleware('auth:admin');
Route::put('/adm/pembayaran/konfirmasi/{status}', [PembayaranController::class, 'konfirmasi'])->middleware('auth:admin');
Route::get('/adm/pembayaran/bukti/{id}', [PembayaranController::class, 'bukti'])->middleware('auth:admin');

// Peserta / Pendaftar
Route::resource('/adm/peserta', PesertaController::class)->middleware('auth:admin');

// Skema Kompeteni
Route::resource('/adm/skema', KompetensiController::class)->middleware('auth:admin');
Route::put('/adm/skema/aktif/{id}', [KompetensiController::class,'status_aktif'])->middleware('auth:admin');
Route::put('/adm/skema/nonaktif/{id}', [KompetensiController::class,'status_nonaktif'])->middleware('auth:admin');
