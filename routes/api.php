<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FarmController;

Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
Route::get('/farms/{id}', [FarmController::class, 'show'])->name('farms.show');
Route::post('/farms', [FarmController::class, 'store'])->name('farms.store');
Route::patch('/farms/{id}', [FarmController::class, 'update'])->name('farms.update');
Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('farms.destroy');
