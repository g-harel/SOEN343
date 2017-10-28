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

Route::get('/admin', 'PagesController@admin');

Route::get('/shoppingCart', 'PagesController@shoppingCart');

Route::resource('items', 'ItemsController');

// Computer
Route::prefix('items/computer/')->group(function () {
    Route::get('showDesktop', 'ComputerController@showDesktop');
    Route::get('showLaptop', 'ComputerController@showLaptop');
    Route::get('showTablet', 'ComputerController@showTablet');
    Route::post('desktop/insert', 'ComputerController@insertDesktop');
    Route::post('tablet/insert', 'ComputerController@insertTablet');
    Route::post('desktop/delete', 'ComputerController@deleteDesktop');
    Route::post('laptop/insert', 'ComputerController@insertLaptop');
});

// Monitor
Route::get('items/monitor/showMonitor', 'MonitorsController@showMonitor');
Route::resource('items', 'ItemsController');


Route::get('/admin/view', 'AdminController@showItems');//Login pages
Route::get('/login', 'PagesController@login');
Route::post('loginAdminVerification', 'PagesController@loginAdminVerification');
Route::post('loginClientVerification', 'PagesController@loginClientVerification');

Route::post('items/monitor/insert', 'MonitorsController@insertMonitor');

