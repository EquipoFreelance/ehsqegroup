@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
    @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')
    <div class="">

        <!-- Custom Templates -->
        <script id="response-template" type="text/x-handlebars-template">
            @{{#each response}}
            <tr>
                <td>@{{ id }}</td>
                <td>@{{ created_at }}</td>
                <td>@{{ student }}</td>
                <td>@{{ email }}</td>
                <td>@{{ modality }}</td>
                <td>@{{ type_specialty }}</td>
                <td>@{{ specialty }}</td>
                <td>@{{ academic_period }}</td>
                <td>@{{ creation_date }}</td>
                <td>
                    <a href="inscription/@{{ id }}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
                </td>
            </tr>
            @{{/each}}
        </script>

        <div class="page-title">
            @if(Session::has('message'))
                <div class="alert @if(Session::has('class')) {{ Session::get('class') }} @else alert-info @endif ">
                    {{ Session::get('message') }}
                </div>
            @endif

            <h1>Reporte de Contabilidad</h1>
            <p style="margin-top: 15px"></p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- INICIO TABLA FINAL -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-stripedx table-borderedx dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Fec. Registro</th>
                                <th>Ejecutivo Comercial</th>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Celular</th>
                                <th>Tipo Doc</th>
                                <th>RUC</th>
                                <th>Empresa</th>
                                <th>Modalidad</th>
                                <th>Tipo de expecialización</th>
                                <th>Especialización</th>
                                <th>Fecha Programa</th>
                                <th>Forma de Pago</th>
                                <th>Contado</th>
                                <th>Cuota 1</th>
                                <th>Matricula</th>
                                <th>Certificado</th>
                                <th>Num Cuotas</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="items">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- FINAL TABLA FINAL -->
        </div>
    </div>
@stop

@section('custom_js')
    <script src="{{ URL::asset('assets/js/app-templates-js.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-contabilidad.js') }}"></script>
@stop
