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
Route::pattern('id', '[0-9]+');

// Dashboard
Route::group(['middleware' => ['auth']], function(){

    // Redirect Dashboard
    Route::get('/', function () {
        return redirect()->to('/dashboard');
    });

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
  Route::resource('/dashboard/academic_schedule', 'HorarioController', ['only' => ['index', 'create', 'store', 'edit', 'update'] ] );

    Route::get('/dashboard/academic_schedule/{cod_group}',[
        'as' => 'dashboard.academic_schedule.horario.group', 'uses' => 'HorarioController@getIndexHorarios'
    ]);

  // Administrador de Grupos
  Route::resource('/dashboard/grupo', 'GrupoController', ['only' => ['index','create','store','edit','update','destroy'] ] );

    // Administrador de Horarios

    // index
    Route::get('/dashboard/grupo/{id}/horario',[
        'as' => 'dashboard.grupo.horario.list', 'uses' => 'HorarioController@index'
    ]);

    Route::get('/dashboard/grupo/{cod_grupo}/students',[
        'as' => 'dashboard.grupo.students.list', 'uses' => 'StudentController@getIndexGroup'
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

// Ventas
Route::group(['middleware' => ['auth','role.marketing']], function(){


    // Recursos de Inscripcion
    Route::resource('dashboard/inscription',
        'InscriptionController',
            array(
                'only' => ['index', 'edit', 'update', 'create', 'show' ]
            )
        );


});


// Sistema Docentes
Route::group(['middleware' => ['auth','role.docente']], function(){

    // Recursos de Report Card
    Route::resource('dashboard/teacher/report-card', 'ReportCardController', ['only' => ['create','store','show','index','edit','update'] ]);

    // Recursos de Assistance
    Route::resource('dashboard/teacher/assistance', 'AssistanceController', ['only' => ['create','store','show','index','edit','update'] ]);

    // GET - Lista de Horarios Disponibles por docente
    Route::get('dashboard/teacher/academic_schedule', [
        'as' => 'teacher.academic_schedule.index', 'uses' => 'HorarioController@getIndexProfesor'
    ]);

    // GET - Lista de Horarios Disponibles por docente
    Route::get('dashboard/teacher/academic_schedule/{id}/edit', [
        'as' => 'teacher.academic_schedule.edit', 'uses' => 'HorarioController@getEditProfesor'
    ]);

    // GET - Lista de Horarios Disponibles por docente
    Route::put('dashboard/teacher/academic-schedule/update/{id}', [
        'as' => 'teacher.academic_schedule.update', 'uses' => 'HorarioController@putUpdateProfesor'
    ]);


});

// Sistema Alumnos
Route::group(['middleware' => ['auth','role.alumno']], function(){

});

    /* --  Modulo / Creditos y Cobranzas -- */

    /* -- Dashboard - Creditos y Cobranzas -- */

        Route::group(['middleware' => ['auth','role.creditos']], function(){

            // Recursos de Creditos y cobranzas
            Route::resource('dashboard/creditos', 'CreditosCobranzasController', ['only' => ['index'] ]);

            // Recursos Validación de Pagos
            Route::get('dashboard/creditos/verify-payment/{id_enrollment}/show', [
                'as' => 'dashboard.creditos.verify-payment', 'uses' => 'CreditosCobranzasController@getVerifyPayment'
            ]);

        });

    /* -- Dashboard - Creditos y Cobranzas -- */


    /* -- Service Validate Payment -- */

        // Show Payment
        Route::get('/hsqegroup/services/validate-payment/show/{id_enrollment}', [
            'as' => 'hsqegroup.services.validate-payment.show', 'uses' => 'WebService\WSValidatePaymentController@showPaymentOfInscription'
        ]);

        // Store Payment
        Route::post('/hsqegroup/services/validate-payment/store', [
            'as' => 'hsqegroup.services.validate-payment.store', 'uses' => 'WebService\WSValidatePaymentController@storeValidatePayment'
        ]);

    /* -- Service Validate Payment --*/



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

    // Lista de Alumnos dentro del grupo
    Route::get('/hsqegroup/api/groups/{cod_grupo}/students', [
        'as' => 'json.groups.students.assigned', 'uses' => 'WebService\WSGroupController@getWsGroupsAssignedStudents'
    ]);

    // Búsqueda de Alumnos quienes tienen la matricula asociada con los parametros del grupo
    Route::get('/hsqegroup/api/groups/students/search/{cod_grupo}/{q}',[
        'as' => 'api.groups.students.search', 'uses' => 'WebService\WSGroupController@wsStudentGroupLike'
    ]);

    // Asignamiento de Matriculas
    Route::post('/hsqegroup/api/groups/students/assign',[
        'as' => 'api.groups.students.assign', 'uses' => 'WebService\WSGroupController@postWsStoreAssignGroup'
    ]);

    // Get List Horarios Academicos
    Route::get('/hsqegroup/api/academic-horary/{cod_grupo}', [
        'as' => 'json.groups.all', 'uses' => 'WebServiceController@getWsAcademicHorary'
    ]);

    // Get List Horarios Academico para docentes
    Route::get('/hsqegroup/api/teacher/academic-horary/{id_academic_period}/{cod_docente}', [
        'as' => 'json.teacher.academic-horary', 'uses' => 'WebServiceController@getWsScheduleAvailable'
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
    Route::get('/api/horary-auxiliary/{cod_auxiliar}', [
        'as' => 'json.teacher.all', 'uses' => 'WebServiceController@getWsAuxiliary'
    ]);

    // Get List Document Type
    Route::get('/api/document_type', [
        'as' => 'json.teacher.all', 'uses' => 'WebService\WSDocumentTypeController@getIndex'
    ]);

    // Get List Group Teacher
    Route::get('/api/report-card/group-teacher/{id_person}', [
        'as' => 'json.group-teacher.all', 'uses' => 'WebService\WSGroupController@GrouTeacher'
    ]);

    // Get List Group Horary
    Route::get('/api/report-card/group-horary-modules/{id_group}/{id_person}', [
        'as' => 'json.group-teacher.all', 'uses' => 'WebService\WSGroupController@GroupHoraryModulo'
    ]);

    // Get Group Enrollments
    Route::get('/api/report-card/group-enrollment/{id_group}/{id_module}', [
        'as' => 'json.group-teacher.all', 'uses' => 'WebService\WSReportCardController@ReportCardEnrollment'
    ]);

    // Get Group Enrollments
    Route::post('/api/teacher/report-card/store', [
        'as' => 'json.group-teacher.all', 'uses' => 'WebService\WSReportCardController@ReporteCardStore'
    ]);

    /* -- Module Inscription  -- */

    // Store Forma de Pago
    Route::post('/hsqegroup/services/inscription/store/payment-method',[
        'as' => 'hsqegroup.services.inscription.store.payment-method', 'uses' => 'WebService\WSInscriptionController@storePaymentMethod'
    ]);

    // Show Inscription
    Route::get('/hsqegroup/services/inscription/show/{id_enrollment}',[
        'as' => 'hsqegroup.student.payment-method', 'uses' => 'WebService\WSInscriptionController@showInscription'
    ]);

    // Store Enrollment Billing Client
    Route::post('/hsqegroup/services/inscription/store/billing-client',[
        'as' => 'hsqegroup.services.inscription.store.billing-client', 'uses' => 'WebService\WSInscriptionController@storeBillingClient'
    ]);

/* Api Inscription */

Route::group(['prefix' => 'api/', 'middleware' => ['web']], function() {

    Route::resource("inscription", 'WebService\ResourceInscriptionController', ['only' => ['store','update'] ]);

});

// Ruta de Publica del Formulario
Route::get('inscription', ['uses' => 'InscriptionController@getPublicCreate']);


/* -- Path Api Rest Service -- */

// Inscriptions
Route::resource('/api/inscriptions',
    'WebService\ResourceInscriptionController',
    array(
        'only' => ['store', 'index']

    )
);


// Califications
Route::resource('/api/califications',
    'WebService\CalificationController',
    array(
        'only' => ['store']
    )
);

