@extends('dashboard.layouts.master')
@section('content')
<div class="form_content_block">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="y_title">
          <h2><i class="fa fa-edit"></i>Editar</h2>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">

        {!! Form::model($esp, [ 'method' => 'PUT', 'route' => ['dashboard.esp.update', $esp->id], 'class' => 'form-horizontal form-label-left' ]) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>¡Perfecto!</strong>{{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="cod_esp_tipo">Modalidad</label>
            {{ Form::select('cod_mod', $modalidades, $esp->cod_mod, ['class' => 'form-control']) }}
            @if ($errors->has('cod_mod'))
              <label for="cod_mod" generated="true" class="error">{{ $errors->first('cod_mod') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 col-sm-21 col-xs-12">
            <label for="cod_esp_tipo">Tipo de especialización</label>
            {{ Form::select('cod_esp_tipo', $types, $esp->cod_esp_tipo, ['class' => 'form-control']) }}
            @if ($errors->has('cod_esp_tipo'))
              <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="nom_esp_tipo">Nombre</label>
            <input type="text" id="nom_esp" placeholder="Nombre" name="nom_esp"  class="form-control" value="{{ $esp->nom_esp }}">
            @if ($errors->has('nom_esp'))
            <label for="nom_esp" generated="true" class="error">{{ $errors->first('nom_esp') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="nom_esp_tipo">Nombre corto</label>
            <input type="text" id="nom_corto" placeholder="Nombre corto" name="nom_corto"  class="form-control" value="{{ $esp->nom_corto }}">
            @if ($errors->has('nom_corto'))
            <label for="nom_corto" generated="true" class="error">{{ $errors->first('nom_corto') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" placeholder="Descripción">{{ $esp->descripcion }}</textarea>
            @if ($errors->has('descripcion'))
            <label for="descripcion" generated="true" class="error">{{ $errors->first('descripcion') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="activo">Estado</label>
            {{ Form::select('activo', [1 => 'Activo', 0 => 'No Activo'], $esp->activo, ['class' => 'form-control'] ) }}
            @if ($errors->has('activo'))
              <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
            @endif
          </div>
        </div>

        <div class="ln_solid"></div>

        <div class="form-group btncontrol">
          <a href="{{ route('dashboard.esp.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
          <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
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
  </div>
</div>
@stop
