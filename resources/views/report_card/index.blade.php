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
               <td align="center"><input type="text" name="nota_taller_1" class="form-control" value="@{{ num_nota }}" style="width: 50px; text-align: center;"></td>
            @{{/with}}
         @{{/each}}
      </tr>
      @{{/each}}
   </script>

   <script id="response-template-head" type="text/x-handlebars-template">
      <tr>
         <th>Alumno</th>
         @{{#each header}}
            <th style="text-align: center;">@{{ title  }}</th>
         @{{/each}}
      </tr>
   </script>

  <div class="">
    <div class="page-title">
      @if(Session::has('message'))
          <div class="alert alert-info">
              {{ Session::get('message') }}
          </div>
      @endif
      <h1>Ingreso de Notas</h1>
      <p style="margin-top: 15px">En este interior usted podrá ingresar las Notas de Curso.</p>
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
               <form id="asignarCursosDocenteForm" class="form-horizontal form-label-left" method="POST" action="">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="profesor_codigo_ca">Grupos</label>
                           <select class="select2 form-control" id="group" name="group" data-placeholder="Seleccione la Especialización" onpaste="return false;">
                              <option>-- Seleccione el grupo asignado --</option>
                           </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="profesor_codigo_ca">Módulos Disponibles</label>
                           <select class="select2 form-control" id="cod_mod" name="cod_mod" data-placeholder="Seleccione el Módulo" onpaste="return false;">
                              <option>-- Seleccione el Módulo --</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <br>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                     <thead class="report_card_header">

                     </thead>
                     <tbody class="report_card_body">

                     </tbody>
                  </table>
                  <div class="clear"></div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                     <div class="form-group btncontrol">
                        <a href="javascript:void(0)" class="btn btn-5 btn-5a icon-cancel cancel"><span>Cancelar</span></a>
                        <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
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
   <script src="{{ URL::asset('assets/js/app-report-card.js') }}"></script>
   <script>
      $(function(){

         var teacher_id = {{ Auth::user()->cod_persona  }};

         wsSelectGroupTeacher('/api/report-card/group-teacher/'+ teacher_id, '#group', '-- Seleccione el grupo asignado --');

         // Event Change
         $("#group").change(function(){
            wsSelectGroupModules('/api/report-card/group-horary-modules/' + $(this).val() + '/' + teacher_id, "#cod_mod", " -- Seleccione el Módulo -- ");
         });

         $("#cod_mod").change(function(){
            listReportCard($("#group").val(), $(this).val());
         });


      });
   </script>
@stop