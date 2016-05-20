@extends('layouts.app_internas')

@section('title', 'Dashboard')

@section('content')

Bienvenido: {{ Auth::user()->username }}<br>

<ul>
  <li>Menu Principal</li>
  <li><a href="#">Crear Tipo Especialidades</a></li>
  <li><a href="#">Crear Especialidades</a></li>
</ul>

@stop
