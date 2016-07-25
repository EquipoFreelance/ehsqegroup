@extends('layouts.layout-enrollments')

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
           <h2><i class="fa fa-edit"></i> Nueva Matricula</h2>
           <div class="clearfix"></div>
        </div>
        <br>
        <div class="x_content">

        {!! Form::open(['route' => 'dashboard.enrollment.store', 'class' => 'form-horizontal form-label-left']) !!}

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>¡Perfecto!</strong>{{ Session::get('message') }}
        </div>
        @endif

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_alumno">Asignar alumno:</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="select2 form-control cod_alumno" id="cod_alumno" name="cod_alumno">
              <option value="-" selected="selected">Seleccione el alumno</option>
            </select>
            @if ($errors->has('cod_alumno'))
            <label for="cod_alumno" generated="true" class="error">{{ $errors->first('cod_alumno') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="fecha_inicio">Fecha de Inicio</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="fecha_inicio" id="fecha_inicio" data-id-default="{{ old('fecha_inicio') }}">
              <option value="">-- Seleccione la fecha de inicio --</option>
              <option value="2016-07-16">2016-07-16</option>
              <option value="2016-07-12">2016-07-12</option>
            </select>
            @if ($errors->has('fecha_inicio'))
            <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('fecha_inicio') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_modalidad">Modalidad</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_modalidad" id="cod_modalidad" data-id-default="{{ old('cod_modalidad') }}"><option value="">-- Seleccione la modalidad --</option></select>
            @if ($errors->has('cod_modalidad'))
            <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('cod_modalidad') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_esp_tipo">Tipo de Especialización</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_esp_tipo" id="cod_esp_tipo" data-id-default="{{ old('cod_esp_tipo') }}"><option>-- Seleccione el tipo de especialización --</option></select>
            @if ($errors->has('cod_esp_tipo'))
            <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cod_esp">Especialización</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" name="cod_esp" id="cod_esp" data-id-default="{{ old('cod_esp') }}"><option value="">-- Seleccione la especialización --</option></select>
            @if ($errors->has('cod_esp'))
            <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="activo">Validar matricula</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::checkbox('activo', 1, ( old('activo') == 1)? true : false ) }}
            @if ($errors->has('activo'))
            <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
            @endif
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-12" style="float: right">
            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.enrollment.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
              <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
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

@section('custom_js')
  <script src="{{ URL::asset('assets/js/app.js') }}"></script>
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
         //console.log(repo);

         /*if(repo.items){
           return 'No result';
         }*/
         //if (!repo) return 'No result';

         /*var markup = "<div class='select2-result-repository clearfix'>" +
         "<div class='select2-result-repository__avatar'><img src='http://api.hsqegroup.app/assets/images/users/QnWpINtxvF.png' class='img-circle profile_img' /></div>" +
         "<div class='select2-result-repository__meta'>" +
         "<div class='select2-result-repository__title'>" + repo.text + "</div>";*/

        /*if (repo.loading) return repo.text;

        var markup = "<div class='select2-result-repository clearfix'>" +
          "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
          "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

        if (repo.description) {
          markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
        }

        markup += "<div class='select2-result-repository__statistics'>" +
          "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
          "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
          "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
        "</div>" +
        "</div></div>";

        return markup;*/
        return repo.text;
      }
    }).on('select2:select', function (evt) {
      console.log($('.cod_alumno').val());
    });
  </script>
@stop
