@extends('dashboard.layouts.master')

@section('content')
  <div class="">
    <!-- Custom Templates -->
    <script id="response-template" type="text/x-handlebars-template">
      @{{#each response}}
        <tr>
          <td>@{{id}}</td>
          <td>@{{ created_at}}</td>
          <td>@{{ student.persona.num_doc}}</td>
          <td>@{{ student.persona.nombre}} @{{student.persona.ape_pat}} @{{student.persona.ape_mat}}</td>
          <td>@{{ student.persona.correo }}</td>
          <td>@{{ student.persona.num_phone  }} / @{{ student.persona.num_cellphone }}</td>
          <td>@{{ type_specialization.nom_esp_tipo }} / @{{ specialization.nom_esp }}</td>
          <td>@{{ modality.nom_mod }}</td>
          <td>
            @{{#validate activo 1}}
              <span class="label label-success">Matriculado</span>
            @{{else}}
              <span class="label label-danger">Por Matricular</span>
            @{{/validate}}
          </td>
          <td>
            <a href="enrollment/@{{id}}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
          </td>
        </tr>
      @{{/each}}
    </script>

    <div class="page-title">
      @if(Session::has('message'))
          <div class="alert alert-info">
              {{ Session::get('message') }}
          </div>
      @endif
      <h1>Matriculas</h1>
      <p style="margin-top: 15px">Administración de matriculas.</p>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- INICIO TABLA FINAL -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <!--<div class="x_title">
              <a href="{{ route('dashboard.enrollment.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
              <div class="clearfix"></div>
          </div>-->

          <div class="x_title">
              <form class="form-inline">
                <div class="form-group">
                    <label>Periódo Académico: </label>
                    <select class="form-control" name="id_academic_period" id="id_academic_period">
                      <option value="-">-- Seleccione el periodo académico --</option>
                    </select>
                  </div>
              </form>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-stripedx table-borderedx dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Fecha</th>
                  <th>DNI</th>
                  <th>Nombres Apellidos</th>
                  <th>Correos</th>
                  <th>Teléfonos</th>
                  <th>Tipo / Especialización</th>
                  <th>Modalidad</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="items">

              </tbody>
            </table>
          </div>

        </div>
      </div>
      <!-- FINAL TABLA FINAL -->
    </div>
  </div>
@stop

@section('custom_js')
  <script src="{{ URL::asset('assets/js/app.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-academic-period.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-templates-js.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-enrollments.js') }}"></script>
@stop
