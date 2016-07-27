@extends('dashboard.layouts.master')

@section('title', Session::get('menu.dashboard.title') )

@section('sidebar_menu')
  @include('dashboard.menus.' . Session::get('menu.dashboard.menu')  )
@stop

@section('content')
<div class="form_content_block">
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
      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-book"></i> Datos Personales</h2>
           <div class="clearfix"></div>
        </div>
        <div class="x_content">
          {!! Form::model($profile, [ 'method' => 'PUT', 'route' => ['dashboard.profile.update', $profile->id], 'class' => 'form-horizontal form-label-left', 'files'=>true ]) !!}
            <div class="col-md-4">
              <div class="profile_img">
                <div id="crop-avatar">
                  <div class="avatar-view" title="Actualiza tu foto">
                    <img src="{{ ( $profile->avatar == '')?  URL::asset( 'assets/images/users/user.png' ) :  URL::asset( $profile->avatar ) }}">
                  </div>
                  {{ Form::file('avatar', $attributes = array('class' => 'avatar-input btn btn-5 btn-5a icon-picture picture w100')) }}
                  @if ($errors->has('avatar'))
                    <label for="avatar" generated="true" class="error">{{ $errors->first('avatar') }}</label>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                {{ Form::label('fullname', 'Nombre del usuario', array('class' => 'control-label col-md-4 col-sm-4 col-xs-12')) }}
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {{ Form::text('fullname', $profile->fullname, ['class' => 'form-control'] ) }}
                  @if ($errors->has('fullname'))
                    <label for="fullname" generated="true" class="error">{{ $errors->first('fullname') }}</label>
                  @endif
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group btncontrol">
                        {{ Form::button('<span>Guardar</span>', array('class' => 'btn btn-5 btn-5a icon-save save', 'type' => 'submit')) }}
                      </div>
                  </div>
              </div>
            </div>
          {!! Form::close() !!}
      </div>
    </div>
  </div>
  </div>

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-book"></i> Cambio de Contraseña</h2>
           <div class="clearfix"></div>
        </div>
        <div class="x_content">

            {!! Form::model('', [ 'method' => 'PUT', 'route' => ['dashboard.user.update'], 'class' => 'form-horizontal form-label-left', 'files'=>true ]) !!}
            <div class="col-md-12">
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
                          {{ Form::button('<span>Guardar</span>', array('class' => 'btn btn-5 btn-5a icon-save save', 'type' => 'submit')) }}
                        </div>
                    </div>
              </div>
            </div>
            {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

  </div>
@stop
