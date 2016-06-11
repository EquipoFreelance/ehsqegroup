<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Modalidad;

use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ModalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $modalidades = Modalidad::where("deleted", '=', 0)->get();
      return view('modalidad.index', array('modalidades' => $modalidades));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modalidad.create');
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
        return redirect()->route('dashboard.modalidad.create')->withErrors($validator)
        ->withInput();

      } else {

          // Registramos la modalidad
          $modalidad = new Modalidad;
          $modalidad->nom_mod      = $request->get("nom_mod");
          $modalidad->activo       = $request->get("activo");

          if($modalidad->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.modalidad.index')
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
        'nom_mod' => 'required',
        'activo'  => 'required'
      ];

      return $rules;

    }

    /* Mensaje personalizado */
    public function validateMessages()
    {

      // Mensaje de validación Personalizado
      $messages = [
        'nom_mod.required' => 'Es necesario ingresar el nombre del modulo',
        'activo.required'  => 'Es necesario indicar si el grupo estará activo o inactivo',
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
      $modalidad = Modalidad::find($id);
      $data = [
              "modalidad" => $modalidad
            ];
      return view('modalidad.edit', $data);
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
        return redirect()->route('dashboard.modalidad.edit', $id)
                                ->withErrors($validator)
                                ->withInput();

      } else {

          // Actualizando el grupo seleccionado
          $modalidad = Modalidad::find($id);
          $modalidad->nom_mod = $request->get("nom_mod");
          $modalidad->activo  = $request->get("activo");

          if($modalidad->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.modalidad.index')
                                    ->with('message', 'La modalidad se ha actualizado satisfactoriamente');

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
      $modalidad             = Modalidad::find($id);
      $modalidad->deleted    = 1;
      $modalidad->deleted_at = Carbon::now();

      if($modalidad->save()){

          //Enviando mensaje
          return redirect()->route('dashboard.modalidad.index')
                                  ->with('message', 'La Modalidad fue eliminado del sistema');

      }
    }
}
