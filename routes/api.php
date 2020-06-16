<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Article;
use App\Events\Maintenance;

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

    Route::get('lastsearch', function () {
        $lastsearcharticles = Redis::lrange("lastarticlesearch", 0, -1);
        if (isset($lastsearcharticles)) {
            return response()->json($lastsearcharticles, 200);
        } else {
            return response()->json("FEHLER", 404);
        }
    });
    Route::prefix('/id')->group(function () {
        Route::get('{id}', function ($id) {
            $article = Article::find($id);
            if (isset($article)) {
                return response()->json($article, 200);
            } else {
                return response()->json("Artikel nicht gefunden", 404);
            }
        });
        Route::delete('{id}', 'ArticleController@delete_api');
        Route::post('{id}/sold', 'ArticleController@postSold_api');
    });
});
Route::post('/shoppingcart', 'WarenkorbController@add_article_api');
Route::post('/sell', 'ArticleController@post_api');
Route::post('/angebot', 'ArticleController@angebot_api');
Route::delete('/shoppingcart/{shoppingcartid}/articles/{articleId}', 'WarenkorbController@delete_article_api');

Route::get('/maintenance', function () {
    event(new Maintenance);
    return response()->json("Maintenance Mode enabled.");
});
