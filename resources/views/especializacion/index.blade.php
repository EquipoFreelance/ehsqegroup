@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Especialización')

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
    <h1>Listado de Especializaciones</h1>
    <p style="margin-top: 15px">En este interior usted podrá ingresar una nueva Especialización, editar los datos ingresados, realizar la búsqueda de alguna de las Especializaciones, Exportar a Excel, Imprimir y generar un archivo PDF.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <a href="{{ route('dashboard.esp.create') }}" class="btn btn-success">Agregar</a>
        <div class="ln_solid"></div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Especialización</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($esps as $esp)
                  <tr data-id="{{ $esp->id }}">
                    <td class="data-cod" data-cod="{{ $esp->id }}">{{ $esp->id }}</td>
                    <td class="data-tipo" data-tipo="{{ $esp->esptipo->nom_esp_tipo }}">{{ $esp->esptipo->nom_esp_tipo }}</td>
                    <td class="data-name" data-name="{{ $esp->nom_esp_tipo }}">{{ $esp->nom_esp }}</td>
                    <td class="data-acti" data-acti="{{ $esp->activo }}">
                      <span class="label @if($esp->activo == '1') label-success @else label-danger @endif ">
                        @if($esp->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="{{ route('dashboard.esp.edit', $esp->id) }}" class="btn btn-link">Editar</a></td>
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
