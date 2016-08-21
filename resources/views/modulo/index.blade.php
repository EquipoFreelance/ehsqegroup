@extends('dashboard.layouts.master')
@section('content')
<div class="">
  <div class="page-title">
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1>Módulos</h1>
    <p style="margin-top: 15px">Administrador de Módulos.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <a href="{{ route('dashboard.modulo.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <!--<th>Código</th>-->
                <th>Módulo</th>
                <th>Modalidad</th>
                <th>Tipo</th>
                <th>Especialización</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($modulos as $modulo)
                  <tr>
                    <!--<td>{{ $modulo->id }}</td>-->
                    <td>{{ $modulo->nombre }}</td>
                    <td>{{ $modulo->modalidad->nom_mod }}</td>
                    <td>{{ $modulo->tipo_especializacion->nom_esp_tipo }}</td>
                    <td>{{ $modulo->especializacion->nom_esp }}</td>
                    <td>
                      @if($modulo->activo == '1') <span class="label label-success">Activo</span> @else <span class="label label-danger">No activo</span> @endif
                    </td>
                    <td><a href="{{ route('dashboard.modulo.edit', $modulo->id) }}" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a></td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- FINAL TABLA FINAL -->
  </div>
</div>
@stop
