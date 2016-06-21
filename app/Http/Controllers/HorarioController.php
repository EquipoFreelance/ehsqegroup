<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Horario;
use App\Models\HorarioDia;
use App\Models\Sede;
use App\Models\SedeLocal;
use App\Models\Grupo;
use App\Models\Auxiliar;
use App\Models\Docente;
use App\Models\Modulo;
use AppHelper;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;


class HorarioController extends Controller
{

   /**
   * Listado de Horario con su respectivo grupo
   * @param  $id -> ID del Grupo
   * @return \Illuminate\Http\Response
   */
   public function index($id)
   {

     $grupo = Grupo::find($id);
     $data = ['horarios' => $grupo->addHorarios, "id" => $id];
     return view('horario.index', $data);

   }

   /**
    * Mostrar el formulario con su respectivo grupo
    * @param  $id -> ID del Grupo
    * @return \Illuminate\Http\Response
    */
   public function create($id)
   {

     // Información del Grupo
     $grupo = Grupo::find($id);
     $cod_sede     = $grupo->cod_sede;      // Sede
     $cod_mod      = $grupo->cod_mod;       // Modalidad
     $cod_esp_tipo = $grupo->cod_esp_tipo;  // Tipo de especialización
     $cod_esp      = $grupo->cod_esp;       // Tipo de especialización
     $docentes     = array();

     // Lists módulos
     $modulos = Modulo::where('cod_esp', $cod_esp)->get()->lists('nombre', 'id');
     $modulos->prepend('-- Seleccione el Módulo --', 0);

     // Lists locales
     $locales = SedeLocal::where('cod_sede', $cod_sede)->get()->lists('nom_local', 'id');
     $locales->prepend('-- Seleccione El Local --', 0);

     // Lists auxiliares
     $auxiliar = Auxiliar::where("deleted", '=', 0)->get()->lists('persona.nombre', 'id');
     $auxiliar->prepend('-- Seleccione Personal de Apoyo --', 0);

     // Lists Docentes
     $docentes = Docente::where("deleted", '=', 0)->get()->lists('persona.nombre', 'id');
     $docentes->prepend('-- Seleccione Docente --', 0);

     // Lists Días de la semana
     $semana = $this->dias_semana();

     $data = compact('id','cod_sede','cod_mod','cod_esp_tipo','cod_esp','modulos','locales','auxiliar','docentes', 'semana');
     return view('horario.create', $data);

   }

