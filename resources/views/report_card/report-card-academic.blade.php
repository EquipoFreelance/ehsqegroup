@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')

   <!-- Custom Templates -->
   <script id="response-template" type="text/x-handlebars-template">
      @{{#each body}}
      <tr>
         <td>@{{ name  }}</td>
         @{{#each report}}
            @{{#with nota}}
               <td align="center">
                  <input type="text" name="num_nota[]" class="form-control" value="@{{#if num_nota}}@{{ num_nota }}@{{ else }}@{{/if}}" style="width: 70px; text-align: center;">
                  <input type="hidden" name="id_num_nota[]" class="form-control" value="@{{ id }}" style="width: 60px; text-align: center;">
                  <input type="hidden" name="id_matricula[]" class="form-control" value="@{{ cod_matricula }}" style="width: 70px; text-align: center;">
                  <input type="hidden" name="id_taller[]" class="form-control" value="@{{ cod_taller }}" style="width: 70px; text-align: center;">
               </td>
            @{{/with}}
         @{{/each}}

         <td style="width: 70px; text-align: center;" class="ïd_enrollment_@{{ enrollment }}"><span>@{{ average }}</span></td>
      </tr>
      @{{/each}}
   </script>

   <script id="response-template-head" type="text/x-handlebars-template">
      <tr>
         <th>Alumno</th>
         @{{#each header}}
            <th style="text-align: center;">@{{ title  }}</th>
         @{{/each}}
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
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="profesor_codigo_ca">Grupos</label>
                           <select data-id-default="{{ old('group') }}" class="select2 form-control" id="group" name="group" data-placeholder="Seleccione la Especialización" onpaste="return false;">
                              <option>-- Seleccione el grupo asignado --</option>
                           </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="profesor_codigo_ca">Módulos / Docentes</label>
                           <select data-id-default="{{ old('cod_mod') }}" class="select2 form-control" id="cod_mod" name="cod_mod" data-placeholder="Seleccione el Módulo" onpaste="return false;">
                              <option>-- Seleccione el Módulo --</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <br>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                     <thead class="report_card_header"></thead>
                     <tbody class="report_card_body"></tbody>
                  </table>
                  <div class="clear"></div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                     <div class="form-group btncontrol">
                        <a href="javascript:void(0)" class="btn btn-5 btn-5a icon-cancel cancel"><span>Cancelar</span></a>
                        <button type="button" class="btn btn-5 btn-5a icon-save save" id="save"><span>Guardar</span></button>
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

         //var teacher_id = '{{ Auth::user()->cod_persona  }}';

         wsSelectGroupAll('/api/groups/', '#group', '-- Seleccione el grupo asignado --');

         // Event Change
         $("#group").change(function(){
            wsSelectGroupTeacherModules('/api/groups/group-teacher/', "#cod_mod", " -- Seleccione el Módulo -- ", $(this).val());
         });

         $("#cod_mod").change(function(){
            //listReportCard($("#group").val(), $(this).val());
         });

         /*$("#save").click(function(){
            event.preventDefault();

            $.ajax({
               url:'/api/teacher/report-card/store',
               type:'post',
               datatype: 'json',
               data:$( "#store_report_card" ).serialize(),
               beforeSend: function(){

               },
               success:function(response)
               {
                  console.log(response);
               },
               complete: function(){
                  $(".alert-info").hide().fadeIn().html("Las notas fueron ingresadas satisfactoriamente");
                  $("#cod_mod").trigger("change");
                  //$( "#store_report_card" ).submit();
               },
               error: function (xhr, ajaxOptions, thrownError) {
                  if(  response.status == 400){

                  }
               }
            });

         });*/

      });
   </script>
@stop