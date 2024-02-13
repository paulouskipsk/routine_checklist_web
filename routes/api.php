<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ChecklistItemMovControllerApi;
use App\Http\Controllers\Api\ChecklistMovControllerApi;
use App\Models\ChecklistItemMov;

//  ---------------------------- API Routes ----------------------------

Route::group(['prefix' => 'auth'], function () {
    Route::post('authenticate', [ApiAuthController::class, 'authenticate'])->name('authenticate');
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout/{user_id}', [ApiAuthController::class, 'logout'])->name('logout');
        Route::get('user', [ApiAuthController::class, 'user'])->name('user-authenticated');
    });
});


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'checklistmov'], function () {
        Route::get('/by-user', [ChecklistMovControllerApi::class, 'getChecklistsMovByUser']);
    });

    Route::group(['prefix' => 'checklistitemmov'], function () {
        Route::get('/by-checklistmov', [ChecklistItemMovControllerApi::class, 'getChecklistsItensMovs']);
    });

    Route::group(['prefix' => 'checklistmov'], function () {
        Route::get('/by-user', [ChecklistMovControllerApi::class, 'getChecklistsMovByUser']);
    });
    
    Route::group(['prefix' => 'checklistitemmov'], function () {
        Route::put('/{chim_id}', [ChecklistItemMovControllerApi::class, 'responseChecklistItemMov'])->name('update_response');
    });
});