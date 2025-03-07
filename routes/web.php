<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ChecklistController;
use App\Http\Controllers\Web\ChecklistItemController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\ClassificationController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\SectorController;
use App\Http\Controllers\Web\UnityController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UsersGroupController;
use App\Http\Controllers\Web\ManageController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('root');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('app/download', [ManageController::class, 'appDownload'])->name('app-download');

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'home'])->name('home');

    Route::group(['prefix' => 'setor'], function () {
        Route::get('listar', [SectorController::class, 'index'])->name('sector_list');
        Route::get('novo', [SectorController::class, 'create'])->name('sector_create');
        Route::post('salvar', [SectorController::class, 'store'])->name('sector_store');
        Route::get('editar/{id}', [SectorController::class, 'edit'])->name('sector_edit');
        Route::put('atualizar/{id}', [SectorController::class, 'update'])->name('sector_update');
        Route::get('delete/{id}', [SectorController::class, 'delete'])->name('sector_delete');
    });

    Route::group(['prefix' => 'classificacao'], function () {
        Route::get('listar', [ClassificationController::class, 'index'])->name('classification_list');
        Route::get('novo', [ClassificationController::class, 'create'])->name('classification_create');
        Route::post('salvar', [ClassificationController::class, 'store'])->name('classification_store');
        Route::get('editar/{id}', [ClassificationController::class, 'edit'])->name('classification_edit');
        Route::put('atualizar/{id}', [ClassificationController::class, 'update'])->name('classification_update');
        Route::get('delete/{id}', [ClassificationController::class, 'delete'])->name('classification_delete');
    });

    Route::group(['prefix' => 'checklist'], function () {
        Route::get('listar', [ChecklistController::class, 'index'])->name('checklist_list');
        Route::get('novo', [ChecklistController::class, 'create'])->name('checklist_create');
        Route::post('salvar', [ChecklistController::class, 'store'])->name('checklist_store');
        Route::get('editar/{id}', [ChecklistController::class, 'edit'])->name('checklist_edit');
        Route::put('atualizar/{id}', [ChecklistController::class, 'update'])->name('checklist_update');
        Route::post('gerar-tarefa', [ChecklistController::class, 'generateTasks'])->name('checklist_generate');
        Route::get('delete/{id}', [ChecklistController::class, 'delete'])->name('checklist_delete');

    });

    Route::group(['prefix' => 'checklist-item'], function () {
        Route::get('listar/checklist/{chkl_id}', [ChecklistItemController::class, 'index'])->name('checklist_item_list');
        Route::get('novo/checklist/{chkl_id}', [ChecklistItemController::class, 'create'])->name('checklist_item_create');
        Route::post('salvar/', [ChecklistItemController::class, 'store'])->name('checklist_item_store');
        Route::get('editar/{id}', [ChecklistItemController::class, 'edit'])->name('checklist_item_edit');
        Route::put('atualizar/{id}', [ChecklistItemController::class, 'update'])->name('checklist_item_update');
        Route::get('delete/{id}', [ChecklistItemController::class, 'delete'])->name('checklist_item_delete');
    });

    Route::group(['prefix' => 'grupo-usuarios'], function () {
        Route::get('listar', [UsersGroupController::class, 'index'])->name('users_group_list');
        Route::get('novo', [UsersGroupController::class, 'create'])->name('users_group_create');
        Route::post('salvar', [UsersGroupController::class, 'store'])->name('users_group_store');
        Route::get('editar/{id}', [UsersGroupController::class, 'edit'])->name('users_group_edit');
        Route::put('atualizar/{id}', [UsersGroupController::class, 'update'])->name('users_group_update');
        Route::get('delete/{id}', [UsersGroupController::class, 'delete'])->name('users_group_delete');
    });

    Route::group(['prefix' => 'usuario'], function () {
        Route::get('listar', [UserController::class, 'index'])->name('user_list');
        Route::get('novo', [UserController::class, 'create'])->name('user_create');
        Route::post('salvar', [UserController::class, 'store'])->name('user_store');
        Route::get('editar/{id}', [UserController::class, 'edit'])->name('user_edit');
        Route::put('atualizar/{id}', [UserController::class, 'update'])->name('user_update');
        // Route::get('delete/{id}', [UserController::class, 'delete'])->name('user_delete');
        Route::get('buscar-por-nome', [UserController::class, 'getUsersByName'])->name('user_search_by_name');
    });

    Route::group(['prefix' => 'cidade'], function () {
        Route::get('buscar-por-nome', [CityController::class, 'getCitiesByName'])->name('city_search_by_name');
    });

    Route::group(['prefix' => 'unidade'], function () {
        Route::get('listar', [UnityController::class, 'index'])->name('unity_list');
        Route::get('novo', [UnityController::class, 'create'])->name('unity_create');
        Route::post('salvar', [UnityController::class, 'store'])->name('unity_store');
        Route::get('editar/{id}', [UnityController::class, 'edit'])->name('unity_edit');
        Route::put('atualizar/{id}', [UnityController::class, 'update'])->name('unity_update');
        Route::get('delete/{id}', [UnityController::class, 'delete'])->name('unity_delete');
    });

    Route::group(['prefix' => 'gerenciar'], function () {
        Route::get('tarefas/listar', [ManageController::class, 'index'])->name('manage_tasks');
        Route::get('fechar-tarefa/{id}', [ManageController::class, 'close'])->name('close_task');
        Route::get('reabrir-tarefa/{id}', [ManageController::class, 'reopen'])->name('reopen_task');
        Route::get('visualizar-tarefa/{id}', [ManageController::class, 'view'])->name('view_task');
        Route::get('cancelar-tarefa/{id}', [ManageController::class, 'cancel'])->name('cancel_task');
        Route::get('get-report-task/{id}', [ManageController::class, 'getPdf'])->name('report_task');
    });    
});