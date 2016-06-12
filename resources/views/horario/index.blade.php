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
    <h1>Módulos</h1>
    <p style="margin-top: 15px">Administrador de Horarios.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <a href="{{ route('dashboard.horario.create') }}" class="btn btn-success">Agregar</a>
        <div class="ln_solid"></div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Horario</th>
                <th>Dirección</th>
                <th>Horas</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($horarios as $horario)
                  <tr data-id="{{ $horario->id }}">
                    <td class="data-cod" data-cod="{{ $horario->id }}">{{ $horario->id }}</td>
                    <td class="data-tipo" data-tipo="{{ $horario->fec_inicio }}">{{ $horario->fec_inicio }} - {{ $horario->fec_fin }} / {{ $horario->h_inicio }} - {{ $horario->h_fin }}</td>
                    <td>{{ $horario->cod_sede }} / {{ $horario->cod_local }} / {{ $horario->direccion }}</td>
                    <td>{{ $horario->num_horas }}</td>
                    <td class="data-acti" data-acti="{{ $horario->activo }}">
                      <span class="label @if($horario->activo == '1') label-success @else label-danger @endif ">
                        @if($horario->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="{{ route('dashboard.horario.edit', $horario->id) }}" class="btn btn-link">Editar</a></td>
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
