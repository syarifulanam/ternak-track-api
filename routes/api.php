<?php

use App\Http\Controllers\Api\CageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\FarmController;
use App\Http\Controllers\Api\GrowthController;

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

Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{id}', [AnimalController::class, 'show'])->name('animals.show');
Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store');
Route::patch('/animals/{id}', [AnimalController::class, 'update'])->name('animals.update');
Route::delete('/animals/{id}', [AnimalController::class, 'destroy'])->name('animals.destroy');

Route::get('/growth', [GrowthController::class, 'index'])->name('growth.index');
Route::get('/growth/{id}', [GrowthController::class, 'show'])->name('growth.show');
Route::post('/growth', [GrowthController::class, 'store'])->name('growth.store');
Route::patch('/growth/{id}', [GrowthController::class, 'update'])->name('growth.update');
Route::delete('/growth/{id}', [GrowthController::class, 'destroy'])->name('growth.destroy');
