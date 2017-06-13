<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        body {
           font-family: Arial;
        }

        div.vertical
        {
            margin-left: 0px;
            position: absolute;
            width: 15px;
            height: 45px;
            padding-left: 15px;
            padding-right: 15px;
            transform: rotate(-90deg);
            -webkit-transform: rotate(-90deg); /* Safari/Chrome */
            -moz-transform: rotate(-90deg); /* Firefox */
            -o-transform: rotate(-90deg); /* Opera */
            -ms-transform: rotate(-90deg); /* IE 9 */
            text-align: center;
            margin-top: 14px;
        }

        td.vertical
        {
            height: 100px;
            line-height: 14px;
            /*padding-bottom: 20px;*/
            /*text-align: center;*/
        }

    </style>


</head>
<body>

<script id="response-template" type="text/x-handlebars-template">
    @{{#each data}}
    <tr>
        <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-left: 2px solid #000000;" height="20">@{{ order }}</td>
        <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">@{{ code }}</td>
        <td colspan="9" align="left" style="border:1px solid #000000; font-weight: bold; font-size: 9px; padding-left: 5px;" height="20">@{{ firstname }}</td>
        <td colspan="9" align="left" style="border:1px solid #000000; font-weight: bold; font-size: 9px; padding-left: 5px;" height="20">@{{ lastname }}</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">16.00</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-right: 2px solid #000000;" height="20">16.00</td>
    </tr>
    @{{/each}}
</script>

<table border="0" cellpadding="0" cellspacing="0" style="font-size:9px" width="100%">
    <tr>
        <td height="20" colspan="30"><img src="{{ URL::asset('assets/images/logo.png')}}" alt="" width="120" height="41"></td>
    </tr>

    <tr>
        <td height="20" colspan="33" style="font-weight: bold" align="center">ACTAS DE NOTAS FINALES</td>
    </tr>
    <tr>
        <td height="20" colspan="30">&nbsp;</td>
    </tr>

    <tr>
        <td height="20" colspan="4" bgcolor="#CCCCCC" style="border:1px solid #000000; font-weight: bold; border-left: 2px solid #000000; border-right: 1px solid #000000; border-top: 2px solid #000000; padding-left: 5px;">DIPLOMA</td>
        <td height="20" colspan="30" align="left" valign="middle" style="border:1px solid #000000; font-weight: bold; border-left: 1px solid #000000; border-right: 2px solid #000000; border-top: 2px solid #000000; padding-left: 5px;" class="title_esp"></td>
    </tr>
    <tr>
        <td height="20" colspan="4" bgcolor="#CCCCCC" style="border:1px solid #000000; font-weight: bold; border-left: 2px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; padding-left: 5px;">SEDE</td>
        <td height="20" colspan="30" align="left" valign="middle" style="border:1px solid #000000; font-weight: bold; border-left: 1px solid #000000; border-right: 2px solid #000000; border-top: 1px solid #000000; padding-left: 5px;" class="title_place"></td>
    </tr>
    <tr>
        <td height="20" colspan="4" bgcolor="#CCCCCC" style="border:1px solid #000000; font-weight: bold; border-left: 2px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; padding-left: 5px;">HORARIO</td>
        <td height="20" colspan="30" align="left" valign="middle" style="border:1px solid #000000; font-weight: bold; border-left: 1px solid #000000; border-right: 2px solid #000000; border-top: 1px solid #000000; padding-left: 5px;" class="title_schedule"></td>
    </tr>
    <tr>
        <td height="20" colspan="4" bgcolor="#CCCCCC" style="border:1px solid #000000; font-weight: bold; border-left: 2px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; padding-left: 5px;">DURACIÓN</td>
        <td height="20" colspan="30" align="left" valign="middle" style="border:1px solid #000000; font-weight: bold; border-left: 1px solid #000000; border-right: 2px solid #000000; border-top: 1px solid #000000; padding-left: 5px;" class="title_duration"></td>
    </tr>
    <tr>
        <td height="20" colspan="4" bgcolor="#CCCCCC" style="border:1px solid #000000; font-weight: bold; border-left: 2px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; border-bottom: 2px solid #000000; padding-left: 5px;">OBSERVACIÓN</td>
        <td height="20" colspan="30" align="left" valign="middle" style="border:1px solid #000000; font-weight: bold; border-left: 1px solid #000000; border-right: 2px solid #000000; border-top: 1px solid #000000; border-bottom: 2px solid #000000; padding-left: 5px;" class="title_observation"></td>
    </tr>

    <tr><td height="2" colspan="33">&nbsp;</td></tr>
    <tr>
        <td colspan="2" style="border:1px solid #000000;border-left: 2px solid #000000;border-top: 2px solid #000000;font-weight: bold;font-size: 9px;" bgcolor="#CCCCCC" align="center" rowspan="4" width="30">N°</td>
        <td colspan="2" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" rowspan="4" width="70">CÓDIGO</td>
        <td colspan="18" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" rowspan="4" width="450">APELLIDOS Y NOMBRES</td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_0"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_1"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_2"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_3"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_4"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_5"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_6"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" align="center" width="70" class="gp_7"></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" rowspan="4" class="vertical"  width="70"><div class="vertical">PROMEDIO MÓDULOS</div></td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;" bgcolor="#CCCCCC" rowspan="4" class="vertical" width="70"><div class="vertical" >PROMEDIO PROYECTO IMPLEMENTACIÓN</td>
        <td colspan="1" style="border:1px solid #000000; font-weight: bold; font-size: 9px; border-top: 2px solid #000000;border-right: 2px solid #000000;" bgcolor="#CCCCCC" rowspan="4" class="vertical" width="70"><div class="vertical" >PROMEDIO FINAL</td>
    </tr>
    <tr>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20" class="mod_0"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="15" class="mod_1"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="15" class="mod_2"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="15" class="mod_3"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="15" class="mod_4"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="15" class="mod_5"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="15" class="mod_6"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="15" class="mod_7"></td>
    </tr>
    <tr>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20" class="t_0"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" class="t_1"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" class="t_2"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" class="t_3"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" class="t_4"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" class="t_5"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" class="t_6"></td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" class="t_7"></td>
    </tr>
    <tr class="space">
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;" height="20">&nbsp;</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;">&nbsp;</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;">&nbsp;</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;">&nbsp;</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;">&nbsp;</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;">&nbsp;</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;">&nbsp;</td>
        <td colspan="1" align="center" style="border:1px solid #000000; font-weight: bold; font-size: 9px;">&nbsp;</td>
    </tr>

    <tr>
        <td height="20" colspan="30">&nbsp;</td>
    </tr>
    <tr>
        <td style="font-weight: bold; font-size: 12px;" colspan="33">MUY IMPORTANTE:</td>
    </tr>
    <tr>
        <td colspan="33">La nota minima aprobatoria para la Obtencion del Diploma es el Promedio Final: 13</td>
    </tr>
    <tr>
        <td colspan="33">Los alumnos que no rindieron sus exámenes se les programará otra fecha bajo coordinación con el Área Académica.</td>
    </tr>
    <tr>
        <td colspan="33">Los exámenes reprogramados serán calificados sobre 17</td>
    </tr>
    <tr>
        <td colspan="33">Correo: coordinador.academico@ehsqgroup.com</td>
    </tr>
    <tr>
        <td colspan="22" valign="top">Los Promedios se calculan de la siguiente manera:</td>
        <td colspan="15" align="left">
            <table>
                <tr>
                    <td><img src="{{ URL::asset('assets/images/nota_1.png')}}"></td>
                </tr>
                <tr>
                    <td><img src="{{ URL::asset('assets/images/nota_2.png')}}"></td>
                </tr>
                <tr>
                    <td><img src="{{ URL::asset('assets/images/nota_3.png')}}"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>
<script src="{{ URL::asset('assets/js/app-acta-show.js')}}"></script>
<script>
    showActa(15);
</script>
</body>
</html>
