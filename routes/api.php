<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardCategoryController;
use App\Http\Controllers\BoardCardController;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = Auth::user();

    try {
        /** @var PersonalAccessTokenResult $tokenResult */
        $tokenResult = $user->createToken('API Token');
    } catch (\RuntimeException $e) {
        return response()->json([
            'message' => 'Erro ao gerar token: ' . $e->getMessage(),
        ], 500);
    }

    return response()->json([
        'user' => $user,
        'access_token' => $tokenResult->accessToken ?? $tokenResult->accessToken ?? $tokenResult->accessToken ?? '',
        'token_type' => 'Bearer',
    ]);
});

Route::middleware('auth:api')->prefix('boards')->group(function () {
//Route::prefix('boards')->group(function() {
    Route::get('/', [BoardController::class, 'index']);
    Route::get('/{id}', [BoardController::class, 'show']);
    Route::post('/', [BoardController::class, 'store']);
    Route::delete('/{id}', [BoardController::class, 'delete']);
    Route::put('/{id}', [BoardController::class, 'update']);
});

Route::middleware('auth:api')->prefix('board-categories')->group(function() {
    Route::get('/', [BoardCategoryController::class, 'index']);
    Route::get('/{id}', [BoardCategoryController::class, 'show']);
    Route::post('/', [BoardCategoryController::class, 'store']);
    Route::delete('/{id}', [BoardCategoryController::class, 'delete']);
    Route::put('/{id}', [BoardCategoryController::class, 'update']);
});

Route::middleware('auth:api')->prefix('board-cards')->group(function() {
    Route::get('/', [BoardCardController::class, 'index']);
    Route::get('/{id}', [BoardCardController::class, 'show']);
    Route::post('/', [BoardCardController::class, 'store']);
    Route::delete('/{id}', [BoardCardController::class, 'delete']);
    Route::put('/{id}', [BoardCardController::class, 'update']);
    Route::put('/{id}/move', [BoardCardController::class, 'updateMove']);
});


Route::middleware('api')->get('/test', function (Request $request) {
    return response()->json(['message' => 'API funcionando!']);
});
