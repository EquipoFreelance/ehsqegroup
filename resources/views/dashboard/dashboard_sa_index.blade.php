@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica')

@section('sidebar_menu')
@include('dashboard.dashboard_sa_menu')
@stop

@section('content')
<div class="page-title">
  <h1>Listado de Especialización</h1>
  <p style="margin-top: 15px">En este interior usted podrá ingresar una nueva Especialización, editar los datos ingresados, realizar la búsqueda de alguna de las Especializaciones, Exportar a Excel, Imprimir y generar un archivo PDF.</p>
</div>
<div class="clearfix"></div>
<div class="row">
  <!-- INICIO TABLA FINAL -->
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

      <a href="listado_especializacion_acciones.html" class="btn btn-success">Agregar Especialización</a>
      <div class="ln_solid"></div>
      <div class="x_content">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Código</th>
              <th>Especialización</th>
              <th>Tipo Especialización</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr data-id="1">
              <td class="data-cod" data-cod="DEGCIA">DEGCIA</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE CALIDAD E INOCUIDAD ALIMENTARIA">DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE CALIDAD E INOCUIDAD ALIMENTARIA</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="2">
              <td class="data-cod" data-cod="DEGDCMSS">DEGDCMSS</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE LA CALIDAD, MEDIO AMBIENTE, SEGURIDAD Y SALUD OCUPACIONAL">DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE LA CALIDAD, MEDIO AMBIENTE, SEGURIDAD Y SALUD OCUPACIONAL</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="2"><span class="label label-danger">Inactivo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="3">
              <td class="data-cod" data-cod="DEGCP">DEGCP</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE CALIDAD Y PROCESOS">DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE CALIDAD Y PROCESOS</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="4">
              <td class="data-cod" data-cod="DESSMA">DESSMA</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD, SALUD OCUPACIONAL Y MEDIO AMBIENTE">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD, SALUD OCUPACIONAL Y MEDIO AMBIENTE</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="5">
              <td class="data-cod" data-cod="DESISO">DESISO</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD INDUSTRIAL Y SALUD OCUPACIONAL">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD INDUSTRIAL Y SALUD OCUPACIONAL</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="6">
              <td class="data-cod" data-cod="DESSMA">DESSMA</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD, SALUD OCUPACIONAL Y MEDIO AMBIENTE">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD, SALUD OCUPACIONAL Y MEDIO AMBIENTE</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="7">
              <td class="data-cod" data-cod="DESISO">DESISO</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD INDUSTRIAL Y SALUD OCUPACIONAL">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD INDUSTRIAL Y SALUD OCUPACIONAL</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="8">
              <td class="data-cod" data-cod="DEGDCMSS">DEGDCMSS</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD, SALUD OCUPACIONAL Y MEDIO AMBIENTE">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD, SALUD OCUPACIONAL Y MEDIO AMBIENTE</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="9">
              <td class="data-cod" data-cod="DESSMA">DESSMA</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE LA CALIDAD, MEDIO AMBIENTE, SEGURIDAD Y SALUD OCUPACIONAL">DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE LA CALIDAD, MEDIO AMBIENTE, SEGURIDAD Y SALUD OCUPACIONAL</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="10">
              <td class="data-cod" data-cod="DESST">DESST</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD Y SALUD EN EL TRABAJO">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD Y SALUD EN EL TRABAJO</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="11">
              <td class="data-cod" data-cod="DPRLPSC">DPRLPSC</td>
              <td class="data-name" data-name="DIPLOMA DE PREVENCIÓN DE RIESGOS LABORALES PARA EL SECTOR CONSTRUCCIÓN">DIPLOMA DE PREVENCIÓN DE RIESGOS LABORALES PARA EL SECTOR CONSTRUCCIÓN</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="12">
              <td class="data-cod" data-cod="DESISO">DESISO</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD INDUSTRIAL Y SALUD OCUPACIONAL">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD INDUSTRIAL Y SALUD OCUPACIONAL</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="13">
              <td class="data-cod" data-cod="DEIPRLSC">DEIPRLSC</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN PREVENCION DE RIESGOS LABORALES EN EL SECTOR DE CONSTRUCCIÓN">DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN PREVENCION DE RIESGOS LABORALES EN EL SECTOR DE CONSTRUCCIÓN</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="14">
              <td class="data-cod" data-cod="DEISSTM">DEISSTM</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN SEGURIDAD Y SALUD EN EL TRABAJO EN MINERA">DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN SEGURIDAD Y SALUD EN EL TRABAJO EN MINERA</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="15">
              <td class="data-cod" data-cod="DEISIG">DEISIG</td>
              <td class="data-name" data-name="DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN SISTEMAS INTEGRADOS DE GESTIÓN">DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN SISTEMAS INTEGRADOS DE GESTIÓN</td>
              <td class="data-esp" data-esp="3">Diploma</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>

            <tr data-id="16">
              <td class="data-cod" data-cod="CGRS">CGRS</td>
              <td class="data-name" data-name="CURSO DE GESTION DE RESIDUOS SOLIDOS">CURSO DE GESTION DE RESIDUOS SOLIDOS</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="17">
              <td class="data-cod" data-cod="CILNO">CILNO</td>
              <td class="data-name" data-name="CURSO DE INTERPRETACIÓN DE LA NORMA OHSAS 18001:2007">CURSO DE INTERPRETACIÓN DE LA NORMA OHSAS 18001:2007</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="2"><span class="label label-danger">Inactivo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="18">
              <td class="data-cod" data-cod="CIDLNI">CIDLNI</td>
              <td class="data-name" data-name="CURSO DE INTERPRETACIÓN DE LA NORMA ISO 9001.2015">CURSO DE INTERPRETACIÓN DE LA NORMA ISO 9001.2015</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="19">
              <td class="data-cod" data-cod="CIDUSIG">CIDUSIG</td>
              <td class="data-name" data-name="CURSO DE INTEGRACION DE UN SISTEMA INTEGRADO DE GESTION">CURSO DE INTEGRACION DE UN SISTEMA INTEGRADO DE GESTION</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="20">
              <td class="data-cod" data-cod="CIDLNII">CIDLNI</td>
              <td class="data-name" data-name="CURSO DE INTERPRETACIÓN DE LA NORMA ISO/IEC 17025">CURSO DE INTERPRETACIÓN DE LA  NORMA  ISO/ IEC  17025</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="6">
              <td class="data-cod" data-cod="CSGAINI">CSGAINI</td>
              <td class="data-name" data-name="CURSO DE SISTEMA DE GESTIÓN AMBIENTAL, INTERPRETACIÓN DE LA NORMA ISO 14001: 2015">CURSO DE SISTEMA DE GESTIÓN AMBIENTAL, INTERPRETACIÓN DE LA NORMA ISO 14001: 2015</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="21">
              <td class="data-cod" data-cod="CHDM">CHDM</td>
              <td class="data-name" data-name="CURSO DE HERRAMIENTAS DE MEJORA">CURSO DE HERRAMIENTAS DE MEJORA</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="22">
              <td class="data-cod" data-cod="CGDLSO">CGDLSO</td>
              <td class="data-name" data-name="CURSO DE GESTION DE LA SALUD OCUPACIONAL">CURSO DE GESTION DE LA SALUD OCUPACIONAL</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="23">
              <td class="data-cod" data-cod="CPRAE">CPRAE</td>
              <td class="data-name" data-name="CURSO DE PLAN DE RESPUESTAS A EMERGENCIAS">CURSO DE PLAN DE RESPUESTAS A EMERGENCIAS</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="24">
              <td class="data-cod" data-cod="CFAI">CFAI</td>
              <td class="data-name" data-name="CURSO DE FORMACION DE AUDITORES INTERNOS">CURSO DE FORMACION DE AUDITORES INTERNOS</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="25">
              <td class="data-cod" data-cod="CAO">CAO</td>
              <td class="data-name" data-name="CURSO DE AGENTES OCUPACIONALES">CURSO DE AGENTES OCUPACIONALES</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="26">
              <td class="data-cod" data-cod="CCROSGSS">CCROSGSS</td>
              <td class="data-name" data-name="CURSO DE CONTROL DE RIESGOS OPERCIONALES DE UN SISTEMA DE GESTION SSOMA">CURSO DE CONTROL DE RIESGOS OPERCIONALES DE UN SISTEMA DE GESTION SSOMA</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
            <tr data-id="27">
              <td class="data-cod" data-cod="CGBEC">CGBEC</td>
              <td class="data-name" data-name="CURSO DE GESTION BASADA EN EL COMPARTIMIENTO">CURSO DE GESTION BASADA EN EL COMPARTIMIENTO</td>
              <td class="data-esp" data-esp="2">Curso</td>
              <td class="data-acti" data-acti="1"><span class="label label-success">Activo</span></td>
              <td><a href="listado_especializacion_acciones.html" class="btn btn-link">Editar</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- FINAL TABLA FINAL -->
</div>

@stop
