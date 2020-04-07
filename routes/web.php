<?php
Route::get('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/isloggedin', 'AuthController@isloggedin')->name('haslogin');
Route::get('/articles','ArticlesController@search');
