<?php

use App\Http\Controllers\SellController;

Route::get('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/isloggedin', 'AuthController@isloggedin')->name('haslogin');
Route::get('/getId', 'AuthController@getId')->name('login');

Route::get('/articles', function () {
    return view('pages.articles');
})->name('articles');
Route::get('/newsite', function () {
    return view('pages.newsite');
})->name('newsite');
Route::get('/newsell', function () {
    return view('pages.newsell');
})->name('newsell');

Route::get('/sell', function () {
    return view('pages.sell');
})->name('sell');
Route::get('/shoppingcart_items', 'WarenkorbController@getItems')->name('getItems');

// vue-good-table
Route::get('/goodtable', function () {
    return view('pages.goodtable');
})->name('goodtable');

Route::get('/statistics', function () {
    return view('pages.statistics');
});

Route::get('/p5a2', function () {
    return view('pages.p5a2');
})->name('p5a2');
