@extends('dashboard.layouts.master')

@section('content')

<!-- Custom Templates -->
<script id="response-template" type="text/x-handlebars-template">
    @{{#each response}}
    <tr>
        <td>@{{ id }}</td>
        <td>@{{ fec_inicio}} al @{{ fec_fin}} / @{{ h_inicio }} - @{{ h_inicio }}</td>
        <td>@{{ docente.persona.nombre }} @{{ docente.persona.ape_pat  }} @{{ docente.persona.ape_mat }}</td>
        <td>@{{ local.nom_local }}</td>
        <td>@{{ modulo.nombre }}</td>
        <td>@{{ num_horas }}</td>
        <td>
            @{{#validate activo 1}}
            <span class="label label-success">Activo</span>
            @{{else}}
            <span class="label label-danger">No activo</span>
            @{{/validate}}
        </td>
        <td>
            <a href="enrollment/@{{id}}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
        </td>
    </tr>
    @{{/each}}
</script>

<div class="">
  <div class="page-title">
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1>Horarios</h1>
    <p style="margin-top: 15px">Administrador de Horarios.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

          <div class="x_title">
              <a href="{{ route('dashboard.academic_schedule.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
              <div class="clearfix"></div>
          </div>

          <div class="x_title">
              <div class="form-group">
                  <label>Grupos: </label>
                  <select class="form-control" name="id_group" id="id_group"></select>
              </div>
          </div>

          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Horario</th>
                <th>Docente</th>
                <th>Local</th>
                <th>Módulo</th>
                <th>Horas</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="items"></tbody>
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
    <script src="{{ URL::asset('assets/js/app-horary.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-templates-js.js') }}"></script>
@stop