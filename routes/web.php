<?php

use App\Http\Controllers\FarmController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/farms', [FarmController::class, 'index'])->name('farm.index');
Route::post('/farms', [FarmController::class, 'store'])->name('farm.store');
Route::put('/farms/{id}', [FarmController::class, 'update'])->name('farm.update');
Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('farm.destroy');
