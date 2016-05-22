@extends('layouts.app_internas')

@section('title', 'Dashboard Secretaria Académica - Módulos')

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

        {!! Form::model($modulo, [ 'method' => 'PUT', 'route' => ['dashboard.modulo.update', $modulo->id], 'class' => 'form-horizontal form-label-left' ]) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>¡Perfecto!</strong>{{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nombre">Nombre</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ $modulo->nombre }}">
            @if ($errors->has('nombre'))
            <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_corto">Nombre corto</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nom_corto" placeholder="Nombre corto" name="nom_corto"  class="form-control" value="{{ $modulo->nom_corto }}">
            @if ($errors->has('nom_corto'))
            <label for="nom_corto" generated="true" class="error">{{ $errors->first('nom_corto') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="descripcion">Descripción</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" >{{ $modulo->descripcion }}</textarea>
            @if ($errors->has('descripcion'))
            <label for="descripcion" generated="true" class="error">{{ $errors->first('descripcion') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_esp">Especialización</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('cod_esp', $especializacion, $modulo->cod_esp, ['class' => 'form-control'] ) }}
            @if ($errors->has('cod_esp'))
            <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Estado</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], $modulo->activo, ['class' => 'form-control'] ) }}
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
              <a href="{{ route('dashboard.modulo.index') }}" class="btn btn-default">Retornar</a>
              <!--<a href="{{ route('dashboard.tesp.index') }}" class="btn btn-danger cancel_btn">Cancelar</a>-->
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
        {!! Form::close() !!}

        {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['dashboard.modulo.destroy', $modulo->id]
                ]) !!}
            <button type="submit" class="btn btn-danger cancel_btn">Eliminar</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

@stop
