<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','IndexController@showIndex')->name('showIndex');
Route::get('/news','NewsController@showNews')->name('showNews');
//切换语言
Route::get('/switch/lang','IndexController@switchLang')->name('switchLang');
