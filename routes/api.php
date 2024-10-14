<?php

use App\Http\Controllers\VaccineManager\Api\FrontendApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'web', 'as' => 'vaccine-manager.frontend.'], function () {
    Route::get('/vaccine-status', [FrontendApiController::class, 'getStatus'])->name('vaccine-data.api');
});
