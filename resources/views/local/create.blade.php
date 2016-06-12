@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Módulos')

@section('sidebar_menu')
@include('dashboard.dashboard_sa_menu')
@stop

@section('content')
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="x_title">
          <h1 style="font-size: 18px">Nuevo Local <small> (En este interior usted podrá ingresar una nueva Sede, editar los datos ingresados)</small></h1>
          <div class="clearfix"></div>
        </div>

        <br>
        {!! Form::open(['route' => 'dashboard.sede.local.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <strong>¡Perfecto!</strong>{{ Session::get('message') }}
            </div>
          @endif

          <div class="form-group">
            {{ Form::label('cod_sede', 'Sede:', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::select('cod_sede', $sedes, old('cod_sede'), ['class' => 'form-control'] ) }}
              @if ($errors->has('cod_sede'))
                <label for="cod_sede" generated="true" class="error">{{ $errors->first('cod_sede') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('nom_local', 'Nombre del Local', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('nom_local', old('nom_local'), ['class' => 'form-control'] ) }}
              @if ($errors->has('nom_local'))
                <label for="nom_local" generated="true" class="error">{{ $errors->first('nom_local') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('direccion', 'Dirección', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('direccion', old('direccion'), ['class' => 'form-control'] ) }}
              @if ($errors->has('direccion'))
                <label for="nom_local" generated="true" class="error">{{ $errors->first('direccion') }}</label>
              @endif
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Estado</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], old('activo'), ['class' => 'form-control'] ) }}
              @if ($errors->has('activo'))
              <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
              @endif
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group btncontrol">
                      <a href="{{ route('dashboard.sede.index') }}" class="btn btn-default">Retornar</a>
                      {{ Form::button('Guardar', array('class' => 'btn btn-success', 'type' => 'submit')) }}
                    </div>
                </div>
          </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
