<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\SedeLocal;
use App\Models\Sede;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;


class SedeLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $locales = SedeLocal::where("deleted", '=', 0)->get();
      return view('local.index', array('locales' => $locales));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sedes = Sede::lists('nom_sede', 'id');
        $data = compact('sedes');
        return view('local.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Enviando los parametros necesarios para la validación
        $validator = Validator::make( $request->all(), $this->validateRules(), $this->validateMessages() );

        // Si existen errores el Sistema muestra un mensaje
        if ($validator->fails()){

          // Enviando Mensaje
          return redirect()->route('dashboard.sede.local.create')->withErrors($validator)
          ->withInput();

        } else {

          // Registramos el local de la nueva sede
          $local = new SedeLocal;
          $local->cod_sede     = $request->get("cod_sede");
          $local->nom_local    = $request->get("nom_local");
          $local->direccion    = $request->get("direccion");
          $local->activo       = $request->get("activo");

          if($local->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.sede.local.index')
            ->with('message', 'Los datos se registraron satisfactoriamente');

          }

        }

    }

    /* Reglas de validaciones */
    public function validateRules()
    {

      /* Aplicando validación al Request */

      // Reglas de validación
      $rules = [
        'cod_sede'    => 'required',
        'nom_local'   => 'required',
        'direccion'   => 'required',
        'activo'      => 'required'
      ];

      return $rules;

    }

    /* Mensaje personalizado */
    public function validateMessages()
    {

      // Mensaje de validación Personalizado
      $messages = [
        'cod_sede.required'    => 'Seleccione el la sede',
        'nom_local.required'   => 'Es necesario ingresar la dirección',
        'direccion.required'   => 'Es necesario ingresar la descripción',
        'activo.required'      => 'Es necesario indicar si el grupo estará activo o inactivo',
        //'activo.integer'       => 'Solo esta permitido que sea números enteros'
      ];

      return $messages;
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

      $local = SedeLocal::find($id);

      $data = [
              'local' => $local,
              'sedes' => Sede::lists('nom_sede', 'id'),                     // Listado de Sedes
            ];

      return view('local.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      // Enviando los parametros necesarios para la validación
      $validator = Validator::make( $request->all(), $this->validateRules(), $this->validateMessages() );

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails()){

        // Enviando Mensaje
        return redirect()->route('dashboard.sede.local.edit', $id)
                                ->withErrors($validator)
                                ->withInput();

      } else {

          // Actualizando el local seleccionado
          $local = SedeLocal::find($id);
          $local->cod_sede     = $request->get("cod_sede");
          $local->nom_local    = $request->get("nom_local");
          $local->direccion    = $request->get("direccion");
          $local->activo       = $request->get("activo");

          if($local->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.sede.local.index')
                                    ->with('message', 'El Local se ha actualizado satisfactoriamente');

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
        //
    }
}
