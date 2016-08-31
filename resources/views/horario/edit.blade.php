@extends('dashboard.layouts.master')

@section('content')
<div class="form_content_block">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="y_title">
          <h2><i class="fa fa-edit"></i> Editar</h2>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">

        {!! Form::model($horario, [ 'method' => 'PUT', 'route' => ['dashboard.horario.update', $horario->id], 'class' => 'form-horizontal form-label-left' ]) !!}

          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{ Session::get('message') }}
            </div>
          @endif

          <div class="form-group">
            {{ Form::hidden('cod_mod', $cod_mod) }}
            {{ Form::hidden('cod_grupo', $id) }}
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                {{ Form::label('cod_mod', 'Modulo:') }}
                {{ Form::select('cod_mod', $list_modulos, $horario->cod_mod, ['class' => 'form-control horario_cod_local'] ) }}
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('cod_docente', 'Docente:') }}
                {{ Form::select('cod_docente', $list_docentes, $horario->cod_docente, ['class' => 'form-control horario_cod_local'] ) }}
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('cod_auxiliar', 'Personal de Apoyo:') }}
                {{ Form::select('cod_auxiliar', $list_auxiliar, $cod_auxiliar, ['class' => 'form-control horario_cod_local'] ) }}
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
                {{ Form::text('fec_inicio', $horario->fec_inicio, ['class' => 'form-control'] ) }}
                @if ($errors->has('fec_inicio'))
                  <label for="fec_inicio" generated="true" class="error">{{ $errors->first('fec_inicio') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('h_inicio', 'Hora de inicio:') }}
                {{ Form::text('h_inicio', $horario->h_inicio, ['class' => 'form-control'] ) }}
                @if ($errors->has('h_inicio'))
                  <label for="h_inicio" generated="true" class="error">{{ $errors->first('h_inicio') }}</label>
                @endif
               </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('fec_fin', 'Fecha de fin:') }}
                {{ Form::text('fec_fin', $horario->fec_fin, ['class' => 'form-control'] ) }}
                @if ($errors->has('fec_fin'))
                  <label for="fec_fin" generated="true" class="error">{{ $errors->first('fec_fin') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('h_fin', 'Hora de fin:') }}
                {{ Form::text('h_fin', $horario->h_fin, ['class' => 'form-control'] ) }}
                @if ($errors->has('h_fin'))
                  <label for="h_fin" generated="true" class="error">{{ $errors->first('h_fin') }}</label>
                @endif
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('cod_dia', 'Días:') }}<br>
                @foreach ($list_semana as $dia)
                  {{ Form::checkbox('cod_dia[]', $dia['cod_dia'], in_array($dia['cod_dia'], $weekend_horary) ,array('id' => 'cod_dia_'.$dia['cod_dia']) ) }}
                  {{ Form::label('cod_dia_'.$dia['cod_dia'], $dia['dia']) }}<br>
                @endforeach
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('num_horas', 'Número de horas:') }}
                {{ Form::text('num_horas', $horario->num_horas, ['class' => 'form-control'] ) }}
                @if ($errors->has('num_horas'))
                  <label for="num_horas" generated="true" class="error">{{ $errors->first('num_horas') }}</label>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::label('cod_local', 'Local:') }}
                {{ Form::select('cod_local', $list_locales, $horario->cod_local, ['class' => 'form-control horario_cod_local'] ) }}
                @if ($errors->has('cod_local'))
                  <label for="activo" generated="true" class="error">{{ $errors->first('cod_local') }}</label>
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
            <a href="{{ route('dashboard.grupo.horario.list', $id) }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
            {{ Form::button('<span>Guardar</span>', array('class' => 'btn btn-5 btn-5a icon-save save', 'type' => 'submit')) }}
          </div>


        {!! Form::close() !!}
      </div>

      </div>
    </div>
  </div>
</div>
@stop
