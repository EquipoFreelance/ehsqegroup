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

    // Filtro Sistema Academico

    Route::group(['middleware' => ['auth','admin']], function(){

        // Redirect Dashboard
        Route::get('/', function () {
            return redirect()->to('/dashboard');
        });

        // Dashboard
        Route::get('/dashboard', 'DashBoardController@validateDashBoard');

    });

    Route::group(['middleware' => ['auth','admin']], function(){

      /* -- Routes - Recursos -- */

      // Administrador de Modalidades
      Route::resource('/dashboard/modalidad', 'ModalidadController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Tipo de Especialización
      Route::resource('/dashboard/tesp', 'EspecializacionTipoController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Especialización
      Route::resource('/dashboard/esp', 'EspecializacionController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Módulos
      Route::resource('/dashboard/modulo', 'ModuloController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Sedes
      Route::resource('/dashboard/sede', 'SedeController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Locales
      Route::resource('/dashboard/sede/local', 'SedeLocalController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Horarios
      Route::resource('/dashboard/horario', 'HorarioController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Grupos
      Route::resource('/dashboard/grupo', 'GrupoController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Auxiliares
      Route::resource('/dashboard/auxiliar', 'AuxiliarController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      // Administrador de Docentes
      Route::resource('/dashboard/docente', 'DocenteController', ['only' => ['index','create','store','edit','update','destroy'] ] );

      /* -- Routes - Personalizados -- */

      /* Grupos > Horarios */

      // Listado de Horarios
      Route::get('/dashboard/grupo/{id}/horario',[
        'as' => 'dashboard.grupo.horario.list',
        'uses' => 'HorarioController@index'
      ]);

      // Create Horario
      Route::get('/dashboard/grupo/{id}/horario/crear',[
        'as' => 'dashboard.grupo.horario.crear',
        'uses' => 'HorarioController@create'
      ]);

      // Edit Horario
      Route::get('/dashboard/grupo/{id}/horario/{cod_horario}/edit',[
        'as' => 'dashboard.grupo.horario.edit',
        'uses' => 'HorarioController@edit'
      ]);

      /* Rutas asíncronas */
      Route::get('/dashboard/json/esp/{modalidad}/{tipo_esp}', [
          'as' => 'json.esp', 'uses' => 'EspecializacionController@getJsonEspToGrupo'
      ]);

    });

});
