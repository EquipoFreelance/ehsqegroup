<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Sede;
use App\Models\Grupo;
use App\Especializacion;
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
      $grupos = Grupo::where("deleted", '=', 0)->get();
      return view('grupo.index', array('grupos' => $grupos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

      $data = [
              'sedes' => Sede::lists('nom_sede', 'id'),
              'especializaciones' => Especializacion::lists('nom_esp','id')
            ];
      return view('grupo.create', $data);
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

          // Registramos el grupo
          $grupo = new Grupo;
          $grupo->cod_sede    = $request->get("cod_sede");
          $grupo->cod_esp     = $request->get("cod_esp");
          $grupo->nom_grupo   = $request->get("nom_grupo");
          $grupo->descripcion = $request->get("descripcion");
          $grupo->fe_inicio   = $request->get("fe_inicio");
          $grupo->fe_fin      = $request->get("fe_fin");
          $grupo->num_max     = $request->get("num_max");
          $grupo->num_min     = $request->get("num_min");
          $grupo->activo      = $request->get("activo");

          if($grupo->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.grupo.index')
            ->with('message', 'Los datos se registraron satisfactoriamente');

          }

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
              'sedes' => Sede::lists('nom_sede', 'id'),
              'especializaciones' => Especializacion::lists('nom_esp','id')
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
    public function update(Request $request, $id){

      // Enviando los parametros necesarios para la validación
      $validator = Validator::make( $request->all(), $this->validateRules(), $this->validateMessages() );

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails()){

        // Enviando Mensaje
        return redirect()->route('dashboard.grupo.edit', $id)
                                ->withErrors($validator)
                                ->withInput();

      } else {

          // Actualizando el grupo seleccionado
          $grupo = Grupo::find($id);
          $grupo->cod_sede    = $request->get("cod_sede");
          $grupo->cod_esp     = $request->get("cod_esp");
          $grupo->nom_grupo   = $request->get("nom_grupo");
          $grupo->descripcion = $request->get("descripcion");
          $grupo->fe_inicio   = $request->get("fe_inicio");
          $grupo->fe_fin      = $request->get("fe_fin");
          $grupo->num_max     = $request->get("num_max");
          $grupo->num_min     = $request->get("num_min");
          $grupo->activo      = $request->get("activo");

          if($grupo->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.grupo.index')
                                    ->with('message', 'El grupo se ha actualizado satisfactoriamente');

          }
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
    /* Reglas de validaciones */
    public function validateRules()
    {

      /* Aplicando validación al Request */

      // Reglas de validación
      $rules = [
        'nom_grupo'   => 'required',
        'cod_sede'    => 'required',
        'descripcion' => 'required',
        'fe_inicio'   => 'required',
        'fe_fin'      => 'required',
        'num_min'     => 'required',
        'num_max'     => 'required',
        'activo'      => 'required'
      ];

      return $rules;

    }

    /* Mensaje personalizado */
    public function validateMessages()
    {

      // Mensaje de validación Personalizado
      $messages = [
        'nom_grupo.required'   => 'Es necesario ingresar el nombre del grupo',
        'cod_sede.required'    => 'Seleccione el la sede',
        'descripcion.required' => 'Es necesario ingresar la descripción',
        'fe_inicio.required'   => 'Es necesario ingresar la fecha de inicio',
        'fe_fin.required'      => 'Es necesario ingresar la fecha de finalizacion',
        'num_min.required'     => 'Es necesario ingresar el número mínimo de alumnos',
        'num_max.required'     => 'Es necesario ingresar el número máximo de alumnos',
        'activo.required'      => 'Es necesario indicar si el grupo estará activo o inactivo',
        //'activo.integer'       => 'Solo esta permitido que sea números enteros'
      ];

      return $messages;
    }

}
