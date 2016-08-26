@extends('dashboard.layouts.master')

@section('content')
  <div class="form_content_block">

    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-edit"></i> Nueva</h2>
           <div class="clearfix"></div>
        </div>

        <div class="x_content">

        {!! Form::open(['route' => 'dashboard.enrollment.store', 'class' => 'form-horizontal form-label-left']) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="cod_alumno">Asignar alumno:</label>
              <select class="select2 form-control cod_alumno" id="cod_alumno" name="cod_alumno">
                <option value="-" selected="selected">Seleccione el alumno</option>
              </select>
              @if ($errors->has('cod_alumno'))
              <label for="cod_alumno" generated="true" class="error">{{ $errors->first('cod_alumno') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="fecha_inicio">Fecha de Inicio</label>
              <select name="fecha_inicio" id="fecha_inicio" class="form-control"></select>
              @if ($errors->has('fecha_inicio'))
              <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('fecha_inicio') }}</label>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="cod_modalidad">Modalidad</label>
              <select class="form-control" name="cod_modalidad" id="cod_modalidad" data-id-default="{{ old('cod_modalidad') }}"><option value="">-- Seleccione la modalidad --</option></select>
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
              <select class="form-control" name="cod_esp_tipo" id="cod_esp_tipo" data-id-default="{{ old('cod_esp_tipo') }}"><option>-- Seleccione el tipo de especialización --</option></select>
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
              <select class="form-control" name="cod_esp" id="cod_esp" data-id-default="{{ old('cod_esp') }}"><option value="">-- Seleccione la especialización --</option></select>
              @if ($errors->has('cod_esp'))
              <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
              @endif
            </div>
          </div>
        </div>


          <div class="chkContent">
            {{ Form::checkbox('activo', 1, ( old('activo') == 1)? true : false, ['class' => 'flat'] ) }}
            Validar matricula
            @if ($errors->has('activo'))
              <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
            @endif
          </div>

        <div class="ln_solid"></div>

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
  <script src="{{ URL::asset('assets/js/app-academic-schedule.js') }}"></script>
  <script>
    $(".cod_alumno").select2({
      theme: "classic",
       placeholder: 'Seleccione',
       ajax: {
           url: function (params) {
                return '/hsqegroup/api/students/search/' + params.term;
           },
           dataType: 'json',
           delay: 250,
           processResults: function (data, params) {
             var data_set = [];
             $.each(data.items, function(i, item) {
                 data_set.push({"id" : item.id, "text" : item.persona.nombre});
             });
             return {
               results: data_set
             };
           },
           cache: true
         },
       allowClear: true,
       templateResult : function (repo) {
        return repo.text;
      }
    }).on('select2:select', function (evt) {
      console.log($('.cod_alumno').val());
    });
  </script>

@stop
