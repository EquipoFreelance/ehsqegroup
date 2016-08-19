@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')
<div class="form_content_block">
  <div class="clearfix"></div>
  <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="x_panel">

      <div class="y_title">
         <h2><i class="fa fa-edit"></i> Nuevo Módulo</h2>
         <div class="clearfix"></div>
      </div>

      <div class="x_content">
      {!! Form::open(['route' => 'dashboard.modulo.store', 'class' => 'form-horizontal form-label-left']) !!}

      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>¡Perfecto!</strong>{{ Session::get('message') }}
      </div>
      @endif

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ old('nombre') }}">
          @if ($errors->has('nombre'))
          <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
          @endif
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label for="nom_corto">Nombre corto</label>
          <input type="text" id="nom_corto" placeholder="Nombre corto" name="nom_corto"  class="form-control" value="{{ old('nom_corto') }}">
          @if ($errors->has('nom_corto'))
          <label for="nom_corto" generated="true" class="error">{{ $errors->first('nom_corto') }}</label>
          @endif
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label for="nom_corto">Descripción</label>
          <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" >{{ old('descripcion') }}</textarea>
          @if ($errors->has('descripcion'))
          <label for="descripcion" generated="true" class="error">{{ $errors->first('nom_corto') }}</label>
          @endif
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label for="cod_esp">Especialización</label>
          {{ Form::select('cod_esp', $especializacion, old('cod_esp'), ['class' => 'form-control'] ) }}
          @if ($errors->has('cod_esp'))
          <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
          @endif
        </div>
      </div>

      <div class="checkbox">
          <div class="col-md-12 col-sm-12 col-xs-12">
            {{ $talleres }}
            @foreach ($talleres as $taller)
              <label>
                {{ Form::checkbox('cod_taller[]', $taller->id, null ,array('id' => 'cod_taller_'.$taller->id) ) }}
                {{ $taller['id'] }}
                <!--{{ Form::label('cod_taller_'.$taller['id'], $taller['id']) }}<br>-->
              </label>
            @endforeach

          </div>
      </div>

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label for="activo">Estado</label>
          {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], old('activo'), ['class' => 'form-control'] ) }}
          @if ($errors->has('activo'))
          <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
          @endif
        </div>
      </div>

      <div class="ln_solid"></div>

      <div class="form-group btncontrol">
        <a href="{{ route('dashboard.modulo.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
        <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
      </div>


      {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
</div>
@stop
