@extends('dashboard.layouts.master')
@section('content')
  <div class="">

    <div class="page-title">
      @if(Session::has('message'))
          <div class="alert alert-info">
              {{ Session::get('message') }}
          </div>
      @endif
      <h1>Reporte de Notas por especialización</h1>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- INICIO TABLA FINAL -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="y_title">
            <h2><i class="fa fa-edit"></i> Notas</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="headprint">
              <div class="form-group">
                <label for="especializacion_ca">Especialización</label>
                <select class="select2 form-control" id="especializacion_ca" name="especializacion_ca" data-placeholder="Seleccione la Especialización">
                  <option></option>
                </select>
              </div>
            </div>
            <br>
            <table class="tablex table-bordered" cellspacing="0" width="100%">
              <tr>
                <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">N°</td>
                <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">MODULOS</td>
                <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">EXAMEN</td>
                <td colspan="5" align="center" valign="middle" bgcolor="#f4f4f4">TALLERES</td>
                <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">PROM<br>
                  TALLER
                </td>
                <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">PROM<br>
                  MODULO
                </td>
              </tr>
              <tr>
                <td align="center" valign="middle" bgcolor="#f4f4f4">1</td>
                <td align="center" valign="middle" bgcolor="#f4f4f4">2</td>
                <td align="center" valign="middle" bgcolor="#f4f4f4">3</td>
                <td align="center" valign="middle" bgcolor="#f4f4f4">4</td>
                <td align="center" valign="middle" bgcolor="#f4f4f4">5</td>
              </tr>
              <tr>
                <td align="center">1</td>
                <td align="left">INTERPRETACIÓN DE LA NORMA ISO 9001.2008</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle"><strong>20</strong></td>
                <td align="center" valign="middle"><strong>19</strong></td>
              </tr>
              <tr>
                <td align="center">2</td>
                <td align="left">INTERPRETACIÓN DE LA NORMA ISO 14001:2004</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">15</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle"><strong>17</strong></td>
                <td align="center" valign="middle"><strong>18</strong></td>
              </tr>
              <tr>
                <td align="center">3</td>
                <td align="left">INTERPRETACION DE LA NORMA OHSAS 18001</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle"><strong>20</strong></td>
                <td align="center" valign="middle"><strong>19</strong></td>
              </tr>
              <tr>
                <td align="center">4</td>
                <td align="left">DOCUMENTACION DE UN SISTEMA INTEGRADO DE GESTION </td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">15</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle"><strong>17</strong></td>
                <td align="center" valign="middle"><strong>18</strong></td>
              </tr>
              <tr>
                <td align="center">5</td>
                <td align="left">INTEGRACION DE UN SISTEMA INTEGRADO DE GESTION </td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">20</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle"><strong>20</strong></td>
                <td align="center" valign="middle"><strong>19</strong></td>
              </tr>
              <tr>
                <td align="center">6</td>
                <td align="left">AUDITORES DE SISTEMAS INTEGRADOS DE GESTION</td>
                <td align="center" valign="middle">17</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">15</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle"><strong>17</strong></td>
                <td align="center" valign="middle"><strong>18</strong></td>
              </tr>
              <tr>
                <td align="center">7</td>
                <td align="left">HERRAMIENTAS DE MEJORA DE UN SISTEMA DE GESTION </td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">15</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle">18</td>
                <td align="center" valign="middle"><strong>17</strong></td>
                <td align="center" valign="middle"><strong>18</strong></td>
              </tr>
            </table>
            <br>
            <table class="tablex table-bordered" cellspacing="0" width="100%">
              <tr>
                <td align="left" valign="middle"  bgcolor="#f4f4f4">PROMEDIO TOTAL</td>
                <td align="center"><strong>17</strong></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#f4f4f4">PROMEDIO PROYECTO</td>
                <td align="center"><strong>17</strong></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#f4f4f4">PROMEDIO FINAL</td>
                <td align="center"><strong>9</strong></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- FINAL TABLA FINAL -->
    </div>
  </div>
@stop

@section('custom_js')
  <script src="{{ URL::asset('assets/js/app-report-card-students.js') }}"></script>
@stop
