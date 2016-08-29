@extends('dashboard.layouts.master')

@section('content')
<div class="form_content_block">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="x_title">
          <h1 style="font-size: 18px">Crear</h1>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
        {!! Form::open(['route' => 'dashboard.sede.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <strong>¡Perfecto!</strong>{{ Session::get('message') }}
            </div>
          @endif

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                {{ Form::label('nom_sede', 'Nombre de la sede') }}
                {{ Form::text('nom_sede', old('nom_sede'), ['class' => 'form-control', 'placeholder' => 'Nombre de la sede'] ) }}
                @if ($errors->has('nom_sede'))
                  <label for="nom_sede" generated="true" class="error">{{ $errors->first('nom_sede') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <labelfor="activo">Estado</label>
                {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], old('activo'), ['class' => 'form-control'] ) }}
                @if ($errors->has('activo'))
                <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="ln_solid"></div>

          <div class="form-group btncontrol">
            <a href="{{ route('dashboard.sede.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
            <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
          </div>

         {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@stop
