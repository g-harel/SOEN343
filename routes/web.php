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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Route::resource('items', 'ItemsController');

// TV
Route::get('items/tv/showTvHd', 'TelevisionsController@showTvHd');
Route::get('items/tv/showTvThreeD', 'TelevisionsController@showTvThreeD');
Route::get('items/tv/showTvLed', 'TelevisionsController@showTvLed');
Route::get('items/tv/showTvSmart', 'TelevisionsController@showTvSmart');


// Computer
Route::get('items/computer/showDesktop', 'ComputerController@showDesktop');
Route::get('items/computer/showLaptop', 'ComputerController@showLaptop');
Route::get('items/computer/showTablet', 'ComputerController@showTablet');


// Monitor
Route::get('items/monitor/showMonitor', 'MonitorsController@showMonitor');
