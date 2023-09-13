<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ChecklistItemMovControllerApi;
use App\Http\Controllers\Api\ChecklistMovControllerApi;

//  ---------------------------- API Routes ----------------------------

Route::group(['prefix' => 'checklistmov'], function () {
    Route::get('/by-user', [ChecklistMovControllerApi::class, 'getChecklistsMovByUser']);
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('authenticate', [ApiAuthController::class, 'authenticate']);
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', 'Api\ApiAuthenticationController@logout')->name('logout');
        Route::get('user', 'Api\ApiAuthenticationController@user')->name('user-authenticated');
    });
});



Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'checklistmov'], function () {
        Route::get('/by-user', [ChecklistMovControllerApi::class, 'getChecklistsMovByUser']);
    });

    Route::group(['prefix' => 'checklistitemmov'], function () {
        Route::get('/by-checklistmov', [ChecklistItemMovControllerApi::class, 'getChecklistsItensMovs']);
    });
});