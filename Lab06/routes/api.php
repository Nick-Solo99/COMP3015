<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/articles', [ArticleController::class, 'index']);

Route::post('/articles', [ArticleController::class, 'store']);

Route::put('/articles/{id}', [ArticleController::class, 'update']);

Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

Route::get('/articles/{id}', [ArticleController::class, 'show']);
