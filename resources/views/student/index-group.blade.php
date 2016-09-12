@extends('dashboard.layouts.master')
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="search">Buscar:</label>
                                    <input type="text" id="search" name="search" class="form-control">
                                </div>
                            </div>
                        </div>
                        <label>Resultado</label>
                        <table id="datatable-responsive" class="table table-stripedx table-borderedx dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Código de Alumno</th>
                                <th>Nombres y Apellidos</th>
                            </tr>
                            </thead>
                            <tbody class="modal_items">

                            </tbody>
                        </table>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <!-- Custom Templates -->
        <script id="response-template" type="text/x-handlebars-template">
            @{{#each response}}
            <tr>
                <td>@{{ id }}</td>
                <td>@{{ name }}</td>
            </tr>
            @{{/each}}
        </script>

        <script id="response-template-1" type="text/x-handlebars-template">
            @{{#each response}}
            <tr>
                <td><input type="checkbox" name="students[]" value="@{{ cod_alumno }}"></td>
                <td>@{{ cod_alumno }}</td>
                <td>@{{ student.persona.ape_pat }} @{{ student.persona.ape_mat }}, @{{ student.persona.nombre }}</td>
            </tr>
            @{{/each}}
        </script>


        <div class="page-title">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <h1>Grupo - Alumnos</h1>
            <p style="margin-top: 15px">Lista de alumnos asignados al grupo</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- INICIO TABLA FINAL -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <a href="#" class="btn btn-5 btn-5a icon-add add" data-toggle="modal" data-target="#myModal"><span>Asignar</span></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-stripedx table-borderedx dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Código de Alumno</th>
                                <th>Nombres y Apellidos</th>
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
    <script src="{{ URL::asset('assets/js/app-students.js') }}"></script>
    <script>
        listAssignedStudents({{ $cod_grupo }});

        $(function(){
            $( "#search" ).keyup(function( event ) {

            }).keydown(function( event ) {
                if ( event.which == 13 ) {
                    event.preventDefault();
                    listStudentsSearch($(this).val());
                }
            });
        });
    </script>
@stop

