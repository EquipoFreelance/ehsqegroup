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

        <a href="{{ route('dashboard.inscriptions.create') }}" class="btn btn-success">Agregar</a>
        <div class="ln_solid"></div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-stripedx table-borderedx dt-responsive nowrap" cellspacing="0" width="100%">
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
                    <td>{{ $persona->id }}</td>
                    <td>{{ $persona->created_at }}</td>
                    <td>{{ $persona->num_doc }}</td>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->ape_pat." ".$persona->ape_mat }}</td>
                    <td>
                      @foreach ($persona->persona_correos()->get() as $correo)
                        {{ $correo->correo }}
                      @endforeach
                    </td>
                    <td>
                      @foreach ($persona->persona_telefonos()->get() as $telefono)
                        {{ $telefono->num_telefono }}
                      @endforeach
                    </td>
                    <td>
                      <span class="label @if($persona->activo == '1') label-success @else label-danger @endif ">
                        @if($persona->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="{{ route('dashboard.inscriptions.edit', $persona->id) }}" class="btn btn-link">Editar</a></td>
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
