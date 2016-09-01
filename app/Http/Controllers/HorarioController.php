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
use App\Http\Requests\StoreHoraryRequest;
use Carbon\Carbon;


class HorarioController extends Controller
{

   /**
   * Listado de Horario con su respectivo grupo
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
     return view('horario.index');
   }

   /**
    * Mostrar el formulario con su respectivo grupo
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
     $list_semana = $this->dias_semana();
     $data = compact('list_semana');
     return view('horario.create', $data);
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHoraryRequest $request){

        // Add New Horario
        $horario = new Horario;
        $horario->cod_grupo   = $request->get("cod_grupo");
        $horario->cod_mod     = $request->get("cod_mod");
        $horario->cod_docente = $request->get("cod_docente");
        $horario->fec_inicio  = $request->get("fec_inicio");
        $horario->h_inicio    = $request->get("h_inicio");
        $horario->fec_fin     = $request->get("fec_fin");
        $horario->h_fin       = $request->get("h_fin");
        $horario->num_horas   = $request->get("num_horas");
        $horario->cod_sede    = $request->get("cod_sede");
        $horario->activo      = $request->get("activo");

        $week_days   = $request->get("cod_dia");

        if($horario->save()){

            // Add Auxiliar
            $auxiliar_id = $request->get("cod_auxiliar");
            Auxiliar::find($auxiliar_id)->addHorarios()->save($horario);

            // Add Grupo
            //$grupo_id = $request->get("cod_grupo");
            //Grupo::find($grupo_id)->addHorarios()->save($horario);

            // Add Días
            $horario_dias = $this->HorarioIntervaloDias($request->get("fec_inicio"), $request->get("fec_fin"), $week_days, $horario->id, $request->get("activo"));
            $horario->horariodias()->saveMany($horario_dias);

            // Enviando mensaje
            return redirect()->route('dashboard.academic_schedule.index')
                ->with('message', 'Los datos se registraron satisfactoriamente');

        }


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

      // Get Auxiliar
      $cod_auxiliar = '';
      foreach ($horario->auxiliares as $auxiliar) {
        $cod_auxiliar = $auxiliar->pivot->cod_auxiliar;
        break;
      }

      // Get Días de la semana
      // Obteniendo el id del día para ser buscado en la lista de días de la semana
      /*$get_semana   = array();
      $horario_dias = $horario->horariodias()->get();
      foreach ($horario_dias as $dia) {
        $get_semana[] = $dia->cod_dia;
      }*/

        $weekend_horary = [];
        ($horario->monday == 1)?    $weekend_horary[] = 1: '';
        ($horario->sunday == 1)?    $weekend_horary[] = 2: '';
        ($horario->tuesday == 1)?   $weekend_horary[] = 3: '';
        ($horario->wednesday == 1)? $weekend_horary[] = 4: '';
        ($horario->thursday == 1)?  $weekend_horary[] = 5: '';
        ($horario->friday == 1)?    $weekend_horary[] = 6: '';
        ($horario->saturday == 1)?  $weekend_horary[] = 7: '';

        // Get Grupo
        $grupo = Grupo::find($id);
        $cod_sede     = $grupo->cod_sede;      // Sede
        $cod_mod      = $grupo->cod_mod;       // Modalidad
        $cod_esp_tipo = $grupo->cod_esp_tipo;  // Tipo de especialización
        $cod_esp      = $grupo->cod_esp;       // Especialización

        // Lists Módulos
        $list_modulos = Modulo::where('cod_esp', $cod_esp)->where("deleted", '=', 0)->get()->lists('nombre', 'id');
        $list_modulos->prepend('-- Seleccione el Módulo --', 0);

        // Lists locales
        $list_locales = SedeLocal::where("deleted", '=', 0)->get()->lists('nom_local', 'id');
        $list_locales->prepend('-- Seleccione El Local --', 0);

        // Lists auxiliares
        $list_auxiliar = Auxiliar::where("deleted", '=', 0)->get()->lists('persona.nombre', 'id');
        $list_auxiliar->prepend('-- Seleccione Personal de Apoyo --', 0);

        // Lists Docentes
        $list_docentes = Docente::where("deleted", '=', 0)->get()->lists('persona.nombre', 'id');
        $list_docentes->prepend('-- Seleccione Docente --', 0);

        // Lists Días de la semana
        $list_semana = $this->dias_semana();

        $data = compact('id', 'cod_mod', 'cod_auxiliar', 'list_modulos', 'list_locales', 'list_auxiliar', 'list_docentes', 'list_semana', 'horario','weekend_horary');

        return view('horario.edit', $data );

   }



   public function update(Request $request, $id)
   {

     // Update Horario
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

     if($horario->save()){

       // Update auxiliares
       $horario->auxiliares()->detach();

       // Add Auxiliar
       $auxiliar_id = $request->get("cod_auxiliar");
       Auxiliar::find($auxiliar_id)->addHorarios()->save($horario);

       // Update Días
       $horario->horariodias()->delete();

       // Add Dias
       $week_days   = $request->get("cod_dia");
       $horario_dias = $this->HorarioIntervaloDias($request->get("fec_inicio"), $request->get("fec_fin"), $week_days, $horario->id, $request->get("activo"));
       $horario->horariodias()->saveMany($horario_dias);

       //Enviando mensaje
       return redirect()->route('dashboard.grupo.horario.list', $request->get("cod_grupo"))
       ->with('message', 'Los datos se actualizaron satisfactoriamente');

     }


   }



   /**
    * Intervalo de días
    * -----------------
    * Seleccionando los días de la semana dentro de un rango de fechas(Inicio y fin)
    * se registra los días de la semana que se va a dictar las clases
    **/
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
