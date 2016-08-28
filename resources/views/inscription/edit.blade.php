@extends('dashboard.layouts.master')

@section('content')
<div class="form_content_block">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-edit"></i> Ficha de Inscripción</h2>
           <div class="clearfix"></div>
        </div>

        <div class="x_content">

        {!! Form::model($student, [ 'method' => 'PUT', 'route' => ['dashboard.inscription.update', $student->id], 'class' => 'form-horizontal form-label-left' ]) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="id_academic_period">Fecha de inicio</label>
              <select name="id_academic_period" id="id_academic_period" data-id-default="{{ $student->enrollments()->first()->id_academic_period }}" class="form-control"></select>
              @if ($errors->has('id_academic_period'))
              <label for="id_academic_period" generated="true" class="error">{{ $errors->first('id_academic_period') }}</label>
              @endif
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_modalidad">Modalidad</label>
              <select name="cod_modalidad" id="cod_modalidad" class="form-control" data-id-default="{{ $student->enrollments()->first()->cod_modalidad }}">
                <option value=""></option>
              </select>
              @if ($errors->has('cod_modalidad'))
              <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('cod_modalidad') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_esp_tipo">Tipo de Especialización</label>
              <select name="cod_esp_tipo" id="cod_esp_tipo" class="form-control" data-id-default="{{ $student->enrollments()->first()->cod_esp_tipo }}">
                <option value=""></option>
              </select>
              @if ($errors->has('cod_esp_tipo'))
              <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
              @endif
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_esp">Especialización</label>
              <select name="cod_esp" id="cod_esp" class="form-control" data-id-default="{{ $student->enrollments()->first()->cod_esp }}">
                <option value="">-- Seleccione la especialización --</option>
              </select>
              @if ($errors->has('cod_esp'))
              <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="nombre">Nombre de participante</label>
              <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ $student->persona->nombre }}">
              @if ($errors->has('nombre'))
              <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="ape_pat">Apellido paterno</label>
              <input type="text" id="ape_pat" placeholder="Apellido paterno" name="ape_pat"  class="form-control" value="{{ $student->persona->ape_pat }}">
              @if ($errors->has('ape_pat'))
              <label for="ape_pat" generated="true" class="error">{{ $errors->first('ape_pat') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="nom_corto">Apellido materno</label>
              <input type="text" id="ape_mat" placeholder="Apellido materno" name="ape_mat"  class="form-control" value="{{ $student->persona->ape_mat }}">
              @if ($errors->has('ape_mat'))
              <label for="ape_mat" generated="true" class="error">{{ $errors->first('ape_mat') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_doc_tip">Tipo de Documento</label>
              {{ Form::select('cod_doc_tip', array('' => '-- Seleccione el tipo de documento --','1' => 'DNI', '2' => 'Carnet de Extranjeria'), $student->persona->cod_doc_tip, ['class' => 'form-control'] ) }}
              @if ($errors->has('cod_doc_tip'))
              <label for="cod_doc_tip" generated="true" class="error">{{ $errors->first('cod_doc_tip') }}</label>
              @endif
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="dni">Número de documento</label>
              <input type="text" id="num_doc" placeholder="Número de documento" name="num_doc"  class="form-control" value="{{ $student->persona->num_doc }}">
              @if ($errors->has('num_doc'))
              <label for="num_doc" generated="true" class="error">{{ $errors->first('num_doc') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="dni">Correo electrónico</label>
              <input type="text" id="correo" placeholder="Correo electrónico" name="correo"  class="form-control" value="{{ $student->persona->correo }}">
              @if ($errors->has('correo'))
              <label for="correo" generated="true" class="error">{{ $errors->first('correo') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_pais">País</label>
              <select class="form-control" name="cod_pais" id="cod_pais" data-id-default="{{ $student->persona->cod_pais }}"><option value="">-- Seleccione el País --</option></select>
              @if ($errors->has('cod_pais'))
              <label for="cod_pais" generated="true" class="error">{{ $errors->first('cod_pais') }}</label>
              @endif
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_dpto">Departamento</label>
              <select class="form-control" name="cod_dpto" id="cod_dpto" data-id-default="{{ $student->persona->cod_dpto }}"><option value="">-- Seleccione el Departamento --</option></select>
              @if ($errors->has('cod_dpto'))
              <label for="cod_dpto" generated="true" class="error">{{ $errors->first('cod_dpto') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_prov">Provincia</label>
              <select class="form-control" name="cod_prov" id="cod_prov" data-id-default="{{ $student->persona->cod_prov }}"><option value="">-- Seleccione la provincia --</option></select>
              @if ($errors->has('cod_prov'))
              <label for="cod_prov" generated="true" class="error">{{ $errors->first('cod_prov') }}</label>
              @endif
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="cod_dist">Distrito</label>
              <select class="form-control" name="cod_dist" id="cod_dist" data-id-default="{{ $student->persona->cod_dist }}"><option value="">-- Seleccione el distrito --</option></select>
              @if ($errors->has('cod_dist'))
              <label for="cod_dist" generated="true" class="error">{{ $errors->first('cod_dist') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="direccion">Dirección</label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <input type="text" id="direccion" placeholder="Dirección" name="direccion"  class="form-control" value="{{ $student->persona->direccion }}">
              @if ($errors->has('direccion'))
              <label for="direccion" generated="true" class="error">{{ $errors->first('direccion') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="num_tel_mobile">Teléfono celular</label>
              <input type="text" id="num_cellphone" placeholder="Teléfono celular" name="num_cellphone" class="form-control" value="{{ $student->persona->num_cellphone }}">
              @if ($errors->has('num_cellphone'))
              <label for="num_cellphone" generated="true" class="error">{{ $errors->first('num_cellphone') }}</label>
              @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="num_tel_fijo">Teléfono Fijo</label>
              <input type="text" id="num_phone" placeholder="Teléfono fijo" name="num_phone" class="form-control" value="{{ $student->persona->num_phone  }}">
              @if ($errors->has('num_phone'))
              <label for="num_phone" generated="true" class="error">{{ $errors->first('num_phone') }}</label>
              @endif
            </div>

          </div>
        </div>

        <div class="chkContent">

          {{ Form::checkbox('proteccion_datos', 1, ($student->persona->proteccion_datos == 1)? true : false, ['class' => 'flat'] ) }}
          Acepto los <a href="#" title="términos y condiciones" target="_blank">términos y condiciones</a> y brindo mi consentimiento para el tratamiento de mis datos de carácter personal proporcionados en el presente formulario de inscripción al equipo de Doktuz, para que sean analizados, procesados, almacenados y transferidos, de tal manera que puedan brindarme todos los servicios que ofrecen de manera directa o a través de terceros. Si tienes alguna duda o sugerencia puedes escribirnos a <a href="#">contacto@info.com</a> y con gusto responderemos tus dudas o sugerencias.
          @if ($errors->has('proteccion_datos'))
            <div class="hidden" id="chkvalid" style="display:block !important">
              <label for="proteccion_datos" generated="true" class="error" style="display:block !important">Es necesario que los términos y condiciones.</label>
            </div>
          @endif

        </div>

        <div class="ln_solid"></div>

        <div class="form-group">
          <div class="form-group btncontrol">
            <a href="{{ route('dashboard.inscription.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
            <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
          </div>
        </div>
        {!! Form::close() !!}

        </div>

      </div>
    </div>
  </div>
</div>
@stop

@section('custom_js')
  <script src="{{ URL::asset('assets/js/app.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-academic-period.js') }}"></script>
@stop