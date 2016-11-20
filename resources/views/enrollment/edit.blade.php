@extends('dashboard.layouts.master')

@section('content')

  <!-- Custom Templates -->
  <script id="response-template-concepts" type="text/x-handlebars-template">
    <div class="col-md-12 col-sm-12 col-xs-12 ">
      <div class="x_title" style="border-bottom:none">
        <h2>Pagos realizados</h2>
        <div class="clearfix"></div>
      </div>
      <table id="datatable-responsive-price" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="margin-bottom: 0">
        <tr>
          <th>Concepto</th>
          <th>Monto</th>
          <th>Validación</th>
        </tr>
        </tr>
        @{{#each concepts}}
        <tr>
          <td>@{{ concept_name }}</td>
          <td>@{{ concept_amount }}</td>
          <td>@{{#if concept_verifided}} <i class="fa fa-check green"></i> @{{else}} @{{/if}}</td>
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
            <h2><i class="fa fa-edit"></i> Ratificar Matricula</h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            {!! Form::model($enrollment, [ 'method' => 'PUT', 'route' => ['dashboard.enrollment.update', $enrollment->id], 'class' => 'form-horizontal form-label-left' ]) !!}

            @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ Session::get('message') }}
              </div>
            @endif

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <label for="cod_alumno">Código de Alumno:</label>
                  <div>
                    {{ $enrollment->cod_alumno }}
                  </div>

                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <label for="cod_alumno">Alumno:</label>
                  <div>
                    {{ $enrollment->student->persona->ape_pat }}
                    {{ $enrollment->student->persona->ape_mat}},
                    {{ $enrollment->student->persona->nombre }}
                  </div>

                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="id_academic_period">Periódo Académico:</label>
                  <select name="id_academic_period" id="id_academic_period" data-id-default="{{ $enrollment->id_academic_period }}" class="form-control"></select>
                  @if ($errors->has('id_academic_period'))
                    <label for="id_academic_period" generated="true" class="error">{{ $errors->first('id_academic_period') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_modalidad">Modalidad</label>
                  <select class="form-control" name="cod_modalidad" id="cod_modalidad" data-id-default="{{ $enrollment->cod_modalidad }}"><option value="">-- Seleccione la modalidad --</option></select>
                  @if ($errors->has('cod_modalidad'))
                    <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('cod_modalidad') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_esp_tipo">Tipo de Especialización</label>
                  <select class="form-control" name="cod_esp_tipo" id="cod_esp_tipo" data-id-default="{{ $enrollment->cod_esp_tipo }}"><option>-- Seleccione el tipo de especialización --</option></select>
                  @if ($errors->has('cod_esp_tipo'))
                    <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_esp">Especialización</label>
                  <select class="form-control" name="cod_esp" id="cod_esp" data-id-default="{{ $enrollment->cod_esp }}"><option value="">-- Seleccione la especialización --</option></select>
                  @if ($errors->has('cod_esp'))
                    <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="ln_solid"></div>

            <div class="form-group">
              <!-- Conceptos -->
              <div class="row content_concept_items"></div>
            </div>

            <div class="form-group">
              <label>Observación:</label>
              <textarea id="message" class="form-control" name="message"></textarea>
            </div>
            <div class="ln_solid"></div>

            <div class="chkContent">
              {{ Form::checkbox('activo', 1, ( $enrollment->activo == 1)? true : false, ['class' => 'flat'] ) }}
              Validar matricula
              @if ($errors->has('activo'))
                <div class="hidden" id="chkvalid" style="display:block !important">
                  <label for="proteccion_datos" generated="true" class="error" style="display:block !important">Es necesario este campo</label>
                </div>
              @endif
            </div>

            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.enrollment.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
              <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
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
  <script src="{{ URL::asset('assets/js/app-edit-enrollments.js') }}"></script>
  <script>
    $(function(){
      showInscriptionVerifyPayment('{{ $enrollment->id }}');
    });
  </script>

@stop