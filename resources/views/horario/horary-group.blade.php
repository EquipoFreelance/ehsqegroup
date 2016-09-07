@extends('dashboard.layouts.master')

@section('content')

    <!-- Custom Templates -->
    <script id="response-template" type="text/x-handlebars-template">
        @{{#each response}}
        <tr>
            <td>@{{ id }}</td>
            <td>@{{ fec_inicio}} al @{{ fec_fin}} / @{{ h_inicio }} - @{{ h_inicio }}</td>
            <td>@{{ docente.persona.nombre }} @{{ docente.persona.ape_pat  }} @{{ docente.persona.ape_mat }}</td>
            <td>@{{ sede.nom_local }}</td>
            <td>@{{ modulo.nombre }}</td>
            <td>@{{ num_horas }}</td>
            <td>
                @{{#validate activo 1}}
                <span class="label label-success">Activo</span>
                @{{else}}
                <span class="label label-danger">No activo</span>
                @{{/validate}}
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
            <p style="margin-top: 15px">Listado de horarios por Grupo</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- INICIO TABLA FINAL -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <a href="{{ route('dashboard.grupo.index') }}" class="btn btn-5 btn-5a icon-return add"><span>Retornar</span></a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Horario</th>
                                <th>Docente</th>
                                <th>Local</th>
                                <th>Módulo</th>
                                <th>Horas</th>
                                <th>Estado</th>
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
    <script src="{{ URL::asset('assets/js/app-horary.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-templates-js.js') }}"></script>

    <script>
        listHorary({{ $cod_group }});
    </script>
@stop