<?php

use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\ProfileController;
use App\Http\Controllers\MemeriksaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:dokter'])
    ->prefix('dokter')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dokter.dashboard');
        })->name('dokter.dashboard');

        Route::prefix('profile')->group(function (){
            Route::get('/', [ProfileController::class, 'edit'])->name('dokter.profile.edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('dokter.profile.update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('dokter.profile.destroy');
        });

        Route::prefix('obat')->group(function () {
            Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
            Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
            Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
            Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
            Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
            Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
            // Tambahkan route trashed dan restore
            Route::get('/trashed', [ObatController::class, 'trashed'])->name('dokter.obat.trashed');
            Route::put('/restore/{id}', [ObatController::class, 'restore'])->name('dokter.obat.restore');
        });

        Route::prefix('memeriksa')->group(function () {
            Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
            Route::get('/{id}/periksa', [MemeriksaController::class, 'periksa'])->name('dokter.memeriksa.periksa');
            Route::get('/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
            Route::post('/{id}', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
            Route::patch('/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
        });
    });
