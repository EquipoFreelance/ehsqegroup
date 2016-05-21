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

  {!! Form::model($te, [ 'method' => 'PUT', 'route' => ['dashboard.tesp.update', $te->id] ]) !!}

    <input type="text" name="nom_esp_tipo"  value="{{ $te->nom_esp_tipo }}" >

    @if ($errors->has('nom_esp_tipo'))
        <span class="help-block">
            <strong>{{ $errors->first('nom_esp_tipo') }}</strong>
        </span>
    @endif

    <br>

    <select name="activo" id="activo">
      <option value="-1" selected="selected">Seleccione</option>
      <option value="1"  @if ( $te->activo == 1) selected="selected" @else "" @endif >Activo</option>
      <option value="0"  @if ( $te->activo == 0) selected="selected" @else "" @endif >No Activo</option>
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
              'route' => ['dashboard.tesp.destroy', $te->id]
          ]) !!}
      <button type="submit">Eliminar</button>
  {!! Form::close() !!}

@stop
