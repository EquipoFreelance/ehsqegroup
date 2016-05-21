@extends('layouts.app_internas')

@section('title', 'Dashboard Secretaria Académica - Especializaciones')

@section('content')

  @include('dashboard.dash_welcome')

  @include('dashboard.dashboard_sa_menu')

  <a href="{{ route('dashboard.esp.create') }}">Crear</a><br>

  <h1>Listado de Especializaciones</h1><br>
  @if(Session::has('message'))
      <div class="alert alert-info">
          {{ Session::get('message') }}
      </div>
  @endif
  <ul>
    @foreach ($esps as $esp)
        <li>{{ $esp->nom_esp }} - {{ $esp->id }} <a href="{{ route('dashboard.esp.edit', $esp->id) }}">Editar</a></li>
    @endforeach
  </ul>
@stop
