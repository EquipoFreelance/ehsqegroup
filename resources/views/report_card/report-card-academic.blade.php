@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')

   <!-- Custom Templates -->
   <script id="response-template" type="text/x-handlebars-template">

      @{{#each response}}
       <tr>
         <td>@{{ ape_pat }} @{{ ape_mat }}, @{{ nombre  }}

         </td>

          @{{#with enrollment}}
                  <input type="hidden" name="id_enrollment_id[]" value="@{{ id_enrollment }}" >
                  @{{#with report}}

                       @{{#with note_project}}
                        <td align="center">
                            <input type="text" name="note_project[]" value="@{{ num_nota }}" class="form-control" style="width: 70px; text-align: center;">
                            <input type="hidden" name="note_project_id[]" value="@{{ id }}" class="form-control" style="width: 70px; text-align: center;">
                        </td>
                       @{{/with}}

                       @{{#with note_sustent}}
                        <td align="center">
                            <input type="text" name="note_sustent[]" value="@{{ num_nota }}" class="form-control" style="width: 70px; text-align: center;">
                            <input type="hidden" name="note_sustent_id[]" value="@{{ id }}" class="form-control" style="width: 70px; text-align: center;">
                        </td>
                       @{{/with}}

                  @{{/with}}

                   <td align="center">
                       @{{ prom  }}
                   </td>
          @{{/with}}
      </tr>
      @{{/each}}

   </script>

   <script id="response-template-head" type="text/x-handlebars-template">
      <tr>
         <th>Alumno</th>
         <th >Proyecto</th>
         <th>Sustentación</th>
         <th>Promedio</th>
      </tr>
   </script>

  <div class="">
    <div class="page-title">

       <div class="alert alert-info" style="display:none">

       </div>

      <h1>Ingreso de Notas</h1>
      <p style="margin-top: 15px">Ingreso de Notas de Proyecto y sustentación</p>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- INICIO TABLA FINAL -->
      <div class="col-md-12 col-sm-12 col-xs-12">

         <div class="x_panel">
         <!--
         <div class="y_title">
            <h2><i class="fa fa-file-text-o"></i> Notas de Proyecto</h2>
            <div class="clearfix"></div>
         </div>
         -->
            <div class="x_content">
               <form id="store_report_card" name="store_report_card" class="form-horizontal form-label-left" method="POST" action="#">
                  {!! Form::token() !!}
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <label for="profesor_codigo_ca">Grupos</label>
                           <select data-id-default="{{ old('group') }}" class="select2 form-control" id="group" name="group" data-placeholder="Seleccione la Especialización" onpaste="return false;">
                              <option>-- Seleccione el grupo asignado --</option>
                           </select>
                        </div>
                        <!--<div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="profesor_codigo_ca">Seleccione el tipo de nota</label>
                           <select data-id-default="{{ old('cod_mod') }}" class="select2 form-control" id="cod_mod" name="cod_mod" data-placeholder="Seleccione el Módulo" onpaste="return false;">
                              <option>-- Seleccione el Módulo --</option>
                              <option value="1">Nota Proyecto</option>
                              <option value="2">Nota Sustentación</option>
                              <option value="3">Ver todos</option>
                           </select>
                        </div>-->
                     </div>
                  </div>
                  <br>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                     <thead class="report_card_header" style="display: none;">

                        <tr>
                            <th>Alumno</th>
                            <th align="center">Proyecto</th>
                            <th align="center">Sustentación</th>
                            <th align="center">Promedio</th>
                        </tr>

                     </thead>
                     <tbody class="report_card_body">

                     </tbody>

                  </table>
                  <div class="clear"></div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                     <div class="form-group btncontrol">
                        <a href="javascript:void(0)" class="btn btn-5 btn-5a icon-cancel cancel"><span>Retornar</span></a>
                        <button type="button" class="btn btn-5 btn-5a icon-save save" id="save" disabled="disabled"><span>Guardar</span></button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- FINAL TABLA FINAL -->
    </div>
  </div>
@stop

@section('custom_js')
   <script src="{{ URL::asset('assets/js/app.js') }}"></script>
   <script src="{{ URL::asset('assets/js/app-report-card-academic.js') }}"></script>
   <script>
      $(function(){

         wsSelectGroupAll('/api/groups/', '#group', '-- Seleccione el grupo asignado --');

         $("#group").change(function(){
            listReportCard($(this).val());
         });

         $("#save").click(function(){

            event.preventDefault();

            $.ajax({
               url:'/api/califications/implementation/store',
               type:'post',
               datatype: 'json',
               data:$( "#store_report_card" ).serialize(),
               beforeSend: function(){
                   $(".save").attr("disabled", "disabled");
               },
               success:function(response)
               {
                  console.log(response);
                   $(".save").removeAttr("disabled");
               },
               complete: function(){
                   listReportCard($("#group").val());
               }
            });

         });

      });
   </script>
@stop