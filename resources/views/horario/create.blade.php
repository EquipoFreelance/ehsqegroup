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
          <h1 style="font-size: 18px">Nuevo Horario <small> (En este interior usted podrá ingresar un Nuevo Horario, editar los datos ingresados)</small></h1>
          <div class="clearfix"></div>
        </div>

        <br>
        {!! Form::open(['route' => 'dashboard.horario.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <strong>¡Perfecto!</strong>{{ Session::get('message') }}
            </div>
          @endif


          <div class="form-group">
            {{ Form::hidden('cod_mod', 1) }}
            {{ Form::hidden('cod_esp_tipo', 1) }}
            {{ Form::hidden('cod_esp', 1) }}
          </div>

          <div class="form-group">
            {{ Form::label('cod_mod', 'Modulo:', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::select('cod_mod', $sedes, old('cod_mod'), ['class' => 'form-control horario_cod_local'] ) }}
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('cod_docente', 'Docente:', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::select('cod_docente', $sedes, old('cod_docente'), ['class' => 'form-control horario_cod_local'] ) }}
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('fec_inicio', 'Fecha de inicio:', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('fec_inicio', old('fec_inicio'), ['class' => 'form-control'] ) }}
              @if ($errors->has('fec_inicio'))
                <label for="fec_inicio" generated="true" class="error">{{ $errors->first('fec_inicio') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('fec_fin', 'Fecha de fin:', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('fec_fin', old('fec_fin'), ['class' => 'form-control'] ) }}
              @if ($errors->has('fec_fin'))
                <label for="fec_fin" generated="true" class="error">{{ $errors->first('fec_fin') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('num_horas', 'Número de horas:', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('num_horas', old('num_horas'), ['class' => 'form-control'] ) }}
              @if ($errors->has('num_horas'))
                <label for="num_horas" generated="true" class="error">{{ $errors->first('num_horas') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('cod_local', 'Local:', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::select('cod_local', $sedes, old('cod_local'), ['class' => 'form-control horario_cod_local'] ) }}
              @if ($errors->has('cod_local'))
              <label for="activo" generated="true" class="error">{{ $errors->first('cod_local') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Estado:</label>
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
                      <a href="{{ route('dashboard.horario.index') }}" class="btn btn-default">Retornar</a>
                      {{ Form::button('Guardar', array('class' => 'btn btn-success', 'type' => 'submit')) }}
                    </div>
                </div>
          </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
