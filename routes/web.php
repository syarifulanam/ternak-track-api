<?php

use App\Http\Controllers\FarmController;
use App\Models\Farm;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
Route::post('/farms', [FarmController::class, 'store'])->name('farms.store');
Route::put('/farms/{id}', [FarmController::class, 'update'])->name('farms.update');
Route::get('/farms/{id}', [FarmController::class, 'show'])->name('customer.show');
Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('farms.destroy');
