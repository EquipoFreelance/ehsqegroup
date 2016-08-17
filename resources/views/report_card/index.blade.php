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
      <h1>Nota de Cursos</h1>
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
                           <label for="profesor_codigo_ca">Nombre de la Especialización</label>
                           <select class="select2 form-control" id="modulo_especializacion" name="modulo_especializacion" data-placeholder="Seleccione la Especialización" onpaste="return false;">
                              <option></option>
                              <option value="DEGCIA">DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE CALIDAD E INOCUIDAD ALIMENTARIA</option>
                              <option value="DEGCP">DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE CALIDAD Y PROCESOS</option>
                              <option value="DESSMA">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD, SALUD OCUPACIONAL Y MEDIO AMBIENTE</option>
                              <option value="DESISO">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD INDUSTRIAL Y SALUD OCUPACIONAL</option>
                              <option value="DEGDCMSS" selected="selected">DIPLOMA DE ESPECIALIZACIÓN EN GESTIÓN DE LA CALIDAD, MEDIO AMBIENTE, SEGURIDAD Y SALUD OCUPACIONAL</option>
                              <option value="DESST">DIPLOMA DE ESPECIALIZACIÓN EN SEGURIDAD Y SALUD EN EL TRABAJO</option>
                              <option value="DPRLPSC">DIPLOMA DE PREVENCIÓN DE RIESGOS LABORALES PARA EL SECTOR CONSTRUCCIÓN</option>
                              <option value="DEIPRLSC">DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN PREVENCION DE RIESGOS LABORALES EN EL SECTOR DE CONSTRUCCIÓN</option>
                              <option value="DEISSTM">DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN SEGURIDAD Y SALUD EN EL TRABAJO EN MINERA</option>
                              <option value="DEISIG">DIPLOMA DE ESPECIALIZACIÓN INTERNACIONAL EN SISTEMAS INTEGRADOS DE GESTIÓN</option>
                           </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="profesor_codigo_ca">Nombre del Curso</label>
                           <select class="select2 form-control" id="nombre_modulo" name="nombre_modulo" data-placeholder="Seleccione el Módulo" onpaste="return false;">
                              <option></option>
                              <option value="CGRS">CURSO DE GESTION DE RESIDUOS SOLIDOS</option>
                              <option value="CILNO">CURSO DE INTERPRETACIÓN DE LA NORMA OHSAS 18001:2007</option>
                              <option value="CIDLNI">CURSO DE INTERPRETACIÓN DE LA NORMA ISO 9001.2015</option>
                              <option value="CIDUSIG">CURSO DE INTEGRACION DE UN SISTEMA INTEGRADO DE GESTION</option>
                              <option value="CIDLNII">CURSO DE INTERPRETACIÓN DE LA  NORMA  ISO/ IEC  17025</option>
                              <option value="CSGAINI">CURSO DE SISTEMA DE GESTIÓN AMBIENTAL, INTERPRETACIÓN</option>
                              <option value="CHDM">CURSO DE HERRAMIENTAS DE MEJORA</option>
                              <option value="CGDLSO">CURSO DE GESTION DE LA SALUD OCUPACIONAL</option>
                              <option value="CPRAE" selected="selected">CURSO DE PLAN DE RESPUESTAS A EMERGENCIAS</option>
                              <option value="CFAI">CURSO DE FORMACION DE AUDITORES INTERNOS</option>
                              <option value="CAO">CURSO DE AGENTES OCUPACIONALES</option>
                              <option value="CCROSGSS">CURSO DE CONTROL DE RIESGOS OPERCIONALES DE UN SISTEMA DE GESTION SSOMA</option>
                              <option value="CGBEC">CURSO DE GESTION BASADA EN EL COMPARTIMIENTO</option>
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
                           <th style="text-align: center;">Proyecto</th>
                           <th style="text-align: center;">Sustentación</th>
                           <th style="text-align: center;">Promedio Módulo</th>
                           <th style="text-align: center;">Promedio Final</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>José Benjamín García Erazo</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Cristian Martin Aleman Molina</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Carmen Rosa Chancayauri Vaca</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Jennyfer Ruiz Melgarejo</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Susan Raquel Godofredo Panduro</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Willian Renzo Benavides Carhuapoma</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Ivan Jose Yupanqui Cochachi</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Gerardo Erick Enriquez Narvaez</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Denisse Lourdes Chana Chana</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Cristian Alan Luquillas Reyes</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
                        </tr>
                        <tr>
                           <td>Amaly Ayala Acosta</td>
                           <td align="center"><input type="text" name="nota_taller1" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller2" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_taller3" class="form-control" value="0" disabled="disabled" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_proyecto" class="form-control" value="15" style="width: 50px; text-align: center;"></td>
                           <td align="center"><input type="text" name="nota_sustentacion" class="form-control" value="20" style="width: 50px; text-align: center;"></td>
                           <td align="center">0</td>
                           <td align="center">0</td>
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

@stop
