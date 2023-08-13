<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\SectorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'home'])->name('home');

    Route::group(['prefix' => 'setor'], function () {
        Route::get('listar', [SectorController::class, 'index'])->name('sector_list');
        Route::get('novo', [SectorController::class, 'create'])->name('sector_create');
        Route::post('salvar', [SectorController::class, 'store'])->name('sector_store');
        Route::get('editar/{id}', [SectorController::class, 'edit'])->name('sector_edit');
        Route::post('atualizar/{id}', [SectorController::class, 'update'])->name('sector_update');
        Route::delete('delete/{id}', [SectorController::class, 'delete'])->name('sector_delete');
    });

    
});