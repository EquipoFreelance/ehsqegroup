@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Módulos')

@section('sidebar_menu')
@include('dashboard.dashboard_sa_menu')
@stop

@section('content')

  @if(Session::has('message'))
    <br><br>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>¡Perfecto! </strong>{{ Session::get('message') }}
    </div>
  @endif

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="x_title">
          <h1 style="font-size: 18px">Edit Profile <small></small></h1>
          <div class="clearfix"></div>
        </div>

        {!! Form::model($profile, [ 'method' => 'PUT', 'route' => ['dashboard.profile.update', $profile->id], 'class' => 'form-horizontal form-label-left', 'files'=>true ]) !!}
          <br>
          <div class="form-group">
            {{ Form::label('fullname', 'Nombre del usuario', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::text('fullname', $profile->fullname, ['class' => 'form-control'] ) }}
              @if ($errors->has('fullname'))
                <label for="fullname" generated="true" class="error">{{ $errors->first('fullname') }}</label>
              @endif
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('avatar', 'Avatar', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
              <br>
              <img src="{{ URL::asset( $profile->avatar ) }}">
              <br><br>
              {{ Form::file('avatar', $attributes = array()) }}
              @if ($errors->has('avatar'))
                <label for="avatar" generated="true" class="error">{{ $errors->first('avatar') }}</label>
              @endif
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group btncontrol">
                      {{ Form::button('Guardar', array('class' => 'btn btn-success', 'type' => 'submit')) }}
                    </div>
                </div>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="x_title">
          <h1 style="font-size: 18px">Edit Contraseña <small></small></h1>
          <div class="clearfix"></div>
        </div>

        {!! Form::model('', [ 'method' => 'PUT', 'route' => ['dashboard.user.update'], 'class' => 'form-horizontal form-label-left', 'files'=>true ]) !!}
        <br>
        <div class="form-group">
          {{ Form::label('old_password', 'Antigua contraseña', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::password('old_password', ['class' => 'form-control'] ) }}
            @if ($errors->has('old_password'))
              <label for="old_password" generated="true" class="error">{{ $errors->first('old_password') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('new_password', 'Nueva Contraseña', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::password('new_password', ['class' => 'form-control'] ) }}
            @if ($errors->has('new_password'))
              <label for="new_password" generated="true" class="error">{{ $errors->first('new_password') }}</label>
            @endif
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group btncontrol">
                    {{ Form::button('Guardar', array('class' => 'btn btn-success', 'type' => 'submit')) }}
                  </div>
              </div>
        </div>

        {!! Form::close() !!}


      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">

        <br>

        <div class="ln_solid"></div>
        <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group btncontrol">
                    <a href="/dashboard" class="btn btn-default">Retornar</a>
                  </div>
              </div>
        </div>


      </div>
    </div>
  </div>


@stop
