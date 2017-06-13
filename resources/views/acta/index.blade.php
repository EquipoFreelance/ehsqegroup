@extends('dashboard.layouts.master')

@section('content')
    <div class="">
        <!-- Custom Templates -->
        <script id="response-template" type="text/x-handlebars-template">
            @{{#each response}}
            <tr>
                <td>@{{id}}</td>
                <td>@{{ created_at}}</td>
                <td>@{{ student.persona.num_doc}}</td>
                <td>@{{ student.persona.nombre}} @{{student.persona.ape_pat}} @{{student.persona.ape_mat}}</td>
                <td>@{{ student.persona.correo }}</td>
                <td>@{{ student.persona.num_phone  }} / @{{ student.persona.num_cellphone }}</td>
                <td>@{{ type_specialization.nom_esp_tipo }} / @{{ specialization.nom_esp }}</td>
                <td>@{{ modality.nom_mod }}</td>
                <td>
                    @{{#validate activo 1}}
                    <span class="label label-success">Matriculado</span>
                    @{{else}}
                    <span class="label label-danger">Por Matricular</span>
                    @{{/validate}}
                </td>
                <td>
                    <a href="enrollment/@{{id}}/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>
                </td>
            </tr>
            @{{/each}}
        </script>

        <div class="page-title">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <h1>Actas</h1>
            <p style="margin-top: 15px">Generador de Actas.</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- INICIO TABLA FINAL -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <form class="form-horizontal" id="find" name="find" method="post" action="">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Modalidad: </label>
                                        <select class="form-control" name="id_mod" id="id_mod">
                                            <option value="-">-- Seleccione el modalidad --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Tipo: </label>
                                        <select class="form-control" name="id_esp_tipo" id="id_esp_tipo">
                                            <option value="-">-- Seleccione la tipo especialización --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Especialización: </label>
                                        <select class="form-control" name="id_esp" id="id_esp">
                                            <option value="-">-- Seleccione las especializaciones --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-5 btn-5a icon-save save"><span style="color: #FFFFFF">Buscar</span></button>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="display table table-stripedx table-borderedx nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name Group</th>
                                <th>Ver Acta</th>
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
    <script src="{{ URL::asset('assets/js/jquery.validated.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-acta.js') }}"></script>
@stop
