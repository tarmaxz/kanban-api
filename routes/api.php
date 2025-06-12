<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardCategoryController;

Route::middleware('api')->get('/test', function (Request $request) {
    return response()->json(['message' => 'API funcionando!']);
});

Route::prefix('boards')->group(function() {
    Route::get('/', [BoardController::class, 'index']);
    Route::get('/{id}', [BoardController::class, 'show']);
    Route::post('/', [BoardController::class, 'store']);
    Route::delete('/{id}', [BoardController::class, 'delete']);
    Route::put('/{id}', [BoardController::class, 'update']);
});

Route::prefix('board-categories')->group(function() {
    Route::get('/', [BoardCategoryController::class, 'index']);
    Route::get('/{id}', [BoardCategoryController::class, 'show']);
    Route::post('/', [BoardCategoryController::class, 'store']);
    Route::delete('/{id}', [BoardCategoryController::class, 'delete']);
    Route::put('/{id}', [BoardCategoryController::class, 'update']);
});