   /**
    * Mostrar el formulario para editar con su respectivo grupo
    * @param  $id -> ID del Grupo
    * @return \Illuminate\Http\Response
    */
   public function edit($id, $cod_horario)
   {

      // Get Horario
      $horario = Horario::find($cod_horario);

      // Get Grupo
      $grupo = Grupo::find($id);
      $cod_sede     = $grupo->cod_sede;      // Sede
      $cod_mod      = $grupo->cod_mod;       // Modalidad
      $cod_esp_tipo = $grupo->cod_esp_tipo;  // Tipo de especialización
      $cod_esp      = $grupo->cod_esp;       // Tipo de especialización

      // Lists módulos
      $modulos = Modulo::where("deleted", '=', 0)->get()->lists('nombre', 'id');
      $modulos->prepend('-- Seleccione el Módulo --', 0);

      // Lists locales
      $locales = SedeLocal::where("deleted", '=', 0)->get()->lists('nom_local', 'id');
      $locales->prepend('-- Seleccione El Local --', 0);

      // Lists auxiliares
      $cod_auxiliar = '';

      foreach ($horario->auxiliares as $auxiliar) {
        $cod_auxiliar = $auxiliar->pivot->cod_auxiliar;
        break;
      }

      $auxiliar = Auxiliar::where("deleted", '=', 0)->get()->lists('persona.nombre', 'id');
      $auxiliar->prepend('-- Seleccione Personal de Apoyo --', 0);

      // Lists Docentes
      $docentes = Docente::where("deleted", '=', 0)->get()->lists('persona.nombre', 'id');
      $docentes->prepend('-- Seleccione Docente --', 0);

      // Lists Días de la semana
      $list_semana = $this->dias_semana();

      $horario_dias = $horario->horariodias()->get();

      foreach ($horario_dias as $dia) {
        $get_semana[] = $dia->cod_dia;
      }

      $data = compact('id', 'cod_sede', 'cod_mod', 'cod_esp_tipo', 'cod_esp', 'cod_auxiliar', 'modulos', 'locales', 'auxiliar', 'docentes', 'list_semana', 'horario','get_semana');

      return view('horario.edit', $data );

   }


   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request){

     // Enviando los parametros necesarios para la validación
     $validator = Validator::make( $request->all(), $this->validateRules(), $this->validateMessages() );

     // Si existen errores el Sistema muestra un mensaje
     if ($validator->fails()){

       // Enviando Mensaje
       return redirect()->route('dashboard.grupo.create')->withErrors($validator)
       ->withInput();

     } else {

       // Add New Horario
       $horario = new Horario;
       $horario->fec_inicio  = $request->get("fec_inicio");
       $horario->fec_fin     = $request->get("fec_fin");
       $horario->h_inicio    = $request->get("h_inicio");
       $horario->h_fin       = $request->get("h_fin");
       $horario->num_horas   = $request->get("num_horas");
       $horario->cod_local   = $request->get("cod_local");
       $horario->cod_mod     = $request->get("cod_mod");
       $horario->cod_docente = $request->get("cod_docente");
       $horario->activo      = $request->get("activo");

       $week_days   = $request->get("cod_dia");

       if($horario->save()){

         // Add Auxiliar
         $auxiliar_id = $request->get("cod_auxiliar");
         Auxiliar::find($auxiliar_id)->addHorarios()->save($horario);

         // Add Grupo
         $grupo_id = $request->get("cod_grupo");
         Grupo::find($grupo_id)->addHorarios()->save($horario);

         // Add Días
         $horario_dias = $this->HorarioIntervaloDias($request->get("fec_inicio"), $request->get("fec_fin"), $week_days, $horario->id, $request->get("activo"));
         $horario->horariodias()->saveMany($horario_dias);

         //Enviando mensaje
         return redirect()->route('dashboard.grupo.horario.list', $request->get("cod_grupo"))
         ->with('message', 'Los datos se registraron satisfactoriamente');

       }

     }

   }

   public function update(Request $request, $id)
   {


     // Get Horario
     $horario = Horario::find($id);
     $horario->fec_inicio  = $request->get("fec_inicio");
     $horario->fec_fin     = $request->get("fec_fin");
     $horario->h_inicio    = $request->get("h_inicio");
     $horario->h_fin       = $request->get("h_fin");
     $horario->num_horas   = $request->get("num_horas");
     $horario->cod_local   = $request->get("cod_local");
     $horario->cod_mod     = $request->get("cod_mod");
     $horario->cod_docente = $request->get("cod_docente");
     $horario->updated_at  = Carbon::now();
     $horario->activo      = $request->get("activo");

     $week_days   = $request->get("cod_dia");

     $horario_dias = $this->HorarioIntervaloDias($request->get("fec_inicio"), $request->get("fec_fin"), $week_days, $horario->id, $request->get("activo"));
     
     if($horario->save()){

       // Add Auxiliar
       $auxiliar_id = $request->get("cod_auxiliar");

       //Auxiliar::find($auxiliar_id)->addHorarios()->save($horario);

       // Add Días
       $horario->horariodias()->delete();
       $horario_dias = $this->HorarioIntervaloDias($request->get("fec_inicio"), $request->get("fec_fin"), $week_days, $horario->id, $request->get("activo"));
       $horario->horariodias()->saveMany($horario_dias);

       //Enviando mensaje
       return redirect()->route('dashboard.grupo.horario.list', $request->get("cod_grupo"))
       ->with('message', 'Los datos se actualizaron satisfactoriamente');

     }


   }

   /* Reglas de validaciones */
   public function validateRules()
   {

     /* Aplicando validación al Request */

     // Reglas de validación
     $rules = [
       'cod_mod'     => 'required',
       'cod_docente' => 'required',
       'fec_inicio'  => 'required',
       'fec_fin'     => 'required',
       'num_horas'   => 'required',
       'cod_local'   => 'required',
       'activo'      => 'required'
     ];

     return $rules;

   }

   /* Mensaje personalizado */
   public function validateMessages()
   {

     // Mensaje de validación Personalizado
     $messages = [
       'cod_mod.required'     => 'Es necesario seleccionar el módulo',
       'cod_docente.required' => 'Es necesario seleccionar el docente',
       'fec_inicio.required'  => 'Es necesario ingresar la fecha de inicio',
       'fec_fin.required'     => 'Es necesario ingresar la fecha de finalización',
       'num_horas.required'   => 'Es necesario indicar el número de horas',
       'cod_local.required'   => 'Es necesario seleccionar el local',
       'activo.integer'       => 'Solo esta permitido que sea números enteros'
     ];

     return $messages;
   }


   // Obteniendo los días de un intervarlo de fechas
   public function HorarioIntervaloDias($fec_inicio, $fec_fin, $week_days, $horario_id, $activo)
   {
     $horario_dias = array();

     // Formato necesario para obtener el rango de fechas
     $fec_inicio      = AppHelper::replaceFormat("/", $fec_inicio);
     $fec_fin         = AppHelper::replaceFormat("/", $fec_fin);

     // Retornar un JSOn con los días obtenidos
     $intervalos_dias = json_decode(AppHelper::rangeInterval($fec_inicio, $fec_fin, $week_days), true);

     // Asignado los objectos para ser registrados
     $horario_dias    = array();

     foreach ($intervalos_dias as $key => $value) {
        $horario_dia =  new HorarioDia([
          'cod_horario' => $horario_id,
          'cod_dia'     => $value['cod_dia'],
          'fecha'       => $value['fecha'],
          'activo'      => $activo
        ]);
        $horario_dias[] = $horario_dia;
     }

     return $horario_dias;

   }

   // Array Días de la semana
   public function dias_semana(){

     // Días de la semana
     $semana[] = array("cod_dia" => 1, "dia" => "Lunes");
     $semana[] = array("cod_dia" => 2, "dia" => "Martes");
     $semana[] = array("cod_dia" => 3, "dia" => "Miércoles");
     $semana[] = array("cod_dia" => 4, "dia" => "Jueves");
     $semana[] = array("cod_dia" => 5, "dia" => "Viernes");
     $semana[] = array("cod_dia" => 6, "dia" => "Sábado");
     $semana[] = array("cod_dia" => 7, "dia" => "Domingo");

     return $semana;
   }

}
