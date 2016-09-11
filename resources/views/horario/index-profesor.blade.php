@extends('dashboard.layouts.master')

@section('content')

    <!-- Custom Templates -->
    <script id="response-template" type="text/x-handlebars-template">
        @{{#each response}}
        <tr>
            <td>@{{ academic_period.start_date }}</td>
            <td>@{{ fec_inicio}} al @{{ fec_fin}} / @{{ h_inicio }} - @{{ h_inicio }}</td>
            <td>@{{ sede.nom_local }}</td>
            <td>@{{ modulo.nombre }}</td>
            <td>@{{ num_horas }}</td>
            <td>
                @{{ num_taller }}
            </td>
            <td>
                <a href="academic_schedule/@{{id}}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
            </td>
        </tr>
        @{{/each}}
    </script>

    <div class="">
        <div class="page-title">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <h1>Horarios</h1>
            <p style="margin-top: 15px">Horario asignados</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- INICIO TABLA FINAL -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <div class="form-group">
                            <label>Periódo académico: </label>
                            <select class="form-control id_academic_period_list" name="id_academic_period" id="id_academic_period" attr-id-docente="{{  Auth::user()->cod_persona }}"></select>
                        </div>
                    </div>

                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Periodo académico</th>
                                <th>Horario</th>
                                <th>Local</th>
                                <th>Módulo</th>
                                <th>Horas</th>
                                <th>Talleres</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="items"></tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- FINAL TABLA FINAL -->
        </div>
    </div>
@stop

@section('custom_js')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-academic-period.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-horary.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-templates-js.js') }}"></script>
@stop