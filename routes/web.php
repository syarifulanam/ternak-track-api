<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FeedingRecordController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\GrowthController;
use App\Http\Controllers\CageController;
use App\Http\Controllers\FarmController;
use App\Models\Farm;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('users')->name('web.users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    Route::put('{id}/password', [UserController::class, 'updatePassword'])->name('updatePassword');
    Route::post('{id}/reset-password', [UserController::class, 'resetPassword'])->name('resetPassword');
});

Route::prefix('farms')->name('web.farms.')->group(function () {
    Route::get('/', [FarmController::class, 'index'])->name('index');
    Route::post('/', [FarmController::class, 'store'])->name('store');
    Route::get('/{id}', [FarmController::class, 'show'])->name('show');
    Route::put('/{id}', [FarmController::class, 'update'])->name('update');
    Route::delete('/{id}', [FarmController::class, 'destroy'])->name('destroy');
});

Route::prefix('cages')->name('web.cages.')->group(function () {
    Route::get('/', [CageController::class, 'index'])->name('index');
    Route::post('/', [CageController::class, 'store'])->name('store');
    Route::get('/{id}', [CageController::class, 'show'])->name('show');
    Route::put('/{id}', [CageController::class, 'update'])->name('update');
    Route::delete('/{id}', [CageController::class, 'destroy'])->name('destroy');
});;

Route::prefix('animals')->name('web.animals.')->group(function () {
    Route::get('/', [AnimalController::class, 'index'])->name('index');
    Route::post('/', [AnimalController::class, 'store'])->name('store');
    Route::get('/{id}', [AnimalController::class, 'show'])->name('show');
    Route::put('/{id}', [AnimalController::class, 'update'])->name('update');
    Route::delete('/{id}', [AnimalController::class, 'destroy'])->name('destroy');
});

Route::prefix('growths')->name('web.growths.')->group(function () {
    Route::get('/', [GrowthController::class, 'index'])->name('index');
    Route::post('/', [GrowthController::class, 'store'])->name('store');
    Route::get('/{id}', [GrowthController::class, 'show'])->name('show');
    Route::put('/{id}', [GrowthController::class, 'update'])->name('update');
    Route::delete('/{id}', [GrowthController::class, 'destroy'])->name('destroy');
});

Route::prefix('healths')->name('web.healths.')->group(function () {
    Route::get('/', [HealthRecordController::class, 'index'])->name('index');
    Route::post('/', [HealthRecordController::class, 'store'])->name('store');
    Route::get('/{id}', [HealthRecordController::class, 'show'])->name('show');
    Route::put('/{id}', [HealthRecordController::class, 'update'])->name('update');
    Route::delete('/{id}', [HealthRecordController::class, 'destroy'])->name('destroy');
});

Route::prefix('vaccinations')->name('web.vaccinations.')->group(function () {
    Route::get('/', [VaccinationController::class, 'index'])->name('index');
    Route::post('/', [VaccinationController::class, 'store'])->name('store');
    Route::get('/{id}', [VaccinationController::class, 'show'])->name('show');
    Route::put('/{id}', [VaccinationController::class, 'update'])->name('update');
    Route::delete('/{id}', [VaccinationController::class, 'destroy'])->name('destroy');
});

Route::prefix('feedings')->name('web.feedings.')->group(function () {
    Route::get('/', [FeedingRecordController::class, 'index'])->name('index');
    Route::post('/', [FeedingRecordController::class, 'store'])->name('store');
    Route::get('/{id}', [FeedingRecordController::class, 'show'])->name('show');
    Route::put('/{id}', [FeedingRecordController::class, 'update'])->name('update');
    Route::delete('/{id}', [FeedingRecordController::class, 'destroy'])->name('destroy');
});
