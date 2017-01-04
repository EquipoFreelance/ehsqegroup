@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
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
          <td>@{{ modality }}</td>
          <td>@{{ specialty }}</td>
          <td>@{{ period_academic }}</td>
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
              <a href="/inscription/create/{{ Auth::user()->id  }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
              <input type="hidden" name="created_by" id="created_by" value="{{ Auth::user()->id  }}" >
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-stripedx table-borderedx dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Fecha creación</th>
                  <th>Inscrito</th>
                  <th>Correo</th>
                  <th>Modalidad</th>
                  <th>Tipo de Especialidad</th>
                  <th>Especialidad</th>
                  <th>Periódo</th>
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
