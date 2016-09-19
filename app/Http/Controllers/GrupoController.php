<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreGrupoRequest;

use App\Models\Sede;
use App\Models\Grupo;
use App\Models\Modalidad;
use App\Models\Especializacion;
use App\Models\EspecializacionTipo;

use Validator;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

use Carbon\Carbon;

class GrupoController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index(){
      $grupos = Grupo::where("deleted", '=', 0)->orderBy('id', 'desc')->get();
      return view('grupo.index', array('grupos' => $grupos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

      $data = [
              'sedes'                   => Sede::lists('nom_sede', 'id'),                     // Listado de Sedes
              'cod_mod'                 => 1
            ];
      return view('grupo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrupoRequest $request){


        // Registramos el grupo
        $grupo = new Grupo;

        $grupo->id_academic_period = $request->get("id_academic_period");
        $grupo->cod_esp       = $request->get("cod_esp");
        $grupo->cod_modalidad = $request->get("cod_modalidad");
        $grupo->cod_esp_tipo  = $request->get("cod_esp_tipo");
        $grupo->cod_sede      = $request->get("cod_sede");
        $grupo->nom_grupo     = $request->get("nom_grupo");
        $grupo->descripcion   = $request->get("descripcion");
        $grupo->fe_inicio     = $request->get("fe_inicio");
        $grupo->fe_fin        = $request->get("fe_fin");
        $grupo->num_max       = $request->get("num_max");
        $grupo->num_min       = $request->get("num_min");
        $grupo->activo        = $request->get("activo");

        if($grupo->save()){

        //Enviando mensaje
        return redirect()->route('dashboard.grupo.index')
        ->with('message', 'Los datos se registraron satisfactoriamente');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $grupo = Grupo::find($id);
      $data = [
              "grupo" => $grupo,
              'sedes'                   => Sede::lists('nom_sede', 'id'),                     // Listado de Sedes
              'modalidades'             => Modalidad::lists('nom_mod','id'),                  // Listado de Modalidades
              'tipo_especializaciones'  => EspecializacionTipo::lists('nom_esp_tipo','id'),   // Listado de Tipo de especialidades
              'especializaciones'       => array(),                                           // Listado de Especialización,
              'cod_mod'                 => 1
            ];
      return view('grupo.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGrupoRequest $request, $id){

      // Actualizando el grupo seleccionado
      $grupo = Grupo::find($id);

      $grupo->id_academic_period = $request->get("id_academic_period");
      $grupo->cod_esp       = $request->get("cod_esp");
      $grupo->cod_modalidad = $request->get("cod_modalidad");
      $grupo->cod_esp_tipo  = $request->get("cod_esp_tipo");
      $grupo->cod_sede      = $request->get("cod_sede");
      $grupo->nom_grupo     = $request->get("nom_grupo");
      $grupo->descripcion   = $request->get("descripcion");
      $grupo->fe_inicio     = $request->get("fe_inicio");
      $grupo->fe_fin        = $request->get("fe_fin");
      $grupo->num_max       = $request->get("num_max");
      $grupo->num_min       = $request->get("num_min");
      $grupo->activo        = $request->get("activo");

      if($grupo->save()){

        //Enviando mensaje
        return redirect()->route('dashboard.grupo.index')
                                ->with('message', 'El grupo se ha actualizado satisfactoriamente');

      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $grupo             = Grupo::find($id);
      $grupo->deleted    = 1;
      $grupo->deleted_at = Carbon::now();

      if($grupo->save()){

          //Enviando mensaje
          return redirect()->route('dashboard.grupo.index')
                                  ->with('message', 'El Grupo fue eliminado del sistema');

      }
    }


}
