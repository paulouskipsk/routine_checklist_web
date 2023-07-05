<?php

use App\Http\Controllers\Api\ApiAuthController;
use Illuminate\Support\Facades\Route;

//  ---------------------------- API Routes ----------------------------


Route::group(['prefix' => 'auth'], function () {
    Route::post('authenticate', [ApiAuthController::class, 'authenticate']);

    // Route::post('authenticate', 'Api\ApiAuthController@authenticate')->name('authenticate');

    // Route::group(['middleware' => 'auth:sanctum'], function () {
    //     Route::get('logout', 'Api\ApiAuthenticationController@logout')->name('logout');
    //     Route::get('user', 'Api\ApiAuthenticationController@user')->name('user-authenticated');
    // });
});