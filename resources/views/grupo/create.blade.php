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
          <h1 style="font-size: 18px">Nuevo Grupo <small> (En este interior usted podrá ingresar una nuevo Grupo, editar los datos ingresados)</small></h1>
          <div class="clearfix"></div>
        </div>

        <br>
        {!! Form::open(['route' => 'dashboard.grupo.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <strong>¡Perfecto!</strong>{{ Session::get('message') }}
            </div>
          @endif

          <div class="form-group">
            {{ Form::label('cod_sede', 'Sede', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::select('cod_sede', $sedes, old('cod_sede'), ['class' => 'form-control'] ) }}
              @if ($errors->has('cod_sede'))
                <label for="cod_sede" generated="true" class="error">{{ $errors->first('cod_sede') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('nom_grupo', 'Nombre del grupo', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('nom_grupo', old('nom_grupo'), ['class' => 'form-control'] ) }}
              @if ($errors->has('nom_grupo'))
                <label for="nom_grupo" generated="true" class="error">{{ $errors->first('nom_grupo') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('descripcion', 'Descripción', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::textarea('descripcion', old('descripcion'), ['class' => 'form-control'] ) }}
              @if ($errors->has('descripcion'))
                <label for="descripcion" generated="true" class="error">{{ $errors->first('descripcion') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('fe_inicio', 'Fecha de inicio', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('fe_inicio', old('fe_inicio'), ['class' => 'form-control'] ) }}
              @if ($errors->has('fe_inicio'))
                <label for="fe_inicio" generated="true" class="error">{{ $errors->first('fe_inicio') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('fe_fin', 'Fecha de fin', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('fe_fin', old('fe_fin'), ['class' => 'form-control'] ) }}
              @if ($errors->has('fe_fin'))
                <label for="fe_fin" generated="true" class="error">{{ $errors->first('fe_fin') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('num_max', 'Número máximo', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('num_max', old('num_max'), ['class' => 'form-control'] ) }}
              @if ($errors->has('num_max'))
                <label for="num_max" generated="true" class="error">{{ $errors->first('num_max') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('num_min', 'Número mínimo', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('num_min', old('num_min'), ['class' => 'form-control'] ) }}
              @if ($errors->has('num_min'))
                <label for="num_min" generated="true" class="error">{{ $errors->first('num_min') }}</label>
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
                      <a href="{{ route('dashboard.grupo.index') }}" class="btn btn-default">Retornar</a>
                      {{ Form::button('Guardar', array('class' => 'btn btn-success', 'type' => 'submit')) }}
                    </div>
                </div>
          </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
