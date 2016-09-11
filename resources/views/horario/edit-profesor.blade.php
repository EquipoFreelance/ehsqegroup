@extends('dashboard.layouts.master')

@section('content')
    <div class="form_content_block">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <br>
                <div class="x_panel">

                    <div class="y_title">
                        <h2><i class="fa fa-edit"></i> Editar Horario</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        {!! Form::model($horario, [ 'method' => 'PUT', 'route' => ['teacher.academic_schedule.update', $horario->id], 'class' => 'form-horizontal form-label-left' ]) !!}

                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="id_academic_period">Periodo Académico:</label>
                                    <div>
                                        <p class="form-control-static">{{ $horario->academic_period->start_date  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="cod_grupo">Grupo:</label>
                                    <div>
                                        <p class="form-control-static">{{ $horario->grupo->nom_grupo  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="cod_mod">Modulo:</label>
                                    <div>
                                        <p class="form-control-static">
                                    {{ $horario->modulo->nombre  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="cod_docente">Docente:</label>
                                    <div>
                                        <p class="form-control-static">{{ $horario->docente->persona->nombre  }},
                                    {{ $horario->docente->persona->ape_pat  }}
                                    {{ $horario->docente->persona->ape_mat  }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="cod_auxiliar">Auxiliar:</label>
                                    <div>
                                        <p class="form-control-static">@foreach ($horario->auxiliares as $key => $value)
                                        {{ $value->persona->nombre  }},
                                        {{ $value->persona->ape_pat  }}
                                        {{ $value->persona->ape_mat  }}
                                    @endforeach</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::label('fec_inicio', 'Fecha de inicio:') }}
                                    <div>
                                        <p class="form-control-static">{{ $horario->fec_inicio }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::label('fec_fin', 'Fecha de finalización:') }}
                                    <div>
                                        <p class="form-control-static">{{ $horario->fec_fin }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::label('h_inicio', 'Hora de inicio:') }}
                                    <div>
                                        <p class="form-control-static">{{ $horario->h_inicio }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::label('h_fin', 'Hora de finalización:') }}
                                    <div>
                                        <p class="form-control-static">{{ $horario->h_fin }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    {{ Form::label('num_horas', 'Número de horas:') }}
                                    <div>
                                        <p class="form-control-static">{{ $horario->num_horas }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="num_taller">Talleres</label>
                                    <p>Seleccione el número de talleres que dictará en este Grupo</p>
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


                        <div class="ln_solid"></div>

                        <div class="form-group btncontrol">
                            <a href="{{ route('teacher.academic_schedule.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
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

