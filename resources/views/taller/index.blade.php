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
    <h1>Talleres</h1>
    <p style="margin-top: 15px">Administrador de Talleres.</p>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <!-- INICIO TABLA FINAL -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
            <a href="{{ route('dashboard.taller.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Taller</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($talleres as $taller)
                  <tr data-id="{{ $taller->id }}">
                    <td class="data-cod" data-cod="{{ $taller->id }}">{{ $taller->id }}</td>
                    <td class="data-tipo" data-tipo="{{ $taller->nom_taller }}">{{ $taller->nom_taller }}</td>
                    <td class="data-acti" data-acti="{{ $taller->activo }}">
                      <span class="label @if($taller->activo == '1') label-success @else label-danger @endif ">
                        @if($taller->activo == '1') Activo @else No Activo @endif
                      </span>
                    </td>
                    <td><a href="{{ route('dashboard.taller.edit', $taller->id) }}" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a></td>
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
