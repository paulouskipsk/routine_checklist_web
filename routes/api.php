<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ChecklistItemMovControllerApi;
use App\Http\Controllers\Api\ChecklistMovControllerApi;

//  ---------------------------- API Routes ----------------------------

Route::group(['prefix' => 'auth'], function () {
    Route::post('authenticate', [ApiAuthController::class, 'authenticate'])->name('authenticate');
    Route::post('user-data-by-credentials', [ApiAuthController::class, 'getUserDataByCredentials'])->name('getUserDataByCredentials');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout/{user_id}', [ApiAuthController::class, 'logout'])->name('logout');
        Route::get('user', [ApiAuthController::class, 'user'])->name('user-authenticated');
    });
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    
    Route::group(['prefix' => 'checklistmov'], function () {
        Route::get('/with-itens/{id}', [ChecklistMovControllerApi::class, 'getChecklistMovByIdWithItens']);
        Route::get('/by-user', [ChecklistMovControllerApi::class, 'getChecklistsMovByUser']);
        Route::put('/associate-checklistmov', [ChecklistMovControllerApi::class, 'associateChecklistMov']);
        Route::put('/disassociate-checklistmov', [ChecklistMovControllerApi::class, 'disassociateChecklistMov']);
        Route::put('/finish', [ChecklistMovControllerApi::class, 'finishChecklist']); 
    });

    Route::group(['prefix' => 'checklistitemmov'], function () {
        Route::get('/by-checklistmov', [ChecklistItemMovControllerApi::class, 'getChecklistsItensMovs']);
        Route::put('/{chim_id}', [ChecklistItemMovControllerApi::class, 'responseChecklistItemMov'])->name('update_response');
    });
});