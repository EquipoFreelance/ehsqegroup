<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Horario;
use App\Models\HorarioDia;
use App\Models\Grupo;
use App\Models\Auxiliar;
use App\Models\Taller;
use AppHelper;
use Validator;
use Auth;
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

   public function getIndexHorarios($cod_group){
        return view('horario.horary-group', compact('cod_group'));
   }

   /**
    * Mostrar el formulario con su respectivo grupo
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
     $list_semana = $this->dias_semana();
     $talleres    = Taller::lists('nom_taller','id');
     $data = compact('list_semana', 'talleres');
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
        $horario->fec_fin     = $request->get("fec_fin");
        $horario->h_inicio    = $request->get("h_inicio");
        $horario->h_fin       = $request->get("h_fin");
        $horario->num_horas   = $request->get("num_horas");
        $horario->num_taller  = $request->get("num_taller");

        $group = Grupo::find($request->get("cod_grupo"));
        $horario->cod_sede    = $group->cod_sede;

        $horario->activo      = $request->get("activo");
        $horario->created_by  =  Auth::user()->id;
        $week_days            = $request->get("cod_dia");

        // Días seleccionados en la tabla
        foreach ($week_days as $week_day) {

            switch ($week_day) {
                case 1:
                    $horario->monday = 1;
                    break;
                case 2:
                    $horario->sunday = 1;
                    break;
                case 3:
                    $horario->tuesday = 1;
                    break;
                case 4:
                    $horario->wednesday = 1;
                    break;
                case 5:
                    $horario->thursday = 1;
                    break;
                case 6:
                    $horario->friday = 1;
                    break;
                case 7:
                    $horario->saturday = 1;
                    break;
            }

        }

        if($horario->save()){

            // Add Auxiliar
            $auxiliar_id = $request->get("cod_auxiliar");
            Auxiliar::find($auxiliar_id)->addHorarios()->save($horario);

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
   public function edit($id)
   {

        // Get Horario
        $horario = Horario::find($id);

        // Get Auxiliar
        $cod_auxiliar = '';
        foreach ($horario->auxiliares as $auxiliar) {
            $cod_auxiliar = $auxiliar->pivot->cod_auxiliar;
            break;
        }

        $weekend_horary = [];
        ($horario->monday == 1)?    $weekend_horary[] = 1: '';
        ($horario->sunday == 1)?    $weekend_horary[] = 2: '';
        ($horario->tuesday == 1)?   $weekend_horary[] = 3: '';
        ($horario->wednesday == 1)? $weekend_horary[] = 4: '';
        ($horario->thursday == 1)?  $weekend_horary[] = 5: '';
        ($horario->friday == 1)?    $weekend_horary[] = 6: '';
        ($horario->saturday == 1)?  $weekend_horary[] = 7: '';


        // Lists Días de la semana
        $list_semana = $this->dias_semana();

        $talleres    = Taller::lists('nom_taller','id');

        $data = compact('horario', 'list_semana', 'cod_auxiliar', 'weekend_horary', 'talleres');

        return view('horario.edit', $data );

   }



   public function update(StoreHoraryRequest $request, $id)
   {

        // Update Horario
        $horario = Horario::find($id);
        $horario->cod_grupo   = $request->get("cod_grupo");
        $horario->cod_mod     = $request->get("cod_mod");
        $horario->cod_docente = $request->get("cod_docente");
        $horario->fec_inicio  = $request->get("fec_inicio");
        $horario->fec_fin     = $request->get("fec_fin");
        $horario->h_inicio    = $request->get("h_inicio");
        $horario->h_fin       = $request->get("h_fin");
        $horario->num_horas   = $request->get("num_horas");
        $horario->num_taller  = $request->get("num_taller");


        $group = Grupo::find($request->get("cod_grupo"));
        $horario->cod_sede    = $group->cod_sede;

        $horario->updated_at  = Carbon::now();
        $horario->activo      = $request->get("activo");
        $horario->updated_by  =  Auth::user()->id;
        $week_days            = $request->get("cod_dia");



        $horario->monday = 0;
        $horario->sunday = 0;
        $horario->tuesday = 0;
        $horario->wednesday = 0;
        $horario->thursday = 0;
        $horario->friday = 0;
        $horario->saturday = 0;

        // Días seleccionados en la tabla
        foreach ($week_days as $week_day) {

           switch ($week_day) {
               case 1:
                   $horario->monday = 1;
                   break;
               case 2:
                   $horario->sunday = 1;
                   break;
               case 3:
                   $horario->tuesday = 1;
                   break;
               case 4:
                   $horario->wednesday = 1;
                   break;
               case 5:
                   $horario->thursday = 1;
                   break;
               case 6:
                   $horario->friday = 1;
                   break;
               case 7:
                   $horario->saturday = 1;
                   break;
           }

        }

        if($horario->save()){

            // Update auxiliares
            $horario->auxiliares()->detach();

            // Add Auxiliar
            $auxiliar_id = $request->get("cod_auxiliar");
            Auxiliar::find($auxiliar_id)->addHorarios()->save($horario);

            //Enviando mensaje
            return redirect()->route('dashboard.academic_schedule.index')
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
