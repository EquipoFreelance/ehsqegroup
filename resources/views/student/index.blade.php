@extends('dashboard.layouts.master')
@section('content')
  <div class="">
    <!-- Custom Templates -->
    <script id="response-template" type="text/x-handlebars-template">
      @{{#each response}}
        <tr>
          <td>@{{ id }}</td>
          <td>@{{ created_at }}</td>
          <td>@{{ persona.num_doc }}</td>
          <td>@{{ persona.nombre }} @{{ persona.ape_pat }} @{{ persona.ape_mat }}</td>
          <td>@{{ persona.correo }}</td>
          <td>@{{ persona.num_phone  }} / @{{ persona.num_cellphone }}</td>
          <td>
            <a href="student/@{{id}}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
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
      <h1>Alumnos</h1>
      <p style="margin-top: 15px">Información administrable de Alumnos.</p>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- INICIO TABLA FINAL -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <div class="x_title">
              <a href="{{ route('dashboard.student.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
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
  <script src="{{ URL::asset('assets/js/app-templates-js.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-students.js') }}"></script>
  <script>
    listStudents();
  </script>
@stop
