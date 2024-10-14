<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use App\Http\Controllers\VaccineManager\VaccineRegistrationController;

Route::prefix('vaccine-manager')->name('vaccine-manager.')->group(function () {

    // Frontend Routes
    Route::controller(FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('frontend.index');
        Route::get('/vaccine-data', 'vaccineData')->name('frontend.vaccine-data');
    });

    // Vaccine Registration Routes
    Route::controller(VaccineRegistrationController::class)->group(function () {
        Route::get('/register', 'create')->name('register.index');
        Route::post('/register', 'store')->name('register.store')
            ->middleware([HandlePrecognitiveRequests::class]);
    });
});
