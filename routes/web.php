<?php

use App\Http\Controllers\FarmController;
use App\Models\Farm;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/farms', [FarmController::class, 'index'])->name('web.farms.index');
Route::post('/farms', [FarmController::class, 'store'])->name('web.farms.store');
Route::put('/farms/{id}', [FarmController::class, 'update'])->name('web.farms.update');
Route::get('/farms/{id}', [FarmController::class, 'show'])->name('web.farms.show');
Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('web.farms.destroy');
