<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Article;

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

Route::prefix('/articles')->group(function () {
    Route::get('/', 'ArticleController@search_api');
    Route::get('id/{id}', function ($id) {
        $article = Article::find($id);
        if (isset($article)) {
            return response()->json($article, 200);
        } else {
            return response()->json("Artikel nicht gefunden", 404);
        }
    });
    Route::delete('id/{id}', 'ArticleController@delete');
});

Route::post('/sell', 'ArticleController@sell_api');
