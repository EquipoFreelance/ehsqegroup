@extends('dashboard.layouts.master')

@section('title', Auth::user()->role->nom_role  )

@section('sidebar_menu')
  @include('dashboard.menus.' . Auth::user()->role->menu )
@stop

@section('content')
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
                     <thead>
                        <tr>
                           <th>Alumno</th>
                           <th style="text-align: center;">Taller 1</th>
                           <th style="text-align: center;">Taller 2</th>
                           <th style="text-align: center;">Taller 3</th>
                           <!--<th style="text-align: center;">Proyecto</th>
                           <th style="text-align: center;">Sustentación</th>
                           <th style="text-align: center;">Promedio Módulo</th>
                           <th style="text-align: center;">Promedio Final</th>-->
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>José Benjamín García Erazo</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Cristian Martin Aleman Molina</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Carmen Rosa Chancayauri Vaca</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Jennyfer Ruiz Melgarejo</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Susan Raquel Godofredo Panduro</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Willian Renzo Benavides Carhuapoma</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Ivan Jose Yupanqui Cochachi</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Gerardo Erick Enriquez Narvaez</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Denisse Lourdes Chana Chana</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Cristian Alan Luquillas Reyes</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
                        <tr>
                           <td>Amaly Ayala Acosta</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <!--<td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>-->
                        </tr>
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

      });
   </script>
@stop