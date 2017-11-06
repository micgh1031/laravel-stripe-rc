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

Route::get('/', 'HomeController@index');
Route::get('/success', 'HomeController@success')->name('success');

// -- Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// -- Frontend Routes
Route::group(['namespace' => 'Frontend', 'middleware' => 'auth'], function ($router) {
    $router->get('/home', 'DashboardController@index')->name('home');
    $router->post('/payment', 'DashboardController@payment')->name('payment');
});
