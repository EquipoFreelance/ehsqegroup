@extends('layouts.app_internas')

@section('title', 'Dashboard')

@section('content')

Bienvenido: {{ Auth::user()->username }}<br>

<ul>
  <li>Menu Principal</li>
  <li><a href="#">Crear Tipo Especialidades</a></li>
  <li><a href="#">Crear Especialidades</a></li>
</ul>

<h1>Listado de Tipo de Especialidades</h1>
  @foreach ($esps_types as $esp_type)
      <p>Tipo Especialidad: {{ $esp_type->name }} con identificador: {{ $esp_type->id }}</p>
  @endforeach

@stop
