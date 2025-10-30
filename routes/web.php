<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\GrowthController;
use App\Http\Controllers\CageController;
use App\Http\Controllers\FarmController;
use App\Models\Farm;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/farms', [FarmController::class, 'index'])->name('web.farms.index');
Route::post('/farms', [FarmController::class, 'store'])->name('web.farms.store');
Route::put('/farms/{id}', [FarmController::class, 'update'])->name('web.farms.update');
Route::get('/farms/{id}', [FarmController::class, 'show'])->name('web.farms.show');
Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('web.farms.destroy');

Route::get('/cages', [CageController::class, 'index'])->name('web.cages.index');
Route::post('/cages', [CageController::class, 'store'])->name('web.cages.store');
Route::get('/cages/{id}', [CageController::class, 'show'])->name('web.cages.show');
Route::put('/cages/{id}', [CageController::class, 'update'])->name('web.cages.update');
Route::delete('/cages/{id}', [CageController::class, 'destroy'])->name('web.cages.destroy');

Route::get('/animals', [AnimalController::class, 'index'])->name('web.animals.index');
Route::post('/animals', [AnimalController::class, 'store'])->name('web.animals.store');
Route::get('/animals/{id}', [AnimalController::class, 'show'])->name('web.animals.show');
Route::put('/animals/{id}', [AnimalController::class, 'update'])->name('web.animals.update');
Route::delete('/animals/{id}', [AnimalController::class, 'destroy'])->name('web.animals.destroy');

Route::get('/growths', [GrowthController::class, 'index'])->name('web.growths.index');
Route::post('/growths', [GrowthController::class, 'store'])->name('web.growths.store');
Route::get('/growths/{id}', [GrowthController::class, 'show'])->name('web.growths.show');
Route::put('/growths/{id}', [GrowthController::class, 'update'])->name('web.growths.update');
Route::delete('/growths/{id}', [GrowthController::class, 'destroy'])->name('web.growths.destroy');

Route::get('/healths', [HealthRecordController::class, 'index'])->name('web.healths.index');
Route::post('/healths', [HealthRecordController::class, 'store'])->name('web.healths.store');
Route::get('/healths/{id}', [HealthRecordController::class, 'show'])->name('web.healths.show');
Route::put('/healths/{id}', [HealthRecordController::class, 'update'])->name('web.healths.update');
Route::delete('/healths/{id}', [HealthRecordController::class, 'destroy'])->name('web.healths.destroy');

Route::get('/vaccinations', [VaccinationController::class, 'index'])->name('web.vaccinations.index');
Route::post('/vaccinations', [VaccinationController::class, 'store'])->name('web.vaccinations.store');
Route::get('/vaccinations/{id}', [VaccinationController::class, 'show'])->name('web.vaccinations.show');
Route::put('/vaccinations/{id}', [VaccinationController::class, 'update'])->name('web.vaccinations.update');
Route::delete('/vaccinations/{id}', [VaccinationController::class, 'destroy'])->name('web.vaccinations.destroy');