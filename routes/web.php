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
//切换语言
Route::get('/lang/switch/zh','IndexController@switchZh')->name('langSwitchZh');
Route::get('/lang/switch/en','IndexController@switchEn')->name('langSwitchEn');
