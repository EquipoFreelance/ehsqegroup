@extends('layouts.app_internas')

@section('title', 'Dashboard Secretaria Académica - Tipo de Especialidades')

@section('content')

  @include('dashboard.dash_welcome')

  @include('dashboard.sa_admin_menu')

  <a href="#">Retornar</a><br>

  <h1>Crear Nuevo Tipo de Especialización</h1><br>

  @if(Session::has('message'))
      <div class="alert alert-info">
          {{ Session::get('message') }}
      </div>
  @endif

  {!! Form::open(['route' => 'dashboard.tesp.store']) !!}

    <input type="text" name="nom_esp_tipo"  value="{{ old('nom_esp_tipo') }}" >
    @if ($errors->has('nom_esp_tipo'))
        <span class="help-block">
            <strong>{{ $errors->first('nom_esp_tipo') }}</strong>
        </span>
    @endif

    <br>

    <select name="activo" id="activo">
      <option value="-1" selected="selected">Seleccione {{ old('activo') }}</option>
      <option value="1"  @if ( old('activo') == 1) selected="selected" @else "" @endif >Activo</option>
      <option value="0"  @if ( old('activo') == 0) selected="selected" @else "" @endif >No Activo</option>
    </select>

    @if ($errors->has('activo'))
        <span class="help-block">
            <strong>{{ $errors->first('activo') }}</strong>
        </span>
    @endif

    <br>
    <button type="submit">Crear</button>
  {!! Form::close() !!}

@stop
