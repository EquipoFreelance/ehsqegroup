@extends('dashboard.layouts.master')

@section('content')
<div class="form_content_block">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-edit"></i> Ficha de Inscripción</h2>
           <div class="clearfix"></div>
        </div>

        <div class="x_content">
          {!! Form::open(['route' => 'dashboard.inscription.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
          <div class="alert
          @if(Session::has('class'))
          {{ Session::get('message') }}
          @else
          alert-success
          @endif
          alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{ Session::get('message') }}
          </div>
          @endif

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="id_academic_period">Periódo Académico</label>
                <select name="id_academic_period" id="id_academic_period" class="form-control" data-id-default="{{ old('id_academic_period') }}"></select>
                @if ($errors->has('id_academic_period'))
                <label for="id_academic_period" generated="true" class="error">{{ $errors->first('id_academic_period') }}</label>
                @endif
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_modalidad">Modalidad</label>
                <select name="cod_modalidad" id="cod_modalidad" class="form-control" data-id-default="{{ old('cod_modalidad') }}">
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
                <select name="cod_esp_tipo" id="cod_esp_tipo" class="form-control" data-id-default="{{ old('cod_esp_tipo') }}">
                  <option value=""></option>
                </select>
                @if ($errors->has('cod_esp_tipo'))
                <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_esp">Especialización</label>
                <select name="cod_esp" id="cod_esp" class="form-control" data-id-default="{{ old('cod_esp') }}">
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
                <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ old('nombre') }}">
                @if ($errors->has('nombre'))
                <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label  for="ape_pat">Apellido paterno</label>
                <input type="text" id="ape_pat" placeholder="Apellido paterno" name="ape_pat"  class="form-control" value="{{ old('ape_pat') }}">
                @if ($errors->has('ape_pat'))
                <label for="ape_pat" generated="true" class="error">{{ $errors->first('ape_pat') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label  for="nom_corto">Apellido materno</label>
                <input type="text" id="ape_mat" placeholder="Apellido materno" name="ape_mat"  class="form-control" value="{{ old('ape_mat') }}">
                @if ($errors->has('ape_mat'))
                <label for="ape_mat" generated="true" class="error">{{ $errors->first('ape_mat') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label  for="cod_doc_tip">Tipo de Documento</label>
                <select class="form-control" name="cod_doc_tip" id="cod_doc_tip" data-id-default="{{ old('cod_doc_tip') }}"><option value="">-- Seleccione el Tipo de Documento --</option></select>
                @if ($errors->has('cod_doc_tip'))
                <label for="cod_doc_tip" generated="true" class="error">{{ $errors->first('cod_doc_tip') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label  for="dni">Número de documento</label>
                <input type="text" id="num_doc" placeholder="Número de documento" name="num_doc"  class="form-control" value="{{ old('num_doc') }}">
                @if ($errors->has('num_doc'))
                <label for="num_doc" generated="true" class="error">{{ $errors->first('num_doc') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="correo">Correo electrónico</label>
                <input type="text" id="correo" placeholder="Correo electrónico" name="correo"  class="form-control" value="{{ old('correo') }}">
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
                <select class="form-control" name="cod_pais" id="cod_pais" data-id-default="{{ old('cod_pais') }}"><option value="">-- Seleccione el País --</option></select>
                @if ($errors->has('cod_pais'))
                <label for="cod_pais" generated="true" class="error">{{ $errors->first('cod_pais') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_dpto">Departamento</label>
                <select class="form-control" name="cod_dpto" id="cod_dpto" data-id-default="{{ old('cod_dpto') }}"><option value="">-- Seleccione el Departamento --</option></select>
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
                <select class="form-control" name="cod_prov" id="cod_prov" data-id-default="{{ old('cod_prov') }}"><option value="">-- Seleccione la provincia --</option></select>
                @if ($errors->has('cod_prov'))
                <label for="cod_prov" generated="true" class="error">{{ $errors->first('cod_prov') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_dist">Distrito</label>
                <select class="form-control" name="cod_dist" id="cod_dist" data-id-default="{{ old('cod_dist') }}"><option value="">-- Seleccione el distrito --</option></select>
                @if ($errors->has('direccion'))
                <label for="cod_dist" generated="true" class="error">{{ $errors->first('cod_dist') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" placeholder="Dirección" name="direccion"  class="form-control" value="{{ old('direccion') }}">
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
                <input type="text" id="num_cellphone" placeholder="Teléfono celular" name="num_cellphone" class="form-control" value="{{ old('num_cellphone') }}">
                @if ($errors->has('num_cellphone'))
                <label for="num_cellphone" generated="true" class="error">{{ $errors->first('num_cellphone') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="num_tel_fijo">Teléfono Fijo</label>
                <input type="text" id="num_phone" placeholder="Teléfono fijo" name="num_phone" class="form-control" value="{{ old('num_phone')  }}">
                @if ($errors->has('num_phone'))
                <label for="num_phone" generated="true" class="error">{{ $errors->first('num_phone') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="chkContent">
            {{ Form::checkbox('proteccion_datos', 1, false, ['class' => 'flat']) }}
            Acepto los <a href="#" title="términos y condiciones" target="_blank">términos y condiciones</a> y brindo mi consentimiento para el tratamiento de mis datos de carácter personal proporcionados en el presente formulario de inscripción al equipo de Doktuz, para que sean analizados, procesados, almacenados y transferidos, de tal manera que puedan brindarme todos los servicios que ofrecen de manera directa o a través de terceros. Si tienes alguna duda o sugerencia puedes escribirnos a <a href="#">contacto@info.com</a> y con gusto responderemos tus dudas o sugerencias.
            @if ($errors->has('proteccion_datos'))
            <div class="hidden" id="chkvalid" style="display:block !important">
              <label for="proteccion_datos" generated="true" class="error" style="display:block !important">Es necesario que los términos y condiciones.</label>
            </div>
            @endif
          </div>
          <div class="ln_solid"></div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="business_name">Razon Social</label>
                <input type="text" id="business_name" placeholder="Monto" name="business_name" class="form-control" value="{{ old('amount')  }}">
                @if ($errors->has('business_name'))
                  <label for="amount" generated="true" class="error">{{ $errors->first('amount') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="billing_ruc">RUC</label>
                <input type="text" id="billing_ruc" placeholder="RUC" name="billing_ruc" class="form-control" value="{{ old('billing_ruc')  }}">
                @if ($errors->has('billing_ruc'))
                  <label for="billing_ruc" generated="true" class="error">{{ $errors->first('billing_ruc') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="ruc">Dirección</label>
                <input type="text" id="billing_address" placeholder="Dirección" name="billing_address" class="form-control" value="{{ old('billing_address')  }}">
                @if ($errors->has('billing_address'))
                  <label for="billing_address" generated="true" class="error">{{ $errors->first('billing_address') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="ruc">Teléfono</label>
                <input type="text" id="billing_phone" placeholder="Teléfono" name="billing_phone" class="form-control" value="{{ old('billing_phone')  }}">
                @if ($errors->has('billing_phone'))
                  <label for="billing_phone" generated="true" class="error">{{ $errors->first('billing_phone') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="ruc">Reponsable del Pago</label>
                <input type="text" id="billing_client" placeholder="Ingrese el responsable del pago" name="billing_client" class="form-control" value="{{ old('billing_client')  }}">
                @if ($errors->has('billing_client'))
                  <label for="billing_client" generated="true" class="error">{{ $errors->first('billing_client') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="ln_solid"></div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="way_to_pay">Forma de Pago</label>
                <select class="form-control" name="way_to_pay" id="way_to_pay" data-id-default="{{ old('way_to_pay') }}">
                  <option value="">-- Seleccione la Forma de Pago --</option>
                  <option value="1">En cuotas</option>
                  <option value="2">Pago Total</option>
                </select>
                @if ($errors->has('way_to_pay'))
                  <label for="num_cellphone" generated="true" class="error">{{ $errors->first('way_to_pay') }}</label>
                @endif
                <p>
                  <b>Depósito en CTA.</b>
                </p>
              </div>
            </div>
          </div>

          <div class="form-group content_way_to_pay" style="display:none">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="number_of_shares">Número de Cuotas</label>
                <select class="form-control" name="number_of_shares" id="number_of_shares" data-id-default="{{ old('number_of_shares') }}">
                  <option value="">-- Seleccione el Número de Cuotas --</option>
                  <option value="1">1 Cuota</option>
                  <option value="2">2 Cuotas</option>
                  <option value="3">3 Cuotas</option>
                  <option value="4">4 Cuotas</option>
                </select>
                @if ($errors->has('way_to_pay'))
                  <label for="num_cellphone" generated="true" class="error">{{ $errors->first('way_to_pay') }}</label>
                @endif

              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="amount">Monto</label>
                <input type="text" id="amount" placeholder="Monto" name="amount" class="form-control" value="{{ old('amount')  }}">
                @if ($errors->has('amount'))
                  <label for="amount" generated="true" class="error">{{ $errors->first('amount') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="operation_number">Número de la operación</label>
                <input type="text" id="operation_number" placeholder="Número de la operación" name="operation_number" class="form-control" value="{{ old('amount')  }}">
                @if ($errors->has('amount'))
                  <label for="amount" generated="true" class="error">{{ $errors->first('amount') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="amount">Condiciones</label>
                <p>
                  Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
                </p>
              </div>
            </div>
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
  <script src="{{ URL::asset('assets/js/app-document-type.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-inscription.js') }}"></script>
@stop
