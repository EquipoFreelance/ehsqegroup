@extends('layouts.app_internas')

@section('title', 'Dashboard Secretaria Académica - Crear una especialización')

@section('content')

  @include('dashboard.dash_welcome')

  @include('dashboard.dashboard_sa_menu')

  <a href="#">Retornar</a><br>

  <h1>Editar Especialización</h1><br>

  @if(Session::has('message'))
      <div class="alert alert-info">
          {{ Session::get('message') }}
      </div>
  @endif

  {!! Form::model($esp, [ 'method' => 'PUT', 'route' => ['dashboard.esp.update', $esp->id] ]) !!}

    <input type="text" name="nom_esp"  value="{{ $esp->nom_esp }}" >
    @if ($errors->has('nom_esp'))
        <span class="help-block">
            <strong>{{ $errors->first('nom_esp') }}</strong>
        </span>
    @endif
    <br>

    <input type="text" name="nom_corto"  value="{{ $esp->nom_corto }}" >
    @if ($errors->has('nom_corto'))
        <span class="help-block">
            <strong>{{ $errors->first('nom_corto') }}</strong>
        </span>
    @endif
    <br>

    <textarea name="descripcion" id="descripcion">{{ $esp->descripcion }}</textarea>

    @if ($errors->has('descripcion'))
        <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
        </span>
    @endif
    <br>

    <select name="activo" id="activo">
      <option value="-1" selected="selected">Seleccione {{ $esp->activo }}</option>
      <option value="1"  @if ( $esp->activo == 1) selected="selected" @else "" @endif >Activo</option>
      <option value="0"  @if ( $esp->activo == 0) selected="selected" @else "" @endif >No Activo</option>
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
              'route' => ['dashboard.esp.destroy', $esp->id]
          ]) !!}
      <button type="submit">Eliminar</button>
  {!! Form::close() !!}


@stop
