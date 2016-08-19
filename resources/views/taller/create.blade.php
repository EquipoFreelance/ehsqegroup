@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')
<div class="form_content_block">
  <div class="clearfix"></div>
  <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="x_panel">
      <div class="y_title">
        <h2><i class="fa fa-edit"></i> Nuevo Taller</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
      {!! Form::open(['route' => 'dashboard.taller.store', 'class' => 'form-horizontal form-label-left']) !!}

      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>¡Perfecto!</strong>{{ Session::get('message') }}
      </div>
      @endif

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label for="nombre">Nombre del Taller</label>
          <input type="text" id="nom_taller" placeholder="Nombre del Taller" name="nom_taller"  class="form-control" value="{{ old('nom_taller') }}">
          @if ($errors->has('nom_taller'))
          <label for="nom_taller" generated="true" class="error">{{ $errors->first('nom_taller') }}</label>
          @endif
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label for="activo">Estado</label>
          {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], old('activo'), ['class' => 'form-control'] ) }}
          @if ($errors->has('activo'))
          <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
          @endif
        </div>
      </div>

      <div class="ln_solid"></div>

      <div class="form-group btncontrol">
        <a href="{{ route('dashboard.taller.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
        <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
      </div>

      {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
</div>
@stop
