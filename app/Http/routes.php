<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/* Sistema de Autenficación */

// Inicio de sesión
Route::post('v1/login', 'LoginController@login');

// Logou de Sesión
Route::post('v1/logout', 'LoginController@logout');


/* Sistema de Registro */
Route::resource('v1/user', 'UserController', ['only' => ['store', 'show'] ] );


//Route::resource('v1/user', 'UserController', ['only' => [ 'index', 'store', 'update', 'destroy', 'show' ] ]  );


//Route::auth();

//Route::get('/home', 'HomeController@index');
