<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardCategoryController;

Route::get('/', [IndexController::class, 'indexView']);
Route::get('/kanban', [BoardController::class, 'indexView'])->name('kanban.index');

Route::prefix('/admin')->group(function() {
    Route::prefix('/boards')->group(function() {
        Route::get('/', [BoardController::class, 'listView'])->name('admin.boards.index');
        Route::get('/form/{id?}', [BoardController::class, 'formView'])->name('admin.boards.form');
    });

    Route::prefix('/board-categories')->group(function() {
        Route::get('/', [BoardCategoryController::class, 'listView'])->name('admin.board-categories.index');
        Route::get('/form/{id?}', [BoardCategoryController::class, 'formView'])->name('admin.board-categories.form');
    });
});
