@extends('dashboard.layouts.master')

@section('content')
<div class="form_content_block">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="x_title">
          <h1 style="font-size: 18px">Nuevo</h1>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
        {!! Form::open(['route' => 'dashboard.grupo.store', 'class' => 'form-horizontal form-label-left']) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{ Session::get('message') }}
            </div>
          @endif

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_modalidad">Modalidad:</label>
                <select name="cod_modalidad" id="cod_modalidad" class="form-control" data-id-default="{{ old('cod_modalidad') }}"></select>
                @if ($errors->has('cod_modalidad'))
                  <label for="cod_modalidad" generated="true" class="error">{{ $errors->first('cod_modalidad') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_esp_tipo">Tipo de Especialización:</label>
                <select name="cod_esp_tipo" id="cod_esp_tipo" class="form-control" data-id-default="{{ old('cod_esp_tipo') }}"></select>
                @if ($errors->has('cod_esp_tipo'))
                  <label for="cod_esp_tipo" generated="true" class="error">{{ $errors->first('cod_esp_tipo') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label for="cod_esp">Especialización:</label>
                <select name="cod_esp" id="cod_esp" class="form-control form-control" data-id-default="{{ old('cod_esp') }}">
                  <option value="">-- Seleccione la especialización --</option>
                </select>
                @if ($errors->has('cod_esp'))
                  <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_esp') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('cod_sede', 'Sede:') }}
                <label for="cod_sede">Sede:</label>
                {{ Form::select('cod_sede', $sedes, old('cod_sede'), ['class' => 'form-control'] ) }}
                @if ($errors->has('cod_sede'))
                  <label for="cod_sede" generated="true" class="error">{{ $errors->first('cod_sede') }}</label>
                @endif
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12col-xs-12">
                {{ Form::label('nom_grupo', 'Nombre del grupo:') }}
                {{ Form::text('nom_grupo', old('nom_grupo'), ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de Grupo'] ) }}
                @if ($errors->has('nom_grupo'))
                  <label for="nom_grupo" generated="true" class="error">{{ $errors->first('nom_grupo') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                {{ Form::label('descripcion', 'Descripción:') }}
                {{ Form::textarea('descripcion', old('descripcion'), ['class' => 'form-control', 'placeholder' => 'Ingrese una Descripción'] ) }}
                @if ($errors->has('descripcion'))
                  <label for="descripcion" generated="true" class="error">{{ $errors->first('descripcion') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('fe_inicio', 'Fecha de inicio:') }}
                {{ Form::text('fe_inicio', old('fe_inicio'), ['class' => 'form-control', 'placeholder' => 'Seleccione la fecha de inicio'] ) }}
                @if ($errors->has('fe_inicio'))
                  <label for="fe_inicio" generated="true" class="error">{{ $errors->first('fe_inicio') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('fe_fin', 'Fecha de fin:') }}
                {{ Form::text('fe_fin', old('fe_fin'), ['class' => 'form-control', 'placeholder' => 'Seleccione la fecha de finalización'] ) }}
                @if ($errors->has('fe_fin'))
                  <label for="fe_fin" generated="true" class="error">{{ $errors->first('fe_fin') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('num_min', 'Número mínimo:') }}
                {{ Form::text('num_min', old('num_min'), ['class' => 'form-control', 'placeholder' => 'Número máximo de participantes en el Grupo'] ) }}
                @if ($errors->has('num_min'))
                  <label for="num_min" generated="true" class="error">{{ $errors->first('num_min') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('num_max', 'Número máximo:') }}
                {{ Form::text('num_max', old('num_max'), ['class' => 'form-control', 'placeholder' => 'Número mínimo de participantes en el Grupo'] ) }}
                @if ($errors->has('num_max'))
                  <label for="num_max" generated="true" class="error">{{ $errors->first('num_max') }}</label>
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
            <a href="{{ route('dashboard.grupo.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
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
@stop