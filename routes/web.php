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

    Route::get('setor/listar', [SectorController::class, 'index'])->name('sector_list');
    Route::get('setor/novo', [SectorController::class, 'create'])->name('sector_create');
    Route::post('setor/salvar', [SectorController::class, 'store'])->name('sector_store');
    Route::get('setor/editar', [SectorController::class, 'edit'])->name('sector_edit');
    Route::get('setor/delete', [SectorController::class, 'delete'])->name('sector_delete');
});