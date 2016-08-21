@extends('dashboard.layouts.master')

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')
<div class="">
  <div class="page-title">
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1>Tipo de especializaciones</h1>
    <p style="margin-top: 15px">Administrador de Tipo de especializaciones.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <a href="{{ route('dashboard.tesp.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Tipo Especialización</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($esps_types as $esp_type)
                  <tr>
                    <td>{{ $esp_type->id }}</td>
                    <td>{{ $esp_type->nom_esp_tipo }}</td>
                    <td>
                      <span class="label @if($esp_type->activo == '1') label-success @else label-danger @endif ">
                        @if($esp_type->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="{{ route('dashboard.tesp.edit', $esp_type->id) }}" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
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
