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
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/login', 'PagesController@login');
Route::post('/login/verify', 'PagesController@loginVerify');
Route::get('/logout', 'PagesController@logout');
Route::get('/register', 'PagesController@register');
Route::post('registerUser', 'PagesController@registerUser');
//TODO REVIEW THESE TWO (Make sure its okay, may conflict)
Route::get('/purchaseHistory', 'PagesController@purchaseHistory');
Route::post('deleteAccount', 'PagesController@deleteAccount');



if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] != 1) {
    Route::get('/shoppingCart', 'PagesController@shoppingCart');
}

Route::prefix('/purchaseHistory')->group(
    function () {
        Route::get('showPurchase', 'UnitsController@searchPurchase');
        Route::get('returnPurchase', 'UnitsController@returnPurchase');
        Route::get('showPurchaseTemplate', 'UnitsController@showPurchase');
    }
);

Route::prefix('/view')->group(
    function () {
        Route::get('/', 'PagesController@view');
        Route::get('/monitor', 'PagesController@viewMonitor');
        Route::get('/monitor/search', 'MonitorsController@searchMonitor');
        Route::get('/desktop', 'PagesController@viewDesktop');
        Route::get('/laptop', 'PagesController@viewLaptop');
        Route::get('/tablet', 'PagesController@viewTablet');
        Route::get('/computer/search', 'ComputerController@search');

        Route::get('/monitor/{id}', ['uses' => 'PagesController@monitorDetails']);
        Route::get('/desktop/{id}', ['uses' => 'PagesController@desktopDetails']);
        Route::get('/laptop/{id}', ['uses' => 'PagesController@laptopDetails']);
        Route::get('/tablet/{id}', ['uses' => 'PagesController@tabletDetails']);
        Route::get('search', 'ComputerController@search'); // computer filter
        Route::get('search', 'MonitorsController@searchMonitor'); // monitor filter
        Route::get('profile', 'PagesController@viewProfile');
    }
);

if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
    Route::get('/items', 'ItemsController@index');
    Route::get('/admin', 'PagesController@admin');
    Route::get('items/create', 'ItemsController@create');

    Route::prefix('items/computer/')->group(
        function () {
            Route::get('showDesktop', 'ComputerController@showDesktop');
            Route::get('showLaptop', 'ComputerController@showLaptop');
            Route::get('showTablet', 'ComputerController@showTablet');
            Route::post('desktop/insert', 'ComputerController@insertDesktop');
            Route::post('tablet/insert', 'ComputerController@insertTablet');
            Route::post('laptop/insert', 'ComputerController@insertLaptop');
            Route::post('desktop/delete', 'ComputerController@deleteDesktop');
            Route::post('tablet/delete', 'ComputerController@deleteTablet');
            Route::post('desktop/modify', 'ComputerController@modifyDesktop');
            Route::post('tablet/modify', 'ComputerController@modifyTablet');
            Route::post('laptop/modify', 'ComputerController@modifyLaptop');
            Route::post('laptop/delete', 'ComputerController@deleteLaptop');
            Route::get('search', 'ComputerController@search'); // computer filter
        }
    );

    Route::prefix('items/monitor/')->group(
        function () {
            Route::get('showMonitor', 'MonitorsController@showMonitor');
            Route::post('insert', 'MonitorsController@insertMonitor');
            Route::post('delete', 'MonitorsController@deleteMonitor');
            Route::post('modify', 'MonitorsController@modifyMonitor');
        }
    );
}
