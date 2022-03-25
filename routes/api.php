<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\ArticleDetailedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('authors', [ArticleController::class, 'getAuthorsList']);
Route::get('categories', [ArticleController::class, 'getCategories']);
Route::get('articles', [ArticleController::class, 'getArticles']);

Route::prefix('search')->group(function () {
    Route::prefix('article')->group(function () {
        Route::get('by_name', [ArticleController::class, 'getArticleByName']);
        Route::get('by_category', [ArticleController::class, 'getArticleByCategory']);
        Route::get('by_author', [ArticleController::class, 'getArticleByAuthor']);
    });
    Route::prefix('author')->group(function () {
        Route::get('by_last_name', [ArticleController::class, 'getAuthor']);
    });
    Route::prefix('full')->group(function () {
        Route::get('article/{slug}', [ArticleDetailedController::class, 'article']);
        Route::get('author/{slug}', [ArticleDetailedController::class, 'author']);
        Route::get('category/{slug}', [ArticleDetailedController::class, 'category']);
    });
});

