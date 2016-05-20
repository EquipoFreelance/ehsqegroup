@extends('layouts.app_internas')

@section('title', 'Dashboard')

@section('content')

Bienvenido Colaborador: {{ Auth::user()->username }}<br>

<ul>
  <li>Menu Principal</li>
  <li><a href="/dashboard/tesp">Administrar Tipo Especialidades</a></li>
  <li><a href="#">Administrar Especialidades</a></li>
</ul>

@stop
