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



/* Sistema de Autenficación */

// Inicio de sesión
Route::post('v1/login', 'LoginController@login');

// Cierre de sesión
Route::post('v1/logout', 'LoginController@logout');

/* Sistema de Registro */
Route::resource('v1/user', 'UserController', ['only' => ['store', 'show', 'update', 'index'] ] );

// Admin - Activar usuarios
Route::put('v1/user/activate/{id}', 'UserController@activate');

// Admin - Bloquear usuarios
Route::put('v1/user/toblock/{id}', 'UserController@toblock');

/* Crud de Tipo de usuarios */
Route::resource('v1/usertype', 'UserTypeController', ['only' => ['store', 'show', 'update', 'index', 'destroy'] ] );

Route::auth();

Route::group(['middleware' => ['web']], function () {


});

// Como Usuario Logueado
Route::group(['middleware' => 'auth'], function () {

    // Root
    Route::get('/', function () {
        return redirect()->to('/dashboard');
    });

    // Dashboard
    Route::get('/dashboard', 'DashBoardController@validateDashBoard');

    /* Administrador de Tipo de Especialización */
    Route::resource('/dashboard/tesp', 'EspecializacionTipoController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Especialización */
    Route::resource('/dashboard/esp', 'EspecializacionController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Módulos */
    Route::resource('/dashboard/modulo', 'ModuloController', ['only' => ['index','create','store','edit','update','destroy'] ] );



});
