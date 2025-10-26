<?php

use App\Http\Controllers\CageController;
use App\Http\Controllers\FarmController;
use App\Models\Farm;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/farms', [FarmController::class, 'index'])->name('web.farms.index');
Route::post('/farms', [FarmController::class, 'store'])->name('web.farms.store');
Route::put('/farms/{id}', [FarmController::class, 'update'])->name('web.farms.update');
Route::get('/farms/{id}', [FarmController::class, 'show'])->name('web.farms.show');
Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('web.farms.destroy');

Route::get('/cages', [CageController::class, 'index'])->name('web.cages.index');
Route::post('/cages', [CageController::class, 'store'])->name('web.cages.store');
Route::put('/cages/{id}', [CageController::class, 'update'])->name('web.cages.update');
Route::get('/customer/{id}', [CageController::class, 'show'])->name('customer.show');
Route::delete('/cages/{id}', [CageController::class, 'destroy'])->name('web.cages.destroy');
