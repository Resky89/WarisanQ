<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MawarisController;

Route::get('/', [MawarisController::class, 'index'])->name('home');
Route::get('/hukum-mawaris', [MawarisController::class, 'hukum'])->name('hukum');
Route::get('/mawaris', [MawarisController::class, 'mawaris'])->name('mawaris');
Route::get('/kalkulator-waris/informasi-umum', [MawarisController::class, 'kalkulatorInformasiUmum'])->name('informasi_umum');
Route::get('/kalkulator-waris/informasi-harta', [MawarisController::class, 'kalkulatorInformasiHarta'])->name('informasi_harta');
Route::get('/kalkulator-waris/informasi-keluarga-inti', [MawarisController::class, 'kalkulatorInformasiKeluargaInti'])->name('informasi_keluarga_inti');
Route::get('/kalkulator-waris/informasi-keluarga', [MawarisController::class, 'kalkulatorInformasiKeluarga'])->name('informasi_keluarga');
Route::get('/kalkulator-waris/ringkasan', [MawarisController::class, 'kalkulatorRingkasan'])->name('ringkasan');
Route::get('/kalkulator-waris/hasil', [MawarisController::class, 'hasilKalkulator'])->name('hasil');


Route::post('/kalkulator-waris/informasi-umum', [MawarisController::class, 'kalkulatorInformasiUmumPost'])->name('informasi_umum_post');
Route::post('/kalkulator-waris/informasi-harta', [MawarisController::class, 'kalkulatorInformasiHartaPost'])->name('informasi_harta_post');
Route::post('/kalkulator-waris/informasi-keluarga-inti', [MawarisController::class, 'kalkulatorInformasiKeluargaIntiPost'])->name('informasi_keluarga_inti_post');
Route::post('/kalkulator-waris/informasi-keluarga', [MawarisController::class, 'kalkulatorInformasiKeluargaPost'])->name('informasi_keluarga_post');
