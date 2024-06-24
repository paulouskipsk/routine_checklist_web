<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ChecklistItemMovControllerApi;
use App\Http\Controllers\Api\ChecklistMovControllerApi;

//  ---------------------------- API Routes ----------------------------

Route::group(['prefix' => 'auth'], function () {
    Route::post('user-data-by-credentials', [ApiAuthController::class, 'getUserDataByCredentials'])->name('get_user_data_by_credentials');
    Route::post('authenticate', [ApiAuthController::class, 'authenticate'])->name('authenticate');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [ApiAuthController::class, 'logout'])->name('logout');
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