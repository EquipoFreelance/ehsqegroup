<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Horario;
use App\Models\Grupo;
use App\Models\Auxiliar;
use App\Models\Taller;
use App\Models\GroupTeacher;

use App\Http\Requests;
use App\Http\Requests\StoreHoraryRequest;
use App\Http\Requests\StoreHoraryProfesorRequest;
use Carbon\Carbon;
use AppHelper;
use Validator;
use Auth;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndexProfesor(){
        return view('horario.index-profesor');
    }

    /**
     * @param $cod_group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
     * @param StoreHoraryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreHoraryRequest $request){

        // Buscando atributos del grupo
        $group = Grupo::find($request->get("cod_grupo"));

        // Add New Horario
        $horario = new Horario;
        $horario->id_academic_period = $request->get("id_academic_period");
        $horario->cod_grupo     = $request->get("cod_grupo");
        $horario->cod_modalidad = $group->cod_modalidad;
        $horario->cod_esp_tipo  = $group->cod_esp_tipo;
        $horario->cod_esp       = $group->cod_esp;
        $horario->cod_mod       = $request->get("cod_mod");
        $horario->cod_docente   = $request->get("cod_docente");
        $horario->fec_inicio    = $request->get("fec_inicio");
        $horario->fec_fin       = $request->get("fec_fin");
        $horario->h_inicio      = $request->get("h_inicio");
        $horario->h_fin         = $request->get("h_fin");
        $horario->num_horas     = $request->get("num_horas");
        $horario->num_taller    = $request->get("num_taller");
        $horario->cod_sede      = $group->cod_sede;
        $horario->activo        = $request->get("activo");
        $horario->created_by    = Auth::user()->id;

        // Días seleccionados en la tabla
        foreach ($request->get("cod_dia") as $week_day) {

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

            $this->storeGroupTeacher($horario->cod_grupo, $horario->cod_docente);

            // Add Auxiliar
            /*$auxiliar_id = $request->get("cod_auxiliar");
            Auxiliar::find($auxiliar_id)->addHorarios()->save($horario);*/

            // Enviando mensaje
            return redirect()->route('dashboard.academic_schedule.index')
                ->with('message', 'El horario fue registraron satisfactoriamente');

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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditProfesor($id){

        $horario = Horario::find($id);

        $talleres = Taller::lists('nom_taller','id');

        //dd($horario);
        return view('horario.edit-profesor', compact('horario', 'talleres') );

    }


    public function update(StoreHoraryRequest $request, $id)
    {

        // Buscando atributos del grupo
        $group = Grupo::find($request->get("cod_grupo"));

        // Update Horario
        $horario = Horario::find($id);
        $horario->id_academic_period = $request->get("id_academic_period");
        $horario->cod_modalidad = $group->cod_modalidad;
        $horario->cod_esp_tipo  = $group->cod_esp_tipo;
        $horario->cod_esp       = $group->cod_esp;
        $horario->cod_grupo     = $request->get("cod_grupo");
        $horario->cod_mod       = $request->get("cod_mod");
        $horario->cod_docente   = $request->get("cod_docente");
        $horario->fec_inicio    = $request->get("fec_inicio");
        $horario->fec_fin       = $request->get("fec_fin");
        $horario->h_inicio      =  $request->get("h_inicio");
        $horario->h_fin         = $request->get("h_fin");
        $horario->num_horas     = $request->get("num_horas");
        $horario->num_taller    = $request->get("num_taller");
        $horario->cod_sede      = $group->cod_sede;
        $horario->updated_at    = Carbon::now();
        $horario->activo        = $request->get("activo");
        $horario->updated_by    = Auth::user()->id;
        $horario->monday        = 0;
        $horario->sunday        = 0;
        $horario->tuesday       = 0;
        $horario->wednesday     = 0;
        $horario->thursday      = 0;
        $horario->friday        = 0;
        $horario->saturday      = 0;

        // Días seleccionados en la tabla
        foreach ($request->get("cod_dia") as $week_day) {

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
            ->with('message', 'El horario fue actualizado satisfactoriamente');

        }


    }

    /**
     * @param StoreHoraryProfesorRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putUpdateProfesor(StoreHoraryProfesorRequest $request, $id){

        $horario = Horario::find($id);
        $horario->updated_by = Auth::user()->id;
        $horario->update($request->all());

        //Enviando mensaje
        return redirect()->route('teacher.academic_schedule.index')
            ->with('message', 'El número de talleres fue actualizado');

    }


    /**
     * @return array
     */
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

    /**
     * Registra al Grupo con el Docente
     * @param $id_group
     * @param $id_teacher
     */
    public function storeGroupTeacher($id_group, $id_teacher){

        $find_group_teacher = GroupTeacher::where("id_group", $id_group)->where("id_teacher", $id_teacher);

        if($find_group_teacher->count() == 0){

            GroupTeacher::create(
                [
                    "id_group"   => $id_group,
                    "id_teacher" => $id_teacher
                ]
            );

        }

    }

    /**
     * Eliminar el registro del grupo y el docente
     * @param $id_group
     * @param $id_teacher
     */
    public function deleteGroupTeacher($id_group, $id_teacher)
    {
        $find_group_teacher = GroupTeacher::where("id_group", $id_group)->where("id_teacher", $id_teacher)->first();
        $find = GroupTeacher::findOrFail($find_group_teacher->id);
        $find->delete();

    }

}
