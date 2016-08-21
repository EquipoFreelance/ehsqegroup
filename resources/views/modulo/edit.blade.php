@extends('dashboard.layouts.master')
@section('content')
<div class="form_content_block">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <br>
      <div class="x_panel">
        <div class="y_title">
           <h2><i class="fa fa-edit"></i>Editar</h2>
           <div class="clearfix"></div>
        </div>
        <div class="x_content">

          {!! Form::model($modulo, [ 'method' => 'PUT', 'route' => ['dashboard.modulo.update', $modulo->id], 'class' => 'form-horizontal form-label-left' ]) !!}

          @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>¡Perfecto!</strong>{{ Session::get('message') }}
          </div>
          @endif

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="cod_modalidad">Modalidad</label>
                <select name="cod_modalidad" id="cod_modalidad" class="form-control" data-id-default="{{ $modulo->cod_modalidad }}">
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="cod_esp_tipo">Tipo de Especialización</label>
                <select name="cod_esp_tipo" id="cod_esp_tipo" class="form-control" data-id-default="{{ $modulo->cod_esp_tipo }}">
                  <option value=""></option>
                </select>
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
                <select name="cod_esp" id="cod_esp" class="form-control" data-id-default="{{ $modulo->cod_esp }}">
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
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ $modulo->nombre }}">
                @if ($errors->has('nombre'))
                <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="nom_corto">Nombre corto</label>
                <input type="text" id="nom_corto" placeholder="Nombre corto" name="nom_corto"  class="form-control" value="{{ $modulo->nom_corto }}">
                @if ($errors->has('nom_corto'))
                <label for="nom_corto" generated="true" class="error">{{ $errors->first('nom_corto') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" >{{ $modulo->descripcion }}</textarea>
                @if ($errors->has('descripcion'))
                <label for="descripcion" generated="true" class="error">{{ $errors->first('descripcion') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="num_taller">Talleres</label>
                <select name="num_taller" id="num_taller" class="form-control" data-id-default="{{ $modulo->num_taller }}">
                  <option value="" >-- Seleccione el número de Talleres --</option>
                  @foreach ($talleres as $key => $value)
                    <option value="{{ $key }}" @if($modulo->num_taller == $key) selected="selected" @else @endif>{{ $key }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="activo">Estado</label>
                {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], $modulo->activo, ['class' => 'form-control'] ) }}
                @if ($errors->has('activo'))
                <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
                @endif
              </div>
            </div>
          </div>

          <div class="ln_solid"></div>

          <div class="form-group btncontrol">
            <a href="{{ route('dashboard.modulo.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
            <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
          </div>

          {!! Form::close() !!}

          {!! Form::open([
                      'method' => 'DELETE',
                      'route' => ['dashboard.modulo.destroy', $modulo->id]
                  ]) !!}
              <button type="submit" class="btn btn-danger cancel_btn">Eliminar</button>
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
