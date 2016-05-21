@extends('layouts.app_internas')

@section('title', 'Dashboard Secretaria Académica - Modulos')

@section('content')

  @include('dashboard.dash_welcome')

  @include('dashboard.dashboard_sa_menu')

  <a href="{{ route('dashboard.modulo.create') }}">Crear</a><br>

  <h1>Listado de Modulos</h1><br>
  @if(Session::has('message'))
      <div class="alert alert-info">
          {{ Session::get('message') }}
      </div>
  @endif
  <ul>
    @foreach ($modulos as $modulo)
        <li>{{ $modulo->nombre }} - {{ $modulo->id }} <a href="{{ route('dashboard.modulo.edit', $modulo->id) }}">Editar</a></li>
    @endforeach
  </ul>
@stop
