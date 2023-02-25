<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('author')->group(function () {
    Route::get('/{authorId}/articles', [AuthorController::class, 'getAllAuthorsArticles']);
    Route::get('/top3', [AuthorController::class, 'getTopAuthors']);
});

Route::get('authors', [AuthorController::class, 'index']);

Route::prefix('article')->group(function () {
    Route::get('/{articleId}', [ArticleController::class, 'show']);
    Route::post('/', [ArticleController::class, 'create']);
    Route::put('/{article}', [ArticleController::class, 'update']);
});

Route::get('/articles', [ArticleController::class, 'index']);
