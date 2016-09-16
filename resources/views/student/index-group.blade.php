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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="search">Buscar:</label>
                                <input type="text" id="search" name="search" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <form action="#" class="form-horizontal form-label-left" name="group_students" id="group_students" method="post">
                        {!! Form::token() !!}
                        <input type="hidden" name="cod_grupo" value="{{ $cod_grupo }}">
                        <input type="hidden" name="set_students" value="">
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
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-5 btn-5a icon-return return" data-dismiss="modal"><span>Cerrar</span></button>
                    <button type="button" class="btn btn-5 btn-5a icon-save save btn_store"><span>Guardar</span></button>
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
                <td><input type="checkbox" name="student[]" id="student" class="student" data-id="@{{ cod_alumno }}" value="@{{ cod_alumno }}-@{{#if is_asignemnt}}true@{{else}}false@{{/if}}" @{{#if is_asignemnt}} checked @{{/if}}></td>
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

        $(function(){

            listAssignedStudents({{ $cod_grupo }});
            listStudentsSearch({{ $cod_grupo }}, '-');

            $( "#search" ).keydown(function( event ) {
                if ( event.which == 13 ) {
                    event.preventDefault();
                    var search = '-';
                    if($(this).val() != ''){
                        search = $(this).val();
                    }

                    listStudentsSearch({{ $cod_grupo }}, search);
                }
            });

            $(document).delegate(".student", "click", function(){
                $(this).attr("value", "");
                if($(this).is(':checked')){
                    $(this).attr("value", $(this).attr("data-id") + "-true");
                } else {
                    $(this).attr("value", $(this).attr("data-id") + "-false");
                }

            });

            $(".btn_store").click(function(){

                var searchIDs = $('input[name="student[]"]').map(function(){
                    return $(this).val();
                }).get();

                $('input[name="set_students"]').val(searchIDs).attr("value", searchIDs);

                storeAssignGroup($("#group_students").serializeArray(), $(this));

            });

        });

    </script>
@stop

