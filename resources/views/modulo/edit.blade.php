@extends('layouts.app_internas')

@section('title', 'Dashboard Secretaria Académica - Tipo de Especialidades')

@section('content')

  @include('dashboard.dash_welcome')

  @include('dashboard.dashboard_sa_menu')

  <a href="#">Retornar</a><br>

  <h1>Editar Módulo</h1><br>

  @if(Session::has('message'))
      <div class="alert alert-info">
          {{ Session::get('message') }}
      </div>
  @endif

  {!! Form::model($modulo, [ 'method' => 'PUT', 'route' => ['dashboard.modulo.update', $modulo->id] ]) !!}

    Nombre:<input type="text" name="nombre"  value="{{ $modulo->nombre }}" >
    @if ($errors->has('nombre'))
        <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
        </span>
    @endif

    <br>

    Especialización:{{ Form::select('cod_esp', $especializacion, $modulo->cod_esp) }}<br>

    <br>
    Nombre Corto:<input type="text" name="nom_corto"  value="{{ $modulo->nom_corto }}" >
    @if ($errors->has('nom_corto'))
        <span class="help-block">
            <strong>{{ $errors->first('nom_corto') }}</strong>
        </span>
    @endif

    <br>

    Descripción:<textarea name="descripcion" id="descripcion">{{ $modulo->descripcion }}</textarea>
    @if ($errors->has('descripcion'))
        <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
        </span>
    @endif

    <br>

    <select name="activo" id="activo">
      <option value="-1" selected="selected">Seleccione {{ $modulo->activo }}</option>
      <option value="1"  @if ( $modulo->activo == 1) selected="selected" @else "" @endif >Activo</option>
      <option value="0"  @if ( $modulo->activo == 0) selected="selected" @else "" @endif >No Activo</option>
    </select>

    @if ($errors->has('activo'))
        <span class="help-block">
            <strong>{{ $errors->first('activo') }}</strong>
        </span>
    @endif

    <br>
    <button type="submit">Actualizar</button>
  {!! Form::close() !!}

  {!! Form::open([
              'method' => 'DELETE',
              'route' => ['dashboard.modulo.destroy', $modulo->id]
          ]) !!}
      <button type="submit">Eliminar</button>
  {!! Form::close() !!}

@stop
