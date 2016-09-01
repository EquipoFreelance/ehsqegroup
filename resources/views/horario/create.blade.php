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
        {!! Form::open(['route' => 'dashboard.academic_schedule.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{ Session::get('message') }}
            </div>
          @endif


          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="cod_grupo">Grupo</label>
                <select class="select2 form-control cod_grupo" name="cod_grupo" id="cod_grupo"></select>
                <input type="text" name="nom_grupo" id="nom_grupo" value="{{ old('nom_grupo')  }}" />
                @if ($errors->has('cod_grupo'))
                  <label for="cod_grupo" generated="true" class="error">{{ $errors->first('cod_grupo') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group content_info_group hide">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 set_info_group">

              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="cod_mod">Modulo</label>
                <select name="cod_mod" id="cod_mod" class="form-control"></select>
                <input type="text" name="nom_mod" id="nom_mod" value="{{ old('nom_mod')  }}" />
                <input type="text" name="cod_modalidad" id="cod_modalidad" value="{{ old('cod_modalidad')  }}" />
                <input type="text" name="cod_esp_tipo" id="cod_esp_tipo" value="{{ old('cod_esp_tipo')  }}" />
                <input type="text" name="cod_esp" id="cod_esp" value="{{ old('cod_esp')  }}" />

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
                <select name="cod_docente" id="cod_docente" class="form-control"></select>
                @if ($errors->has('cod_docente'))
                  <label for="cod_docente" generated="true" class="error">{{ $errors->first('cod_docente') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_docente">Auxiliar</label>
                <select name="cod_auxiliar" id="cod_auxiliar" class="form-control"></select>
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
                {{ Form::text('fec_inicio', old('fec_inicio'), ['class' => 'form-control', 'placeholder' => 'Fecha de Inicio'] ) }}
                @if ($errors->has('fec_inicio'))
                  <label for="fec_inicio" generated="true" class="error">{{ $errors->first('fec_inicio') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('h_inicio', 'Hora de inicio:') }}
                <div class="input-group bootstrap-timepicker timepicker">
                  {{ Form::text('h_inicio', old('h_inicio'), ['class' => 'form-control', 'placeholder' => 'Hora de Inicio'] ) }}
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
                @if ($errors->has('h_inicio'))
                  <label for="h_inicio" generated="true" class="error">{{ $errors->first('h_inicio') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('fec_fin', 'Fecha de finalización:') }}
                {{ Form::text('fec_fin', old('fec_fin'), ['class' => 'form-control', 'placeholder' => 'Fecha de Finalización'] ) }}
                @if ($errors->has('fec_fin'))
                  <label for="fec_fin" generated="true" class="error">{{ $errors->first('fec_fin') }}</label>
                @endif
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">

                {{ Form::label('h_fin', 'Hora de finalización:') }}
                <div class="input-group bootstrap-timepicker timepicker">
                  {{ Form::text('h_fin', old('h_fin'), ['class' => 'form-control input-small', 'placeholder' => 'Hora de Finalización'] ) }}
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
                {{ Form::checkbox('cod_dia[]', $dia['cod_dia'], null ,array('id' => 'cod_dia_'.$dia['cod_dia'], 'class' => 'flat') ) }}
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
                {{ Form::text('num_horas', old('num_horas'), ['class' => 'form-control', 'placeholder' => 'Número de Horas'] ) }}
                @if ($errors->has('num_horas'))
                  <label for="num_horas" generated="true" class="error">{{ $errors->first('num_horas') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="activo">Estado:</label>
                {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], old('activo'), ['class' => 'form-control'] ) }}
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
  <script src="{{ URL::asset('assets/js/app-horary.js') }}"></script>

  <script type="text/javascript">

    // Init JS Plugin TimePicker
    $('#h_inicio, #h_fin').timepicker({
      defaultTime: false
    });

    // Init JS Plugin Material Date Picker
    $(function(){
      if($('#fec_inicio').length){
        $('#fec_inicio').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
      }
      if($('#fec_fin').length){
        $('#fec_fin').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
      }
    });

    select2Default('#cod_mod', ($("#nom_mod").val() == '')? 'Busque y seleccione el Módulo' : $("#nom_mod").val());

    cod_grupo       = '{{ old('cod_grupo') }}';
    cod_modalidad   = '{{ old('cod_modalidad') }}';
    cod_esp_tipo    = '{{ old('cod_esp_tipo') }}';
    cod_esp         = '{{ old('cod_esp') }}';

    select2Generate('#cod_grupo', ajax_grupo, (cod_grupo == '')? 'Busque y seleccione el grupo' : $("#nom_grupo").val(), 1).on('select2:select', function (evt) {

      data_set.map(function (obj) {

        // Si el grupo coincide colocamos los atributos en las variables locales
        if ( obj.id == $('#cod_grupo').val() ) {

          $("#nom_grupo").val(obj.text).attr("value", obj.text);

          $("#cod_modalidad").val(obj.cod_modalidad).attr("value", obj.cod_modalidad);
          $("#cod_esp_tipo").val(obj.cod_esp_tipo).attr("value", obj.cod_esp_tipo);
          $("#cod_esp").val(obj.cod_esp).attr("value", obj.cod_esp);
          // Colocar parametros directos en la función
          cod_modalidad = $("#cod_modalidad").val();
          cod_esp_tipo  = $("#cod_esp_tipo").val();
          cod_esp       = $("#cod_esp").val();

          var source   = $("#response-template").html();
          var template = Handlebars.compile(source);
          var html     = template(obj);

          $(".content_info_group").removeClass("hide").addClass("show");
          $(".set_info_group").empty().html(html);

          $("#cod_mod").prop("disabled", false);

          // Aplicando la carga asincrona
          select2Generate('#cod_mod', ajax_modulo, ($("#nom_mod").val() == '')? 'Busque y seleccione el Módulo' : $("#nom_mod").val(), 0).on('select2:select', function (evt) {

            data_set.map(function (obj) {

              // Si el grupo coincide colocamos los atributos en las variables locales
              if ( obj.id == $("#cod_mod").val() ) {

                $("#nom_mod").val(obj.text).attr("value", obj.text);
                //console.log( obj.text );
                //console.log(obj);
                return true;

              } else {

                return null;

              }

            });


          });

          return true;

        } else {

          return null;

        }

      });

    });

    if(cod_grupo != ''){
      $("#cod_grupo").val({{ old('cod_grupo') }});
      $("#cod_mod").prop("disabled", false);
      select2Generate('#cod_mod', ajax_modulo, ($("#nom_mod").val() == '')? 'Busque y seleccione el Módulo' : $("#nom_mod").val(), 0).on('select2:select', function (evt) {

        data_set.map(function (obj) {

          // Si el grupo coincide colocamos los atributos en las variables locales
          if ( obj.id == $("#cod_mod").val() ) {

            $("#nom_mod").val(obj.text).attr("value", obj.text);
            //console.log( obj.text );
            //console.log(obj);
            return true;

          } else {

            return null;

          }

        });


      });
    }


    select2Generate('#cod_docente', ajax_teachers, 'Busque y seleccione el Docente', 1).on('select2:select', function (evt) {

      data_set.map(function (obj) {

        // Si el grupo coincide colocamos los atributos en las variables locales
        if ( obj.id == $('#cod_docente').val() ) {

          console.log(obj);

          return true;

        } else {

          return null;

        }

      });

    });
    select2Generate('#cod_auxiliar', ajax_auxiliary, 'Busque y seleccione el Auxiliar', 1).on('select2:select', function (evt) {

      data_set.map(function (obj) {

        // Si el grupo coincide colocamos los atributos en las variables locales
        if ( obj.id == $('#cod_docente').val() ) {

          console.log(obj);

          return true;

        } else {

          return null;

        }

      });

    });

  </script>
@stop

