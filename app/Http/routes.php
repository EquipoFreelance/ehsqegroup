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

Route::auth();


// Dashboard
Route::group(['middleware' => ['auth']], function(){

    // Redirect Dashboard
    Route::get('/', function () {
        return redirect()->to('/dashboard');
    });

    /*Route::get('/info', function () {
        phpinfo();
    });*/

    // Dashboard
    Route::get('/dashboard', 'DashBoardController@validateDashBoard', ['as' => 'dashboard.index']);

    // Administrador de Perfil
    Route::resource('/dashboard/profile', 'ProfileController', ['only' => ['edit', 'update'] ] );

    Route::put('/dashboard/user/changepassword',[
      'as' => 'dashboard.user.update', 'uses' => 'UserController@putChangePassword'
    ]);

});

// Sistema Académicos
Route::group(['middleware' => ['auth','role.academica']], function(){

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
  Route::resource('/dashboard/academic_schedule', 'HorarioController', ['only' => ['index', 'create', 'store'] ] );

  // Administrador de Grupos
  Route::resource('/dashboard/grupo', 'GrupoController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    // Administrador de Horarios

    // index
    Route::get('/dashboard/grupo/{id}/horario',[
        'as' => 'dashboard.grupo.horario.list', 'uses' => 'HorarioController@index'
    ]);

    // create
    Route::get('/dashboard/grupo/{id}/horario/crear',[
        'as' => 'dashboard.grupo.horario.crear', 'uses' => 'HorarioController@create'
    ]);

    // edit
    Route::get('/dashboard/grupo/{id}/horario/{cod_horario}/edit',[
        'as' => 'dashboard.grupo.horario.edit', 'uses' => 'HorarioController@edit'
    ]);

    Route::get('/dashboard/grupo/{id_group}/horario/testing',[
        'uses' => 'HorarioController@testing'
    ]);

  // Administrador de Auxiliares
  Route::resource('/dashboard/auxiliar', 'AuxiliarController', ['only' => ['index','create','store','edit','update','destroy'] ] );

  // Administrador de Docentes
  Route::resource('/dashboard/docente', 'DocenteController', ['only' => ['index','create','store','edit','update','destroy'] ] );

  // Administrador de talleres
  Route::resource('/dashboard/taller', 'TallerController', ['only' => ['index','create','store','edit','update','destroy'] ] );

  // Resources Students
  Route::resource('dashboard/student', 'StudentController', ['only' => ['create','store','show','index','edit','update'] ]);

  // Recursos Enrollments
  Route::resource('dashboard/enrollment', 'EnrollmentController', ['only' => ['create','store','show','index','edit','update'] ]);

  // Recursos Enrollments
  Route::resource('dashboard/academic_period', 'AcademicPeriodController', ['only' => ['create','store','show','index','edit','update'] ]);

  /* -- Routes - Personalizados -- */



});

// Marketing
Route::group(['middleware' => ['auth','role.marketing']], function(){

  // Recursos de Inscripciones
  Route::resource('dashboard/inscription', 'InscriptionController', ['only' => ['create','store','show','index','edit','update'] ]);

});

// Sistema Docentes
Route::group(['middleware' => ['auth','role.docente']], function(){

  // Recursos de Report Card
  Route::resource('dashboard/teacher/report-card', 'ReportCardController', ['only' => ['create','store','show','index','edit','update'] ]);

  // Recursos de Assistance
  Route::resource('dashboard/teacher/assistance', 'AssistanceController', ['only' => ['create','store','show','index','edit','update'] ]);


});

// Sistema Alumnos
Route::group(['middleware' => ['auth','role.alumno']], function(){

});

// Sistemas
Route::group(['middleware' => ['auth','role.sistema']], function(){

});


    /* -- Rutas asíncronas -- */

    Route::get('/dashboard/json/esp/{modalidad}/{tipo_esp}', [
        'as' => 'json.esp', 'uses' => 'EspecializacionController@getJsonEspToGrupo'
    ]);

    Route::get('/dashboard/json/ub/countries',[
        'as' => 'json.countries', 'uses' => 'WebServiceController@wsCountries'
    ]);

    // Ub Departamentos
    Route::get('/dashboard/json/departaments/{cod_pais}',[
        'as' => 'json.departaments', 'uses' => 'WebServiceController@wsDepartaments'
    ]);

    // Ub Provincias
    Route::get('/dashboard/json/provinces/{cod_dpto}',[
        'as' => 'json.provinces', 'uses' => 'WebServiceController@wsProvinces'
    ]);

    // Ub Distritos
    Route::get('/dashboard/json/districts/{cod_dpto}/{cod_prov}',[
        'as' => 'json.districts', 'uses' => 'WebServiceController@wsDistricts'
    ]);

    // Tipo de Especializaciones
    Route::get('/dashboard/json/esp_tipos',[
        'as' => 'json.esp_tipos', 'uses' => 'WebServiceController@wsEspecializacionTipos'
    ]);

    // Especializaciones
    Route::get('/dashboard/json/especializaciones/{cod_esp_tipo}',[
        'as' => 'json.especializaciones', 'uses' => 'WebServiceController@wsEspecializaciones'
    ]);

    // Modulos
    Route::get('/dashboard/json/modulos/{cod_modalidad}/{cod_esp_tipo}/{cod_esp}/{q}',[
        'as' => 'json.modulos', 'uses' => 'WebServiceController@wsModulos'
    ]);

    // Modulos - Groups of attributes with parameteres
    Route::get('/api/horary-modules/{cod_group}',[
        'as' => 'json.modulos', 'uses' => 'WebServiceController@GetHoraryModules'
    ]);

    // Modalidades
    Route::get('/dashboard/json/modalidades',[
        'as' => 'json.modalidades', 'uses' => 'WebServiceController@wsModalidades'
    ]);

    // Enrollments
    Route::get('/dashboard/json/enrollments/{fecha_inicio}',[
        'as' => 'json.enrollments', 'uses' => 'WebServiceController@wsEnrollments'
    ]);

    // Inscriptions
    Route::get('/dashboard/json/inscriptions/{fecha_inicio}',[
        'as' => 'json.enrollments', 'uses' => 'WebServiceController@wsInscriptions'
    ]);

    // Students
    Route::get('/hsqegroup/api/students',[
        'as' => 'json.students.all', 'uses' => 'WebServiceController@wsStudent'
    ]);

    // Busqueda de Estudiante
    Route::get('/hsqegroup/api/students/search/{q}',[
        'as' => 'json.students.all', 'uses' => 'WebServiceController@wsStudentLike'
    ]);

    // Get List Periodo Academico
    Route::get('/hsqegroup/api/academic-period',[
        'as' => 'json.academic-period.all', 'uses' => 'WebServiceController@getWsAcademicPeriod'
    ]);

    // Get List Groups
    Route::get('/hsqegroup/api/groups', [
        'as' => 'json.groups.all', 'uses' => 'WebServiceController@getWsGroups'
    ]);

    // Get List Horarios Academicos
    Route::get('/hsqegroup/api/academic-horary/{cod_grupo}', [
        'as' => 'json.groups.all', 'uses' => 'WebServiceController@getWsAcademicHorary'
    ]);

    // Get LIst Groups Like by Name
    Route::get('/hsqegroup/api/groups/search/{q}', [
        'as' => 'json.groups.all', 'uses' => 'WebServiceController@getWsGroupsLike'
    ]);

    // Get List Docentes Like by Name
    Route::get('/hsqegroup/api/teachers/search/{q}', [
        'as' => 'json.teacher.all', 'uses' => 'WebServiceController@getWsTeachersLike'
    ]);

    // Get List Docentes All
    Route::get('/api/horary-teachers/{cod_teacher}', [
        'as' => 'json.teacher.all', 'uses' => 'WebServiceController@getWsTeachers'
    ]);

    // Get List Auxiliares Like by Name
    Route::get('/hsqegroup/api/auxiliary/search/{q}', [
        'as' => 'json.teacher.all', 'uses' => 'WebServiceController@getWsAuxiliaryLike'
    ]);

    // Get List Auxiliares All
    Route::get('/api/horary-auxiliary/{cod_teacher}', [
        'as' => 'json.teacher.all', 'uses' => 'WebServiceController@getWsAuxiliary'
    ]);