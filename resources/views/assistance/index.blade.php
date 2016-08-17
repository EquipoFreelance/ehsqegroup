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

           <div class="x_content">

                 <form id="asistenciaAlumnos" class="form-horizontal form-label-left" method="POST" action="">
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
                          <th>Asistencia</th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Correo</th>
                       </tr>
                    </thead>
                    <tbody>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="1" value="1"></div></td>
                          <td>José Benjamín</td>
                          <td>García Erazo</td>
                          <td>benja722@gmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="2" value="2"></div></td>
                          <td>Carmen Rosa</td>
                          <td>Chancayauri Vaca</td>
                          <td>camros081@gmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="3" value="3"></div></td>
                          <td>Jennyfer</td>
                          <td>Ruiz Melgarejo</td>
                          <td>jennyferruiz@hotmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="4" value="4"></div></td>
                          <td>Susan Raquel</td>
                          <td>Godofredo Panduro</td>
                          <td>susana.107.sg@gmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="5" value="5"></div></td>
                          <td>Luz Rosmeri</td>
                          <td>Bendezu Valenzuela</td>
                          <td>rosmeri_07_95@hotmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="6" value="6"></div></td>
                          <td>Juan Carlos</td>
                          <td>Tito Neyra</td>
                          <td>juantitoneyra@hotmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="7" value="7"></div></td>
                          <td>Dora Silvia</td>
                          <td>Felix Avellaneda</td>
                          <td>silviafelixa@yahoo.es</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="8" value="8"></div></td>
                          <td>Diana Elena</td>
                          <td>Tejada Arenas</td>
                          <td>juan_6707@hotmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="9" value="9"></div></td>
                          <td>Edith Felicitas</td>
                          <td>Herrera Huayhua</td>
                          <td></td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="10" value="10"></div></td>
                          <td>Willian Renzo</td>
                          <td>Benavides Carhuapoma</td>
                          <td>renzofc@live.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="11" value="11"></div></td>
                          <td>Ivan Jose</td>
                          <td>Yupanqui Cochachi</td>
                          <td>ivanyupanqui256@gmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="12" value="12"></div></td>
                          <td>Gerardo Erick</td>
                          <td>Enriquez Narvaez</td>
                          <td>erick_gerar@hotmail.com</td>
                       </tr>
                       <tr>
                          <td><div class="checkbox"><input type="checkbox" class="flat" name="chk" id="13" value="13"></div></td>
                          <td>Robinson</td>
                          <td>Diaz Pinedo</td>
                          <td>modjo16@hotmail.com</td>
                       </tr>
                    </tbody>
                 </table>

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
