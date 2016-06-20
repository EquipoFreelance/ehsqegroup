@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Módulos')

@section('sidebar_menu')
@include('dashboard.dashboard_sa_menu')
@stop

@section('content')
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

        <a href="{{ route('dashboard.grupo.horario.crear', $id) }}" class="btn btn-success">Agregar</a>
        <div class="ln_solid"></div>
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
            <tbody>
              @foreach ($horarios as $horario)
                <tr>
                   <td>{{ $horario->id }}</td>
                   <td>{{ $horario->fec_inicio }} y {{ $horario->fec_fin }} / {{ $horario->h_inicio }} - {{ $horario->h_inicio }}</td>
                   <td>{{ $horario->docente->persona->nombre.", ".$horario->docente->persona->ape_pat." ".$horario->docente->persona->ape_mat }}</td>
                   <td>{{ $horario->local->nom_local }}</td>
                   <td>{{ $horario->modulo->nombre }}</td>
                   <td>{{ $horario->num_horas }}</td>
                   <td>@if($horario->activo == '1') Activo @else No Activo @endif</td>
                   <td><a href="{{ route('dashboard.grupo.horario.edit', array("id" => $id, 'cod_horario' => $horario->id ) ) }}" class="btn btn-link">Editar</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- FINAL TABLA FINAL -->
  </div>

@stop
