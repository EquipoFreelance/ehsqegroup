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
                @{{#each response}}
                <tr>
                    <td>@{{ name_concept }}
                        <input type="hidden" name="enrollment_concept_id[]" value="@{{ id }}" />
                    </td>
                    <td class="">
                        <input type="text" readonly="readonly" class="form-control concept_amount amount_@{{id_concept}}_@{{ id_payment_type }}" id="amount_@{{id_concept}}_@{{ id_payment_type }}" name="enrollment_concept_amount[]" placeholder="S/. 0.00" value="@{{ amount }}">
                    </td>
                    <td class="">
                        <input type="checkbox" name="enrollment_concept_active[]" id="checked_@{{ id }}" class="form-control" value="1">
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

                                    <input type="hidden" name="id_enrollment" id="id_enrollment" value="{{ $student->enrollments()->first()->id }}">

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