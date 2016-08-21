@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')
<div class="form_content_block">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="y_title">
          <h2><i class="fa fa-edit"></i>Editar</h2>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          {!! Form::model($te, [ 'method' => 'PUT', 'route' => ['dashboard.tesp.update', $te->id], 'class' => 'form-horizontal form-label-left' ]) !!}

          @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>¡Perfecto!</strong>{{ Session::get('message') }}
          </div>
          @endif

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="nom_esp_tipo">Nombre</label>
              <input type="text" id="nom_esp_tipo" placeholder="Nombre de Tipo de espcialización" name="nom_esp_tipo"  class="form-control" value="{{ $te->nom_esp_tipo }}">
              @if ($errors->has('nom_esp_tipo'))
              <label for="nom_esp_tipo" generated="true" class="error">{{ $errors->first('nom_esp_tipo') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="activo">Estado</label>
              {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], $te->activo, ['class' => 'form-control'] ) }}
              @if ($errors->has('activo'))
              <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
              @endif
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group btncontrol">
            <a href="{{ route('dashboard.tesp.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
            <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
          </div>

          {!! Form::close() !!}

          {!! Form::open([
                      'method' => 'DELETE',
                      'route' => ['dashboard.tesp.destroy', $te->id]
                  ]) !!}
              <button type="submit" class="btn btn-danger cancel_btn">Eliminar</button>
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@stop
