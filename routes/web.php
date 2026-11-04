<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\AbsensiController;

Route::get('/', function () {
    return view('welcome');
});

// Route CRUD Mata Kuliah
Route::resource('matakuliah', MatakuliahController::class);

// Route Absensi
Route::get('/absensi', [AbsensiController::class, 'index'])
    ->name('absensi.index');

Route::post('/absensi', [AbsensiController::class, 'store'])
    ->name('absensi.store');
