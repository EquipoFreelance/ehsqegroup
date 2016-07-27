@extends('dashboard.layouts.master')

@section('title', Session::get('menu.dashboard.title')  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Session::get('menu.dashboard.menu')  )
@stop

@section('content')
  Datos Estádisticos
@stop
