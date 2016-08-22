@extends('dashboard.layouts.master')

@section('content')
<div class="">
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

          <div class="x_title">
              <a href="{{ route('dashboard.docente.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
              <div class="clearfix"></div>
          </div>

          <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                 <th>Código</th>
                 <th>Nombre</th>
                 <th>Apellidos</th>
                 <th>Estado</th>
                 <th>Cursos asignados</th>
                 <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($docentes as $docente)
                <tr>
                   <td>{{ $docente->id }}</td>
                   <td>{{ $docente->persona->nombre }}</td>
                   <td>{{ $docente->persona->ape_pat }} {{ $docente->persona->ape_mat }}</td>
                   <td>
                       @if($docente->activo == '1')
                           <span class="label label-success">Activo</span>
                       @else
                           <span class="label label-danger">No activo</span>
                       @endif
                   </td>
                   <td><a href="javascript:void(0)" class="btn btn-5 btn-5a icon-edit edit"><span>Ver cursos</span></a></td>
                   <td><a href="{{ route('dashboard.docente.edit', $docente->id) }}" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a></td>
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
