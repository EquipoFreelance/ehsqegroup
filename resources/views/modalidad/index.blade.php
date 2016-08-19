@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

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
    <h1>Modalidades</h1>
    <p style="margin-top: 15px">Administrador de Modalidades.</p>
  </div>
    <div class="clearfix"></div>
    <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
            <a href="{{ route('dashboard.modalidad.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
            <div class="clearfix"></div>
        </div>

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
              @foreach ($modalidades as $modalidad)
                  <tr data-id="{{ $modalidad->id }}">
                    <td class="data-cod" data-cod="{{ $modalidad->id }}">{{ $modalidad->id }}</td>
                    <td class="data-tipo" data-name="{{ $modalidad->nom_grupo }}">{{ $modalidad->nom_mod }}</td>
                    <td class="data-acti" data-acti="{{ $modalidad->activo }}">
                      <span class="label @if($modalidad->activo == '1') label-success @else label-danger @endif ">
                        @if($modalidad->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="{{ route('dashboard.modalidad.edit', $modalidad->id) }}" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a></td>
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
