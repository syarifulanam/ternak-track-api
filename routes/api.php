<?php

use App\Http\Controllers\Api\CageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FarmController;

Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
Route::get('/farms/{id}', [FarmController::class, 'show'])->name('farms.show');
Route::post('/farms', [FarmController::class, 'store'])->name('farms.store');
Route::patch('/farms/{id}', [FarmController::class, 'update'])->name('farms.update');
Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('farms.destroy');

Route::get('/cages', [CageController::class, 'index'])->name('cages.index');
Route::get('/cages/{id}', [CageController::class, 'show'])->name('cages.show');
Route::post('/cages', [CageController::class, 'store'])->name('cages.store');
Route::patch('/cages/{id}', [CageController::class, 'update'])->name('cages.update');
Route::delete('/cages/{id}', [CageController::class, 'destroy'])->name('cages.destroy');
