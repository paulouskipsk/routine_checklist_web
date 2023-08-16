<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ChecklistController;
use App\Http\Controllers\Web\ClassificationController;
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

    Route::group(['prefix' => 'classificacao'], function () {
        Route::get('listar', [ClassificationController::class, 'index'])->name('classification_list');
        Route::get('novo', [ClassificationController::class, 'create'])->name('classification_create');
        Route::post('salvar', [ClassificationController::class, 'store'])->name('classification_store');
        Route::get('editar/{id}', [ClassificationController::class, 'edit'])->name('classification_edit');
        Route::post('atualizar/{id}', [ClassificationController::class, 'update'])->name('classification_update');
        Route::delete('delete/{id}', [ClassificationController::class, 'delete'])->name('classification_delete');
    });

    Route::group(['prefix' => 'checklist'], function () {
        Route::get('listar', [ChecklistController::class, 'index'])->name('checklist_list');
        Route::get('novo', [ChecklistController::class, 'create'])->name('checklist_create');
        Route::post('salvar', [ChecklistController::class, 'store'])->name('checklist_store');
        Route::get('editar/{id}', [ChecklistController::class, 'edit'])->name('checklist_edit');
        Route::post('atualizar/{id}', [ChecklistController::class, 'update'])->name('checklist_update');
        Route::delete('delete/{id}', [ChecklistController::class, 'delete'])->name('checklist_delete');
    });

    
});