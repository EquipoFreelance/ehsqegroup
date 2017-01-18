@extends('dashboard.layouts.master')

@section('content')
  <div class="form_content_block">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <br>
        <div class="x_panel">
          <div class="y_title">
            <h2><i class="fa fa-edit"></i> Nueva Ficha Auxiliar</h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <form action="#" class="form-horizontal form-label-left" name="store" id="store">

              {{ csrf_field() }}

            <div class="alert alert-dismissible fade out" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <i class="fa fa_icon"></i>
              <p class="message">Mensaje</p>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="nombre">Nombre</label>
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
                  <label for="nom_corto">Apellido paterno</label>
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
                  <label for="nom_corto">Apellido materno</label>
                  <input type="text" id="ape_mat" placeholder="Apellido materno" name="ape_mat"  class="form-control" value="{{ old('ape_mat') }}">
                  @if ($errors->has('ape_mat'))
                    <label for="ape_mat" generated="true" class="error">{{ $errors->first('ape_mat') }}</label>
                  @endif
                </div>
              </div>
            </div>


            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_doc_tip">Tipo de Documento</label>
                  {{ Form::select('cod_doc_tip', array('1' => 'DNI', '2' => 'Carnet de Extranjeria'), old('cod_doc_tip'), ['class' => 'form-control'] ) }}
                  @if ($errors->has('cod_doc_tip'))
                    <label for="cod_doc_tip" generated="true" class="error">{{ $errors->first('cod_doc_tip') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label  for="dni">DNI</label>
                  <input type="text" id="num_doc" placeholder="Número de documento" name="num_doc"  class="form-control" value="{{ old('num_doc') }}">
                  @if ($errors->has('num_doc'))
                    <label for="num_doc" generated="true" class="error">{{ $errors->first('num_doc') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.auxiliar.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
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
  <script src="{{ URL::asset('assets/js/jquery.validated.js') }}"></script>
  <script src="{{ URL::asset('assets/js/app-auxiliar-create.js') }}"></script>
@stop
