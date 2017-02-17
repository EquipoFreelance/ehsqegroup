@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('custom_css')

  <!-- CSS Plugin DatePicker Material -->
  <link href="{{ URL::asset('assets/js/datepicker_material/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@stop

@section('content')
  <div class="">

    <!-- Custom Templates -->
    <script id="response-template" type="text/x-handlebars-template">
      @{{#each response}}
      <tr>
        <td>@{{ id }}</td>
        <td>@{{ created_at }}</td>
        <td>@{{ student }}</td>
        <td>@{{ email }}</td>
        <td>@{{ modality }}</td>
        <td>@{{ type_specialty }}</td>
        <td>@{{ specialty }}</td>
        <td>@{{ academic_period }}</td>
        <td>@{{ creation_date }}</td>
        <td>
          <a href="inscription/@{{ id }}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
        </td>
      </tr>
      @{{/each}}
    </script>

    <div class="page-title">
      @if(Session::has('message'))
        <div class="alert @if(Session::has('class')) {{ Session::get('class') }} @else alert-info @endif ">
          {{ Session::get('message') }}
        </div>
      @endif

      <h1>Inscripciones realizadas</h1>
      <p style="margin-top: 15px">Listado de las inscripciones</p>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- INICIO TABLA FINAL -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <div class="x_title">

            <a href="/dashboard/inscription/create" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
            <br>
            <br>

            <p>
                <span style="color: #333;">
                  Copiar y pegar el link para enviar a los clientes:
                  <input type="text" name=""  class="form-control"  value="http://intranetehsq.ehsqgroup.com/inscription?created_by={{ Auth::user()->id  }}">

                  <span>
                        <form class="form-inline">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Desde:</label>
                            <input type="text" name="date_from" id="date_from" placeholder="YYYY-MM-DD" class="form-control">
                          <label class="mr-sm-2" for="inlineFormCustomSelect">Hasta:</label>
                            <input type="text" name="date_to" id="date_to" placeholder="YYYY-MM-DD" class="form-control">
                            <button name="filter" id="filter" class="btn btn-primary">Filtrar</button>
                        </form>
                  </span>

                </span>
            </p>
            <input type="hidden" name="created_by" id="created_by" value="{{ Auth::user()->id  }}" >
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!--class="display nowrap" cellspacing="0" width="100%"> dt-responsive-->
            <table id="datatable-responsive" class="display table table-stripedx table-borderedx nowrap" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>N°</th>
                <th>Fecha creación</th>
                <th>Ejecutiva comercial</th>
                <th>Fecha de inicio</th>
                <th>Dni</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Modalidad</th>
                <th>Tipo de Especialidad</th>
                <th>Especialidad</th>
                <th>Forma de Pago</th>
                <th>Ingreso en Efectivo</th>
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
  <script src="{{ URL::asset('assets/js/app-inscription-index.js') }}"></script>
@stop
