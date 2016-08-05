@extends('dashboard.layouts.master')

@section('title', Session::get('menu.dashboard.title')  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Session::get('menu.dashboard.menu')  )
@stop

@section('content')
  <div class="">

    <div class="page-title">
      @if(Session::has('message'))
          <div class="alert alert-info">
              {{ Session::get('message') }}
          </div>
      @endif
      <h1>Administrador de Inscritos</h1>
      <p style="margin-top: 15px">Información administrable de Inscritos.</p>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- INICIO TABLA FINAL -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <div class="x_title">
              <a href="{{ route('dashboard.inscription.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-stripedx table-borderedx dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Fecha Registro</th>
                  <th>Tipo documento</th>
                  <th>Número</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Modalidad</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="items">

              </tbody>
            </table>
          </div>

        </div>
      </div>
      <!-- FINAL TABLA FINAL -->
    </div>
  </div>
@stop

@section('custom_js')
  <!--<script src="{{ URL::asset('assets/js/app-templates-js.js') }}"></script>-->
  <!--<script src="{{ URL::asset('assets/js/app-students.js') }}"></script>-->
  <!--<script>
    listStudents();
  </script>-->
@stop
