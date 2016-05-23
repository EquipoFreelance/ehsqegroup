@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Docentes')

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
    <h1>Docentes</h1>
    <p style="margin-top: 15px">Administrador de Docentes.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <a href="{{ route('dashboard.docente.create') }}" class="btn btn-success">Agregar</a>
        <div class="ln_solid"></div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                 <th>Código</th>
                 <th>Foto</th>
                 <th>Nombre</th>
                 <th>Apellido</th>
                 <th>Correo electrónico</th>
                 <th>Teléfonos</th>
                 <th>Estado</th>
                 <th>Cursos asignados</th>
                 <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($docentes as $docente)
                <tr>
                   <td>{{ $docente->id }}</td>
                   <td><img src="{{ URL::asset('assets/images/users/img.jpg') }}" width="40px" height="40px"></td>
                   <td>{{ $docente->nombre }}</td>
                   <td>{{ $docente->ape_pat }} {{ $docente->ape_mat }}</td>
                   <td>{{ isset($docente->correos[0]) ? $docente->correos[0]->correo : '' }}</td>
                   <td>{{ isset($docente->telefonos[0]) ? $docente->telefonos[0]->correo : '' }}</td>
                   <td>@if($docente->activo == '1') Activo @else No Activo @endif</td>
                   <td><a href="javascript:void(0)" class="btn btn-link" data-toggle="modal" data-target="#cursosModal">Ver cursos</a></td>
                   <td><a href="{{ route('dashboard.docente.edit', $docente->id) }}" class="btn btn-link" data-toggle="modal" data-target="">Editar</a></td>
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
