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
        <h1 style="font-size: 18px">Nuevo Tipo de Especialización <small> (En este interior usted podrá ingresar una nueva Especialización, editar los datos ingresados)</small></h1>
        <div class="clearfix"></div>
      </div>
      <br>

      {!! Form::open(['route' => 'dashboard.tesp.store', 'class' => 'form-horizontal form-label-left']) !!}

      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>¡Perfecto!</strong>{{ Session::get('message') }}
      </div>
      @endif

      <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_esp_tipo">Nombre</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="nom_esp_tipo" placeholder="Nombre de Tipo de espcialización" name="nom_esp_tipo"  class="form-control" value="{{ old('nom_esp_tipo') }}">
          @if ($errors->has('nom_esp_tipo'))
          <label for="nom_esp_tipo" generated="true" class="error">{{ $errors->first('nom_esp_tipo') }}</label>
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
            <a href="{{ route('dashboard.tesp.index') }}" class="btn btn-default">Retornar</a>
            <!--<a href="{{ route('dashboard.tesp.index') }}" class="btn btn-danger cancel_btn">Cancelar</a>-->
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop
