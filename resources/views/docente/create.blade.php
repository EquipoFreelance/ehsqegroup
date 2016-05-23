@extends('layouts.app_internas')

@section('title', 'Dashboard - Secretaria Académica Docentes')

@section('sidebar_menu')
@include('dashboard.dashboard_sa_menu')
@stop

@section('content')
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="x_title">
          <h1 style="font-size: 18px">Nuevo Docente <small> (En este interior usted podrá ingresar una nueva Especialización, editar los datos ingresados)</small></h1>
          <div class="clearfix"></div>
        </div>
        <br>

        {!! Form::open(['route' => 'dashboard.persona.store', 'class' => 'form-horizontal form-label-left']) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>¡Perfecto!</strong>{{ Session::get('message') }}
        </div>
        @endif

        <input type="hidden" name="cod_personal_cargo_tipo" id="cod_personal_cargo_tipo" value="1" />

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_doc_tip">Tipo de Documento</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('cod_doc_tip', array('1' => 'DNI', '2' => 'Carnet de Extranjeria'), old('cod_doc_tip'), ['class' => 'form-control'] ) }}
            @if ($errors->has('cod_doc_tip'))
            <label for="cod_doc_tip" generated="true" class="error">{{ $errors->first('cod_doc_tip') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="dni">DNI</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="num_doc" placeholder="Número de documento" name="num_doc"  class="form-control" value="{{ old('num_doc') }}">
            @if ($errors->has('num_doc'))
            <label for="num_doc" generated="true" class="error">{{ $errors->first('num_doc') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nombre">Nombre</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ old('nombre') }}">
            @if ($errors->has('nombre'))
            <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_corto">Apellido paterno</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="ape_pat" placeholder="Apellido paterno" name="ape_pat"  class="form-control" value="{{ old('ape_pat') }}">
            @if ($errors->has('ape_pat'))
            <label for="ape_pat" generated="true" class="error">{{ $errors->first('ape_pat') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_corto">Apellido materno</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="ape_mat" placeholder="Apellido materno" name="ape_mat"  class="form-control" value="{{ old('ape_mat') }}">
            @if ($errors->has('ape_mat'))
            <label for="ape_mat" generated="true" class="error">{{ $errors->first('ape_mat') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_corto">Dirección</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="direccion" placeholder="Dirección" name="direccion"  class="form-control" value="{{ old('direccion') }}">
            @if ($errors->has('direccion'))
            <label for="direccion" generated="true" class="error">{{ $errors->first('direccion') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="telefono">Teléfonos</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="telefono" placeholder="Teléfonos" name="telefono"  class="form-control" value="{{ old('telefono') }}">
            @if ($errors->has('telefono'))
            <label for="telefono" generated="true" class="error">{{ $errors->first('telefono') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_corto">Fecha de nacimiento</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="fe_nacimiento" placeholder="Fecha de nacimiento" name="fe_nacimiento"  class="form-control" value="{{ old('fe_nacimiento') }}">
            @if ($errors->has('direccion'))
            <label for="fe_nacimiento" generated="true" class="error">{{ $errors->first('fe_nacimiento') }}</label>
            @endif
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_sexo">Género</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('cod_sexo', array('1' => 'Masculino', '2' => 'Femenino'), old('cod_sexo'), ['class' => 'form-control'] ) }}
            @if ($errors->has('cod_sexo'))
            <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_sexo') }}</label>
            @endif
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Estado</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], old('activo'), ['class' => 'form-control'] ) }}
            @if ($errors->has('activo'))
            <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
            @endif
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.docente.index') }}" class="btn btn-default">Retornar</a>
              <!--<a href="{{ route('dashboard.tesp.index') }}" class="btn btn-danger cancel_btn">Cancelar</a>-->
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
