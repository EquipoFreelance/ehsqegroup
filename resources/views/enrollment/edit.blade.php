@extends('layouts.layout-enrollments')

@section('title', 'Dashboard - Secretaria Académica Módulos')

@section('sidebar_menu')
  @include('dashboard.dashboard_sa_menu')
@stop

@section('content')
  <div class="form_content_block">
    <div class="clearfix"></div>
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-edit"></i> Editar Matricula</h2>
           <div class="clearfix"></div>
        </div>
        <br>
        <div class="x_content">

        {!! Form::model($enrollment, [ 'method' => 'PUT', 'route' => ['dashboard.enrollment.update', $enrollment->id], 'class' => 'form-horizontal form-label-left' ]) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>¡Perfecto!</strong>{{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="fecha_inicio">Fecha de Inicio</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="fecha_inicio" id="fecha_inicio" data-id-default="{{ $enrollment->fecha_inicio }}">
              <option value="">-- Seleccione la fecha de inicio --</option>
              <option value="2016-07-16">2016-07-16</option>
              <option value="2016-07-12">2016-07-12</option>
            </select>
            @if ($errors->has('fecha_inicio'))
            <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('fecha_inicio') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_modalidad">Modalidad</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_modalidad" id="cod_modalidad" data-id-default="{{ $enrollment->cod_modalidad }}"><option value="">-- Seleccione la modalidad --</option></select>
            @if ($errors->has('cod_modalidad'))
            <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('cod_modalidad') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_esp_tipo">Tipo de Especialización</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_esp_tipo" id="cod_esp_tipo" data-id-default="{{ $enrollment->cod_esp_tipo }}"><option>-- Seleccione el tipo de especialización --</option></select>
            @if ($errors->has('cod_esp_tipo'))
            <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_esp">Especialización</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_esp" id="cod_esp" data-id-default="{{ $enrollment->cod_esp }}"><option value="">-- Seleccione la especialización --</option></select>
            @if ($errors->has('cod_esp'))
            <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Validar matricula</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::checkbox('activo', 1, ($enrollment->activo == 1)? true : false ) }}
            @if ($errors->has('activo'))
            <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
            @endif
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-12" style="float: right">
            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.enrollment.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
              <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
            </div>
          </div>
        </div>
        {!! Form::close() !!}

      </div>

      </div>
    </div>
  </div>
  </div>
@stop

@section('custom_js')
  <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@stop
