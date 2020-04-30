<?php

use App\Http\Controllers\SellController;

Route::get('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/isloggedin', 'AuthController@isloggedin')->name('haslogin');
Route::get('/articles', 'ArticleController@search')->name('articles');
Route::get('/sell', function () {
    return view('pages.sell');
});
Route::post('/sell', 'SellController@sell');
