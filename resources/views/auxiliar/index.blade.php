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
        <td>@{{ auxiliar }}</td>
        <td>
          <a href="auxiliar/@{{ id }}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
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
    <h1>Auxiliares</h1>
    <p style="margin-top: 15px">Administrador de Auxiliares.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <a href="{{ route('dashboard.auxiliar.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nombres y Apellidos</th>
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
  <script src="{{ URL::asset('assets/js/app-auxiliar-index.js') }}"></script>
@stop
