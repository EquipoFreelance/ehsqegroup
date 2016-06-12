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
    <h1>Locales</h1>
    <p style="margin-top: 15px">Administrador de Locales.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <a href="{{ route('dashboard.sede.local.create') }}" class="btn btn-success">Agregar</a>
        <div class="ln_solid"></div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($locales as $local)
                  <tr data-id="{{ $local->id }}">
                    <td class="data-cod" data-cod="{{ $local->id }}">{{ $local->id }}</td>
                    <td class="data-tipo" data-name="{{ $local->nom_local }}">{{ $local->sede->nom_sede }} - {{ $local->nom_local }}</td>
                    <td class="data-acti" data-acti="{{ $local->activo }}">
                      <span class="label @if($local->activo == '1') label-success @else label-danger @endif ">
                        @if($local->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="{{ route('dashboard.sede.local.edit', $local->id) }}" class="btn btn-link">Editar</a></td>
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
