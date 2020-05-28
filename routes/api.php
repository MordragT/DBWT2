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
    Route::get('/', 'ArticleController@get_api');
    Route::post('/', 'ArticleController@post_api');
    Route::get('id/{id}', function ($id) {
        $article = Article::find($id);
        if (isset($article)) {
            return response()->json($article, 200);
        } else {
            return response()->json("Artikel nicht gefunden", 404);
        }
    });
    Route::delete('id/{id}', 'ArticleController@delete_api');
});
Route::post('/shoppingcart', 'WarenkorbController@add_article_api');
Route::delete('/shoppingcart/{shoppingcartid}/articles/{articleId}', 'WarenkorbController@delete_article_api');
