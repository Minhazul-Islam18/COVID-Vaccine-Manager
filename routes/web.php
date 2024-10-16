<?php

use App\Http\Controllers\Account\NotificationController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DropdownValuesController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/vaccine-manager/vaccine-data');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::post('users/{userId}/restore', [UserController::class, 'restore'])->name('users.restore');

    // Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::post('roles/{roleId}/restore', [RoleController::class, 'restore'])->name('roles.restore');
    });

    // Account
    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});
