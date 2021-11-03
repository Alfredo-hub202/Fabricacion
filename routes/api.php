<?php

use App\Http\Controllers\AgrupacionController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SeccionController;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
 return $request->user();
});

Route::apiResource('/calendar', 'CalendarController');
// Route::apiResource('/equipos', 'EquipoController');

// Route::get('/secciones', 'SeccionController');
// Route::get('/agrupaciones', 'AgrupacionController');

Route::group(["middleware" => "apikey.validate"], function () {

});

//Rutas
Route::get('/secciones', [SeccionController::class, 'index']);
Route::get('/agrupaciones', [AgrupacionController::class, 'index']);
Route::get('/equipos', [EquipoController::class, 'index']);
