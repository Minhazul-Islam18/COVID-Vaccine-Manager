<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use App\Http\Controllers\VaccineManager\VaccineRegistrationController;

Route::get('/', [FrontendController::class, 'index'])->name('vaccine-manager.frontend.index');
Route::get('/register', [VaccineRegistrationController::class, 'create'])->name('vaccine-manager.register.index');
Route::post('/register', [VaccineRegistrationController::class, 'store'])->name('vaccine-manager.register.store')->middleware([HandlePrecognitiveRequests::class]);
