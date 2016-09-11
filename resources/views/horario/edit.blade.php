@extends('dashboard.layouts.master')

@section('custom_css')

  <!-- CSS Plugin TimePicker -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet">

  <!-- CSS Plugin DatePicker Material -->
  <link href="{{ URL::asset('assets/js/datepicker_material/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@stop

@section('content')
  <!-- Custom Templates -->
  <script id="response-template" type="text/x-handlebars-template">
    <div class="alert alert-info" role="alert" style="margin:0px">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">Grupo:</div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <b>@{{ text }}</b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">Sede:</div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <b>@{{ nom_sede }}</b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">Modalidad:</div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <b>@{{ nom_mod }}</b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">Tipo de especialización:</div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <b>@{{ nom_esp_tipo }}</b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">Especialización:</div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <b>@{{ nom_esp }}</b>
          </div>
        </div>
      </div>
    </div>
  </script>

  <div class="form_content_block">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <br>
        <div class="x_panel">

          <div class="y_title">
            <h2><i class="fa fa-edit"></i> Nuevo</h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            {!! Form::model($horario, [ 'method' => 'PUT', 'route' => ['dashboard.academic_schedule.update', $horario->id], 'class' => 'form-horizontal form-label-left' ]) !!}

            @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ Session::get('message') }}
              </div>
            @endif

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="id_academic_period">Periodo Académico</label>
                  <select class="select2 form-control id_academic_period" name="id_academic_period" id="id_academic_period" data-id-default="{{ $horario->id_academic_period }}"></select>
                  @if ($errors->has('cod_grupo'))
                    <label for="id_academic_period" generated="true" class="error">{{ $errors->first('cod_grupo') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_grupo">Grupo</label>
                  <select class="select2 form-control cod_grupo" name="cod_grupo" id="cod_grupo" data-id-default="{{ $horario->cod_grupo }}"></select>
                  @if ($errors->has('cod_grupo'))
                    <label for="cod_grupo" generated="true" class="error">{{ $errors->first('cod_grupo') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group content_info_group hide">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 set_info_group"></div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_mod">Modulo</label>
                  <select name="cod_mod" id="cod_mod" class="form-control" data-id-default="{{ $horario->cod_mod }}">
                    <option value="">-- Seleccione el Módulo --</option>
                  </select>
                  @if ($errors->has('cod_mod'))
                    <label for="cod_mod" generated="true" class="error">{{ $errors->first('cod_mod') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label for="cod_docente">Docente</label>
                  <select name="cod_docente" id="cod_docente" class="form-control" data-id-default="{{ $horario->cod_docente }}"></select>
                  @if ($errors->has('cod_docente'))
                    <label for="cod_docente" generated="true" class="error">{{ $errors->first('cod_docente') }}</label>
                  @endif
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label for="cod_auxiliar">Auxiliar</label>
                  <select name="cod_auxiliar" id="cod_auxiliar" class="form-control" data-id-default="{{ $cod_auxiliar }}"></select>
                  @if ($errors->has('cod_auxiliar'))
                    <label for="cod_auxiliar" generated="true" class="error">{{ $errors->first('cod_auxiliar') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {{ Form::label('fec_inicio', 'Fecha de inicio:') }}
                  {{ Form::text('fec_inicio', $horario->fec_inicio, ['class' => 'form-control', 'placeholder' => 'Fecha de Inicio'] ) }}
                  @if ($errors->has('fec_inicio'))
                    <label for="fec_inicio" generated="true" class="error">{{ $errors->first('fec_inicio') }}</label>
                  @endif
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {{ Form::label('fec_fin', 'Fecha de finalización:') }}
                  {{ Form::text('fec_fin', $horario->fec_fin, ['class' => 'form-control', 'placeholder' => 'Fecha de Finalización'] ) }}
                  @if ($errors->has('fec_fin'))
                    <label for="fec_fin" generated="true" class="error">{{ $errors->first('fec_fin') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {{ Form::label('h_inicio', 'Hora de inicio:') }}
                  <div class="input-group bootstrap-timepicker timepicker">
                    {{ Form::text('h_inicio', $horario->h_inicio, ['class' => 'form-control', 'placeholder' => 'Hora de Inicio'] ) }}
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  </div>
                  @if ($errors->has('h_inicio'))
                    <label for="h_inicio" generated="true" class="error">{{ $errors->first('h_inicio') }}</label>
                  @endif
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {{ Form::label('h_fin', 'Hora de finalización:') }}
                  <div class="input-group bootstrap-timepicker timepicker">
                    {{ Form::text('h_fin', $horario->h_fin, ['class' => 'form-control input-small', 'placeholder' => 'Hora de Finalización'] ) }}
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  </div>
                  @if ($errors->has('h_fin'))
                    <label for="h_fin" generated="true" class="error">{{ $errors->first('h_fin') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <label for="">Días de la semana</label><p>(Indique los días de la semana que se dictarán los módulos)</p>
            @foreach ($list_semana as $dia)
              <div class="chkContent" style="padding-bottom: 5px;">
                {{ Form::checkbox('cod_dia[]', $dia['cod_dia'], in_array($dia['cod_dia'], $weekend_horary) ,array('id' => 'cod_dia_'.$dia['cod_dia'], 'class' => 'flat') ) }}
                {{ $dia['dia'] }}
              </div>
            @endforeach
            <div style="padding-bottom: 5px;">
              @if ($errors->has('cod_dia'))
                <label for="cod_dia" generated="true" class="error">{{ $errors->first('cod_dia') }}</label>
              @endif
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  {{ Form::label('num_horas', 'Número de horas:') }}
                  {{ Form::text('num_horas', $horario->num_horas, ['class' => 'form-control', 'placeholder' => 'Número de Horas'] ) }}
                  @if ($errors->has('num_horas'))
                    <label for="num_horas" generated="true" class="error">{{ $errors->first('num_horas') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="num_taller">Talleres</label>
                  <select name="num_taller" id="num_taller" class="form-control" data-id-default="{{ $horario->num_taller }}">
                    <option value="" >-- Seleccione el número de Talleres --</option>
                    @foreach ($talleres as $key => $value)
                      <option value="{{ $key }}" @if($horario->num_taller == $key) selected="selected" @else @endif>{{ $key }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('num_taller'))
                    <label for="activo" generated="true" class="error">{{ $errors->first('num_taller') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="activo">Estado:</label>
                  {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], $horario->activo, ['class' => 'form-control'] ) }}
                  @if ($errors->has('activo'))
                    <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="ln_solid"></div>

            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.academic_schedule.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
              {{ Form::button('<span>Guardar</span>', array('class' => 'btn btn-5 btn-5a icon-save save', 'type' => 'submit')) }}
            </div>


            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('custom_js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
  <script src="{{ URL::asset('assets/js/app.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-academic-period.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-horary.js') }}"></script>
  <script>
    $(function(){

    });
  </script>
@stop

