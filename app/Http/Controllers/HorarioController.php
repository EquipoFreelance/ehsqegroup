<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Horario;
use App\Models\Sede;
use App\Models\SedeLocal;
use App\Models\Grupo;
use App\Models\Auxiliar;
use App\Modulo;

use Validator;

use App\Http\Requests;
use Carbon\Carbon;

class HorarioController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
     //$horarios = Horario::where("deleted", '=', 0)->get();
     //return view('horario.index', array('horarios' => $horarios));
     return "Listado de horarios";
   }

   public function getHorarioList($id)
   {
     $data = compact('id'); // Id del grupo
     return view('horario.index', $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
     $data = [
           'sedes' => Sede::lists('nom_sede', 'id'),                     // Listado de Sedes
         ];
        return view('horario.create', $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function getCreateHorario($id)
   {

     // Información del Grupo
     $grupo = Grupo::find($id);
     $cod_sede     = $grupo->cod_sede;      // Sede
     $cod_mod      = $grupo->cod_mod;       // Modalidad
     $cod_esp_tipo = $grupo->cod_esp_tipo;  // Tipo de especialización
     $cod_esp      = $grupo->cod_esp;       // Tipo de especialización
     $docentes     = array();

     // Información de los módulos
     $modulos = Modulo::where('cod_esp', $cod_esp)->get()->lists('nombre', 'id');
     $modulos->prepend('-- Seleccione el Módulo --');

     // Información de los locales
     $locales = SedeLocal::where('cod_sede', $cod_sede)->get()->lists('nom_local', 'id');
     $locales->prepend('-- Seleccione El Local --');

     // Información de los auxiliares
     $auxiliar = Auxiliar::where("deleted", '=', 0)->get()->lists('persona.nombre', 'id');
     $auxiliar->prepend('-- Seleccione Personal de Apoyo --');

     $data = compact('id','cod_sede','cod_mod','cod_esp_tipo','cod_esp','modulos','locales','auxiliar');
     return view('horario.create', $data);
   }


}
