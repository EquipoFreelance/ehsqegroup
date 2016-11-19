@extends('dashboard.layouts.master')

@section('custom_css')
  <style>
    .content_payment_method_student{
      display: none;
    }
  </style>
@stop

@section('content')

  <!-- Custom Templates -->
  <script id="response-template-concepts" type="text/x-handlebars-template">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label for="mount">Detalle de los conceptos necesario para generar una matricula</label>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 ">
        <table class="tablex table-bordered" cellspacing="0" width="100%">
          <tr>
            <td width="300"><b>Concepto</b></td>
            <td width="10"><b>Monto</b></td>
          </tr>
          @{{#each response}}
          <tr>
            <td>@{{ name_concept }}
              <input type="hidden" name="enrollment_concept_id[]" value="@{{ id }}" />
            </td>
            <td class="">
              <input type="text" class="form-control concept_amount amount_@{{id_concept}}_@{{ id_payment_type }}" id="amount_@{{id_concept}}_@{{ id_payment_type }}" name="enrollment_concept_amount[]" placeholder="S/. 0.00" value="@{{ amount }}">
            </td>
          </tr>
          @{{/each}}
        </table>
      </div>
  </script>

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
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_informacion_personal" aria-controls="pinfo" role="tab" data-toggle="tab">Información personal</a></li>
            <li role="presentation"><a href="#tab_form_pago" aria-controls="pmodalidad" role="tab" data-toggle="tab">Forma de Pago</a></li>
            <li role="presentation"><a href="#tab_facturacion" aria-controls="pmodalidad" role="tab" data-toggle="tab">Datos de la Facturación</a></li>
          </ul>
          <br>
          <div class="tab-content">
            <!-- Información Personal -->
            <div role="tabpanel" class="tab-pane active" id="tab_informacion_personal">

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
                    <label for="id_academic_period">Periódo Académico</label>
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
                    <label  for="cod_doc_tip">Tipo de Documento</label>
                    <select class="form-control" name="cod_doc_tip" id="cod_doc_tip" data-id-default="{{ $student->persona->cod_doc_tip }}"><option value="">-- Seleccione el Tipo de Documento --</option></select>
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
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="direccion">Dirección</label>
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

            <!-- Información de Forma Pago -->
            <div role="tabpanel" class="tab-pane" id="tab_form_pago">

                <form method="POST" name="frm_payment_method_student" id="frm_payment_method_student" action="#">

                  <input type="hidden" name="id_enrollment" id="id_enrollment" value="{{ $student->enrollments()->first()->id }}">
                  <div class="alert alert-success alert-dismissible fade out" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="message"></span>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="id_payment_method">Medio de Pago</label>
                        <select class="form-control" name="id_payment_method" id="id_payment_method" data-id-default="{{ old('id_payment_method') }}">
                          <option value="">-- Seleccione la Forma de Pago --</option>
                          <option value="1">Pago Total</option>
                          <option value="2">Pago Fraccionado</option>
                          <option value="3">Pago Condicional</option>
                          <option value="4">Becado</option>
                        </select>
                        <div>
                          Depósito Cta. Cte.  Banco de  Crédito  del Perú: <b> 192-1884961-0-08</b>  /  CCI :  <b>00219200188496100836</b>
                        </div>
                      </div>
                    </div>
                  </div>


                  <!-- Fraccionado / númer de coutas -->
                  <div class="form-group content_item content_item_2" style="display:none">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="id_payment_method">Número de Cuotas</label>
                        <select class="form-control" id="num_cuota" name="num_cuota">
                          <option value=""> Seleccione el número de cuotas</option>
                          <option value="1">Cuota 1</option>
                          <option value="2">Cuota 2</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Campos Forma de Pago Condicional -->
                  <div class="form-group content_item content_item_3" style="display:none">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="condicional_date_1">Fecha de Cuota 1</label>
                        <input type="text" class="form-control" id="condicional_date_1" name="condicional_date[]" value="" placeholder="09/10/2016">
                        <input type="hidden" id="num_cuota_1" name="num_cuotas[]" value="1">
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="condicional_amount_1">Monto Cuota 1</label>
                        <input type="text" class="form-control" id="condicional_amount_1" name="condicional_amount[]" value="" placeholder="S/. 0.00">
                      </div>
                    </div>
                  </div>

                  <div class="form-group content_item content_item_3" style="display:none">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="mount">Fecha de la Cuota 2</label>
                        <input type="text" class="form-control" id="condicional_date_2" name="condicional_date[]" value="" placeholder="09/10/2016">
                        <input type="hidden" id="num_cuota_2" name="num_cuotas[]" value="2">
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="condicional_amount_2">Monto Cuota 2</label>
                        <input type="text" class="form-control" id="condicional_amount_2" name="condicional_amount[]" value="" placeholder="S/. 0.00">
                      </div>
                    </div>
                  </div>
                  <!-- Campos Forma de Pago Condicional -->

                  <div class="form-group content_item content_item_mount" style="display:none">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="amount">Monto</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="" placeholder="S/. 0.00">
                      </div>
                    </div>
                  </div>

                  <div class="form-group content_item content_item_2" style="display:none">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="amount_enrollment">Costo Matrícula S/.</label>
                        <input type="hidden" id="amount_enrollment_id" placeholder="Matrícula" name="amount_enrollment_id" class="form-control" value="">
                        <input type="text" id="amount_enrollment" placeholder="Matrícula" name="amount_enrollment" class="form-control" value="">
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="amount_certificate">Costo Certificado S/.</label>
                        <input type="hidden" id="amount_certificate_id" placeholder="Matrícula" name="amount_certificate_id" class="form-control" value="">
                        <input type="text" id="amount_certificate" placeholder="Certificado" name="amount_certificate" class="form-control" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-6">
                        <label for="operation_number">Observación</label>
                        <textarea class="form-control" name="observation" id="observation" placeholder="Observación"></textarea>
                        @if ($errors->has('observation'))
                          <label for="observation" generated="true" class="error">{{ $errors->first('observation') }}</label>
                        @endif
                      </div>
                    </div>
                  </div>

                  <!--<div class="form-group">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="operation_number">Número de la operación</label>
                        <input type="text" id="operation_number" placeholder="Número de la operación" name="operation_number" class="form-control" value="{{ old('amount')  }}">
                        @if ($errors->has('amount'))
                          <label for="amount" generated="true" class="error">{{ $errors->first('amount') }}</label>
                        @endif
                      </div>
                    </div>
                  </div>-->

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="condiciones">CONDICIONES</label>

                        <ul>
                          <li>Una vez iniciado el curso, si el participante opta por retirarse, no tendrá derecho a re‐embolso. Así mismo, no lo exime del pago del valor del total del mismo. Solo procede si la reserva es cancelada 72 horas antes del inicio del evento</li>
                          <li>En caso de retirarse antes de comenzar el diploma se retendrá el 10% por gastos administrativos de su pago.</li>
                          <li>En caso de tener un retraso mayor a 45 días en sus pagos se derivara a INFOCORP</li>
                          <li>La inasistencia al evento programado no supone el reembolso del dinero abonado.</li>
                          <li>EHSQ GROUP SAC Se reserva el derecho de cancelar o postergar el inicio del curso si no se llega al número mínimo de participantes hasta el día de inicio.</li>
                        </ul>

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

                </form>
            </div>

            <!-- Información de la facturación -->
            <div role="tabpanel" class="tab-pane" id="tab_facturacion">

              <form method="POST" name="frm_billing_client" id="frm_billing_client" action="#">

                <div class="alert alert-success alert-dismissible fade out" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <span class="message"></span>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label for="billing_razon_social">Razón Social</label>
                      <input type="text" id="billing_razon_social" placeholder="Ingrese la Razón Social" name="billing_razon_social" class="form-control" value="{{ old('billing_razon_social')  }}">
                      @if ($errors->has('billing_razon_social'))
                        <label for="billing_razon_social" generated="true" class="error">{{ $errors->first('billing_razon_social') }}</label>
                      @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label for="billing_ruc">N° de RUC</label>
                      <input type="text" id="billing_ruc" placeholder="RUC" name="billing_ruc" class="form-control" value="{{ old('billing_ruc')  }}">
                      @if ($errors->has('billing_ruc'))
                        <label for="billing_ruc" generated="true" class="error">{{ $errors->first('billing_ruc') }}</label>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label for="ruc">Dirección</label>
                      <input type="text" id="billing_address" placeholder="Dirección" name="billing_address" class="form-control" value="{{ old('billing_address')  }}">
                      @if ($errors->has('billing_address'))
                        <label for="billing_address" generated="true" class="error">{{ $errors->first('billing_address') }}</label>
                      @endif
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6">
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
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label for="ruc">Nombres</label>
                      <input type="text" id="billing_client_firstname" placeholder="Ingrese nombre del responsable del pago" name="billing_client_firstname" class="form-control" value="{{ old('billing_client_firstname')  }}">
                      @if ($errors->has('billing_client_firstname'))
                        <label for="billing_client_firstname" generated="true" class="error">{{ $errors->first('billing_client_firstname') }}</label>
                      @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label for="ruc">Apellidos</label>
                      <input type="text" id="billing_client_lastname" placeholder="Ingrese apellido del responsable del pago" name="billing_client_lastname" class="form-control" value="{{ old('billing_client_lastname')  }}">
                      @if ($errors->has('billing_client_lastname'))
                        <label for="billing_client_lastname" generated="true" class="error">{{ $errors->first('billing_client_lastname') }}</label>
                      @endif
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

              </form>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
@stop

@section('custom_js')
  <script src="{{ URL::asset('assets/js/jquery.validated.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-academic-period.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-document-type.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-inscription.js') }}"></script>
@stop