<?php

use Illuminate\Support\Facades\Route;
// Route::get('/', function () {
// //  return view('welcome');
//  return view('auth.login');
// });

Route::get('/', 'Auth\LoginController@ShowLoginController')->middleware('guest');
Route::get('Dashboard', 'DashboardController@index')->name('Dashboard');

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/xml', 'XmlCargarFabricacion@index')->name('home.index');
