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

Route::get('/register', 'PagesController@register');
Route::post('registerVerification', 'PagesController@registerVerification');

Route::get('/admin', 'PagesController@admin');

Route::resource('items', 'ItemsController');

// TV
Route::get('items/tv/showTv', 'TelevisionsController@showTv');

// Computer
Route::get('items/computer/showDesktop', 'ComputerController@showDesktop');
Route::get('items/computer/showLaptop', 'ComputerController@showLaptop');
Route::get('items/computer/showTablet', 'ComputerController@showTablet');


// Monitor
Route::get('items/monitor/showMonitor', 'MonitorsController@showMonitor');
Route::resource('items', 'ItemsController');


Route::get('/admin/view', 'AdminController@showItems');//Login pages
Route::get('/login', 'PagesController@login');
Route::post('loginAdminVerification', 'PagesController@loginAdminVerification');
Route::post('loginClientVerification', 'PagesController@loginClientVerification');
