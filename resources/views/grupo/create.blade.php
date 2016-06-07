@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Módulos')

@section('sidebar_menu')
@include('dashboard.dashboard_sa_menu')
@stop

@section('content')

  {!! Form::open(['route' => 'dashboard.grupo.store', 'class' => 'form-horizontal form-label-left']) !!}
    Form::select('name', array('key' => 'value'), 'key', array('class' => 'name'));
  {!! Form::close() !!}

@stop
