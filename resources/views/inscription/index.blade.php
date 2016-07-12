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
    <h1>Inscripciones</h1>
    <p style="margin-top: 15px">Inscripciones.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <a href="#" class="btn btn-success">Agregar</a>
        <div class="ln_solid"></div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Id</th>
                <th>Fecha de registro</th>
                <th>DNI</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correos</th>
                <th>Teléfonos</th>
                <th>Modalidad</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($personas as $persona)

                  <tr data-id="{{ $persona->id }}">
                    <td class="data-cod" data-cod="{{ $persona->id }}">{{ $persona->id }}</td>
                    <td class="data-cod" data-cod="{{ $persona->created_at }}">{{ $persona->created_at }}</td>
                    <td class="data-cod" data-cod="{{ $persona->num_doc }}">{{ $persona->num_doc }}</td>
                    <td class="data-tipo" data-name="{{ $persona->nombre }}">{{ $persona->nombre }}</td>
                    <td class="data-tipo" data-name="{{ $persona->ape_pat." ".$persona->ape_mat }}">{{ $persona->ape_pat." ".$persona->ape_mat }}</td>
                    <td class="data-tipo" data-name="{{ $persona->persona_correos->first() }}">
                      @foreach ($persona->persona_correos()->get() as $correo)
                        {{ $correo->correo }}
                      @endforeach
                    </td>
                    <td class="data-tipo" data-name="{{ $persona->persona_telefonos->first() }}">
                      @foreach ($persona->persona_telefonos()->get() as $telefono)
                        {{ $telefono->num_telefono }}
                      @endforeach
                    </td>
                    <td class="data-acti" data-acti="{{ $persona->activo }}">
                      <span class="label @if($persona->activo == '1') label-success @else label-danger @endif ">
                        @if($persona->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="#" class="btn btn-link">Editar</a></td>
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
