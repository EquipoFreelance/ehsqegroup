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
          <h1 style="font-size: 18px">Editar Sede <small> (En este interior usted podrá ingresar una nueva Sede, editar los datos ingresados)</small></h1>
          <div class="clearfix"></div>
        </div>

        <br>
        {!! Form::model($sede, [ 'method' => 'PUT', 'route' => ['dashboard.sede.update', $sede->id], 'class' => 'form-horizontal form-label-left' ]) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <strong>¡Perfecto!</strong>{{ Session::get('message') }}
            </div>
          @endif


          <div class="form-group">
            {{ Form::label('nom_sede', 'Nombre de la sede', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('nom_sede', $sede->nom_sede, ['class' => 'form-control'] ) }}
              @if ($errors->has('nom_sede'))
                <label for="nom_sede" generated="true" class="error">{{ $errors->first('nom_sede') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Estado</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], $sede->activo, ['class' => 'form-control'] ) }}
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

        {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['dashboard.sede.destroy', $sede->id]
                ]) !!}
            <button type="submit" class="btn btn-danger cancel_btn">Eliminar</button>
        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
