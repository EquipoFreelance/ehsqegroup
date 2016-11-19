@extends('dashboard.layouts.master')

@section('custom_css')
    <style>
        .content_payment_method_student{
            display: none;
        }
    </style>
@stop

@section('content')

    <!-- Custom Templates -->
    <script id="response-template-concepts" type="text/x-handlebars-template">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="mount">Detalle de los conceptos necesario para validar una matricula</label>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 ">
            <table class="tablex table-bordered" cellspacing="0" width="100%">
                <tr>
                    <td width="300"><b>Concepto</b></td>
                    <td width="10"><b>Monto</b></td>
                    <td width="10"><b>Validar</b></td>
                </tr>
                @{{#each concepts}}
                <tr>
                    <td>
                        @{{ concept_name }}
                        <input type="hidden" name="enrollment_concept_id[]" value="@{{ concept_id }}" />
                    </td>
                    <td>
                        @{{ concept_amount }}
                        <input type="hidden"  class="form-control" name="enrollment_concept_amount[]" placeholder="S/. 0.00" value="@{{ concept_amount }}">
                    </td>
                    <td>
                        <input type="hidden" class="form-control" id="enrollment_concept_verified_@{{ concept_id }}" name="enrollment_concept_verified_[]" value="@{{ concept_verifided }}">
                        <input type="checkbox" name="enrollment_concept_verified[]" id="checked_@{{ concept_id }}" @{{#if concept_verifided}} checked="checked" @{{else}} @{{/if}} class="form-control enrollment_concept_verified flatedit" value="1">
                    </td>
                </tr>
                @{{/each}}
            </table>
        </div>
    </script>

    <div class="form_content_block">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <br>
                <div class="x_panel">
                    <div class="y_title">
                        <h2><i class="fa fa-edit"></i> Validación de Pagos</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_validacion_pagos" aria-controls="pinfo" role="tab" data-toggle="tab">Validar Pagos</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="tab_validacion_pagos">

                                <form method="POST" name="frm_edit_enrollment_payment_concept" id="frm_edit_enrollment_payment_concept" action="#">

                                    <div class="alert alert-success alert-dismissible fade out" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <span class="message"></span>
                                    </div>

                                    <input type="hidden" name="id_enrollment" id="id_enrollment" value="{{ $id_enrollment }}">

                                    <div class="form-group">
                                        <label for="student">Alumno:</label>
                                        <input type="text" name="student" id="student" class="form-control" readonly="readonly" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="especializacion">Periodo academico:</label>
                                        <input type="text" name="period_academy" id="period_academy" class="form-control" readonly="readonly" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="especializacion">Especialización:</label>
                                        <input type="text" name="especializacion" id="especializacion" class="form-control" readonly="readonly" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="modalidad">Modalidad:</label>
                                        <input type="text" name="modalidad" id="modalidad" class="form-control" readonly="readonly" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha-inscription">Fecha de inscripción:</label>
                                        <input type="text" name="fecha-inscription" id="fecha-inscription" class="form-control" readonly="readonly" value="">
                                    </div>

                                    <!-- Conceptos -->
                                    <div class="form-group content_item content_concept" style="display:block">
                                        <br>
                                        <div class="row content_concept_items"></div>

                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="form-group">
                                        <div class="form-group btncontrol">
                                            <a href="{{ route('dashboard.creditos.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
                                            <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
                                        </div>
                                    </div>


                                </form>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-creditos.js') }}"></script>
@stop