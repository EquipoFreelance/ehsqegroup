@extends('layouts.app_internas')

@section('title', 'Dashboard')

@section('content')

<!-- Seccion de bienvenida -->
<img src="https://doktuz.com/icon_usuarios/b9c55ab7d80b70440fcceb2c69adea12.0ae92886072bdc4c1585ddc77e4eb7de.png">
Bienvenido: {{ Auth::user()->username }}<br>

<ul>
  <li>Menu Principal</li>
  <li><a href="#">Crear Tipo Especialidades</a></li>
  <li><a href="#">Crear Especialidades</a></li>
</ul>

@stop
