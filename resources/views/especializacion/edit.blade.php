@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Crear un Tipo de especialización')

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
          <h1 style="font-size: 18px">Editar Especialización <small> (En este interior usted podrá ingresar una nueva Especialización, editar los datos ingresados)</small></h1>
          <div class="clearfix"></div>
        </div>
        <br>

        {!! Form::model($esp, [ 'method' => 'PUT', 'route' => ['dashboard.esp.update', $esp->id], 'class' => 'form-horizontal form-label-left' ]) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>¡Perfecto!</strong>{{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_esp_tipo">Nombre</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nom_esp" placeholder="Nombre" name="nom_esp"  class="form-control" value="{{ $esp->nom_esp }}">
            @if ($errors->has('nom_esp'))
            <label for="nom_esp" generated="true" class="error">{{ $errors->first('nom_esp') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_esp_tipo">Nombre corto</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nom_corto" placeholder="Nombre corto" name="nom_corto"  class="form-control" value="{{ $esp->nom_corto }}">
            @if ($errors->has('nom_corto'))
            <label for="nom_corto" generated="true" class="error">{{ $errors->first('nom_corto') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="descripcion">Descripción</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea class="form-control" name="descripcion" placeholder="Descripción">{{ $esp->descripcion }}</textarea>
            @if ($errors->has('descripcion'))
            <label for="descripcion" generated="true" class="error">{{ $errors->first('descripcion') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_esp_tipo">Tipo de especialización</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('cod_esp_tipo', $types, $esp->cod_esp_tipo, ['class' => 'form-control']) }}
            @if ($errors->has('cod_esp_tipo'))
            <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Estado</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('activo', [1 => 'Activo', 0 => 'No Activo'], $esp->activo, ['class' => 'form-control'] ) }}
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
              <a href="{{ route('dashboard.esp.index') }}" class="btn btn-default">Retornar</a>
              <!--<a href="{{ route('dashboard.tesp.index') }}" class="btn btn-danger cancel_btn">Cancelar</a>-->
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
        {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['dashboard.esp.destroy', $esp->id]
                ]) !!}
            <button type="submit" class="btn btn-danger cancel_btn">Eliminar</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>


@stop
