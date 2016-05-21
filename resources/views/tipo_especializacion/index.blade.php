@extends('layouts.app_internas')

@section('title', 'Dashboard Secretaria Académica - Tipo de Especialidades')

@section('content')

  @include('dashboard.dash_welcome')

  @include('dashboard.sa_admin_menu')

  <a href="tesp/create">Crear</a><br>

  <h1>Listado de Tipo de Especialidades </h1><br>
  @if(Session::has('message'))
      <div class="alert alert-info">
          {{ Session::get('message') }}
      </div>
  @endif
  <ul>
    @foreach ($esps_types as $esp_type)
        <li>{{ $esp_type->nom_esp_tipo }} - {{ $esp_type->id }} <a href="{{ route('dashboard.tesp.edit', $esp_type->id) }}">Editar</a></li>
    @endforeach
  </ul>
@stop
