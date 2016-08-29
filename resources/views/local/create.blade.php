@extends('dashboard.layouts.master')

@section('content')
  <div class="form_content_block">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="x_title">
          <h1 style="font-size: 18px">Nuevo</h1>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
        {!! Form::open(['route' => 'dashboard.sede.local.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{ Session::get('message') }}
            </div>
          @endif

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                {{ Form::label('cod_sede', 'Sede:') }}
                {{ Form::select('cod_sede', $sedes, old('cod_sede'), ['class' => 'form-control'] ) }}
                @if ($errors->has('cod_sede'))
                  <label for="cod_sede" generated="true" class="error">{{ $errors->first('cod_sede') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                {{ Form::label('nom_local', 'Nombre del Local') }}
                {{ Form::text('nom_local', old('nom_local'), ['class' => 'form-control'] ) }}
                @if ($errors->has('nom_local'))
                  <label for="nom_local" generated="true" class="error">{{ $errors->first('nom_local') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                {{ Form::label('direccion', 'Dirección') }}
                {{ Form::text('direccion', old('direccion'), ['class' => 'form-control'] ) }}
                @if ($errors->has('direccion'))
                  <label for="nom_local" generated="true" class="error">{{ $errors->first('direccion') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="activo">Estado</label>
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
