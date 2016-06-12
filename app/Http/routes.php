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



/* Sistema de Autentificación */

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


    /* -- Routes - Recursos -- */

    /* Administrador de Modalidades */
    Route::resource('/dashboard/modalidad', 'ModalidadController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Tipo de Especialización */
    Route::resource('/dashboard/tesp', 'EspecializacionTipoController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Especialización */
    Route::resource('/dashboard/esp', 'EspecializacionController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Módulos */
    Route::resource('/dashboard/modulo', 'ModuloController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Persona */
    //Route::resource('/dashboard/persona', 'PersonaController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Sedes */
    Route::resource('/dashboard/sede', 'SedeController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    /* Administrador de Locales */
    Route::resource('/dashboard/sede/local', 'SedeLocalController', ['only' => ['index','create','store','edit','update','destroy', 'horario'] ] );

    /* Administrador de Horarios */
    Route::resource('/dashboard/horario', 'HorarioController', ['only' => ['index','create','store','edit','update','destroy', 'horario'] ] );

    /* Administrador de Grupos */
    Route::resource('/dashboard/grupo', 'GrupoController', ['only' => ['index','create','store','edit','update','destroy'] ] );


    /* -- Routes - Personalizados -- */

    /* Administrador de Docentes */

    // Listado de Docentes
    Route::get('/dashboard/docente',[
      'as' => 'dashboard.docente.index', 'uses' => 'DocenteController@index'
    ]);

    // Mostrar formulario para almacenar docentes
    Route::get('/dashboard/docente/create',[
      'as' => 'dashboard.docente.create', 'uses' => 'DocenteController@create'
    ]);

    // Store docente
    Route::post('/dashboard/docente',[
      'as' => 'dashboard.docente.store', 'uses' => 'PersonaController@store'
    ]);

    // Edit Docente
    Route::get('/dashboard/docente/{id}',[
      'as' => 'dashboard.docente.edit', 'uses' => 'DocenteController@edit'
    ]);

    //  Update Docente
    Route::put('/dashboard/docente/{id}',[
      'as' => 'dashboard.docente.update', 'uses' => 'PersonaController@update'
    ]);

    /* Grupos - Horarios */

    // Listado de Horarios
    Route::get('/dashboard/grupo/{id}/horario',[
      'as' => 'dashboard.grupo.horario.list',
      'uses' => 'HorarioController@getHorarioList'
    ]);

    // Crear Horarios
    Route::get('/dashboard/grupo/{id}/horario/crear',[
      'as' => 'dashboard.grupo.horario.crear',
      'uses' => 'HorarioController@getCreateHorario'
    ]);

    /* Rutas asíncronas */
    Route::get('/dashboard/json/esp/{modalidad}/{tipo_esp}', [
        'as' => 'json.esp', 'uses' => 'EspecializacionController@getJsonEspToGrupo'
    ]);

});
