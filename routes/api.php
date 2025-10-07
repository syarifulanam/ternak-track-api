<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CageController;
use App\Http\Controllers\Api\FarmController;
use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\BreedingController;
use App\Http\Controllers\Api\FeedingRecordController;
use App\Http\Controllers\Api\GrowthController;
use App\Http\Controllers\Api\HealthRecordController;
use App\Http\Controllers\Api\VaccinationController;

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

Route::get('/growths', [GrowthController::class, 'index'])->name('growths.index');
Route::get('/growths/{id}', [GrowthController::class, 'show'])->name('growths.show');
Route::post('/growths', [GrowthController::class, 'store'])->name('growths.store');
Route::patch('/growths/{id}', [GrowthController::class, 'update'])->name('growths.update');
Route::delete('/growths/{id}', [GrowthController::class, 'destroy'])->name('growths.destroy');

Route::get('/health', [HealthRecordController::class, 'index'])->name('Health.index');
Route::get('/health/{id}', [HealthRecordController::class, 'show'])->name('Health.show');
Route::post('/health', [HealthRecordController::class, 'store'])->name('Health.store');
Route::patch('/health/{id}', [HealthRecordController::class, 'update'])->name('Health.update');
Route::delete('/health/{id}', [HealthRecordController::class, 'destroy'])->name('Health.destroy');

Route::get('/vaccinations', [VaccinationController::class, 'index'])->name('vaccinations.index');
Route::get('/vaccinations/{id}', [VaccinationController::class, 'show'])->name('vaccinations.show');
Route::post('/vaccinations', [VaccinationController::class, 'store'])->name('vaccinations.store');
Route::patch('/vaccinations/{id}', [VaccinationController::class, 'update'])->name('vaccinations.update');
Route::delete('/vaccinations/{id}', [VaccinationController::class, 'destroy'])->name('vaccinations.destroy');

Route::get('/feedings', [FeedingRecordController::class, 'index'])->name('feedings.index');
Route::get('/feedings/{id}', [FeedingRecordController::class, 'show'])->name('feedings.show');
Route::post('/feedings', [FeedingRecordController::class, 'store'])->name('feedings.store');
Route::patch('/feedings/{id}', [FeedingRecordController::class, 'update'])->name('feedings.update');
Route::delete('/feedings/{id}', [FeedingRecordController::class, 'destroy'])->name('feedings.destroy');

Route::get('/breedings', [BreedingController::class, 'index'])->name('breedings.index');
Route::get('/breedings/{id}', [BreedingController::class, 'show'])->name('breedings.show');
Route::post('/breedings', [BreedingController::class, 'store'])->name('breedings.store');
Route::patch('/breedings/{id}', [BreedingController::class, 'update'])->name('breedings.update');
Route::delete('/breedings/{id}', [BreedingController::class, 'destroy'])->name('breedings.destroy');
