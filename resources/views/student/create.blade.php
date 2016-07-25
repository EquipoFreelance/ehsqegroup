@extends('layouts.layout-student')

@section('title', 'Dashboard - Secretaria Académica Módulos')

@section('sidebar_menu')
@include('dashboard.dashboard_sa_menu')
@stop

@section('content')
<div class="form_content_block">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-edit"></i> Ficha de Alumno</h2>
           <div class="clearfix"></div>
        </div>
        <br>

        {!! Form::open(['route' => 'dashboard.student.store', 'class' => 'form-horizontal form-label-left']) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>¡Perfecto!</strong>{{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nombre">Nombre de participante</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ old('nombre') }}">
            @if ($errors->has('nombre'))
            <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="ape_pat">Apellido paterno</label>
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
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_doc_tip">Tipo de Documento</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('cod_doc_tip', array('' => '-- Seleccione el tipo de documento --','1' => 'DNI', '2' => 'Carnet de Extranjeria'), old('cod_doc_tip'), ['class' => 'form-control'] ) }}
            @if ($errors->has('cod_doc_tip'))
            <label for="cod_doc_tip" generated="true" class="error">{{ $errors->first('cod_doc_tip') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="dni">Número de documento</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="num_doc" placeholder="Número de documento" name="num_doc"  class="form-control" value="{{ old('num_doc') }}">
            @if ($errors->has('num_doc'))
            <label for="num_doc" generated="true" class="error">{{ $errors->first('num_doc') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="dni">Correo electrónico</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="correo" placeholder="Correo electrónico" name="correo"  class="form-control" value="{{ old('correo') }}">
            @if ($errors->has('correo'))
            <label for="correo" generated="true" class="error">{{ $errors->first('correo') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_pais">País</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_pais" id="cod_pais"><option value="">-- Seleccione el País --</option></select>
            @if ($errors->has('cod_pais'))
            <label for="cod_pais" generated="true" class="error">{{ $errors->first('cod_pais') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_dpto">Departamento</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_dpto" id="cod_dpto"><option value="">-- Seleccione el Departamento --</option></select>
            @if ($errors->has('cod_dpto'))
            <label for="cod_dpto" generated="true" class="error">{{ $errors->first('cod_dpto') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_prov">Provincia</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_prov" id="cod_prov"><option value="">-- Seleccione la provincia --</option></select>
            @if ($errors->has('cod_prov'))
            <label for="cod_prov" generated="true" class="error">{{ $errors->first('cod_prov') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_dist">Distrito</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_dist" id="cod_dist"><option value="">-- Seleccione el distrito --</option></select>
            @if ($errors->has('direccion'))
            <label for="cod_dist" generated="true" class="error">{{ $errors->first('cod_dist') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="direccion">Dirección</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="direccion" placeholder="Dirección" name="direccion"  class="form-control" value="{{ old('direccion') }}">
            @if ($errors->has('direccion'))
            <label for="direccion" generated="true" class="error">{{ $errors->first('direccion') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nom_corto">Fecha de nacimiento</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="date_content">
              <input type="text" id="fe_nacimiento" placeholder="Fecha de nacimiento" name="fe_nacimiento"  class="form-control form-control has-feedback-left calendar" value="{{ old('fe_nacimiento') }}">
              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
            </div>
            @if ($errors->has('direccion'))
            <label for="fe_nacimiento" generated="true" class="error">{{ $errors->first('fe_nacimiento') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_sexo">Género</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::select('cod_sexo', array('' => '-- Seleccione el sexo --','1' => 'Masculino', '2' => 'Femenino'), old('cod_sexo'), ['class' => 'form-control'] ) }}
            @if ($errors->has('cod_sexo'))
            <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_sexo') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="num_tel_mobile">Teléfono celular</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="num_cellphone" placeholder="Teléfono celular" name="num_cellphone" class="form-control" value="{{ old('num_cellphone') }}">
            @if ($errors->has('num_cellphone'))
            <label for="num_cellphone" generated="true" class="error">{{ $errors->first('num_cellphone') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="num_tel_fijo">Teléfono Fijo</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="num_phone" placeholder="Teléfono fijo" name="num_phone" class="form-control" value="{{ old('num_phone')  }}">
            @if ($errors->has('num_phone'))
            <label for="num_phone" generated="true" class="error">{{ $errors->first('num_phone') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="proteccion_datos">Acepta los terminos y condiciones</label><br>
          <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::checkbox('proteccion_datos', 1, false) }}
              @if ($errors->has('proteccion_datos'))
              <label for="proteccion_datos" generated="true" class="error">{{ $errors->first('proteccion_datos') }}</label>
              @endif
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.student.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
              <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@stop


@section('custom_js')
  <script src="{{ URL::asset('assets/js/app.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-students.js') }}"></script>
@stop
