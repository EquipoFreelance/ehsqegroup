@extends('dashboard.layouts.master')

@section('title', $title)

@section('sidebar_menu')
  @include('dashboard.menus.'.$menu)
@stop

@section('content')
  Datos Estádisticos
@stop
