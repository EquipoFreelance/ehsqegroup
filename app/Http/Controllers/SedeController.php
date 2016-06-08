<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Sede;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SedeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $sedes = Sede::where("deleted", '=', 0)->get();
    return view('sede.index', array('sedes' => $sedes));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('sede.create');
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

      // Registramos al Sede
      $sede = new Sede;
      $sede->nom_sede = $request->get("nom_sede");
      $sede->activo   = $request->get("activo");
      if($sede->save()){

        //Enviando mensaje
        return redirect()->route('dashboard.sede.index')
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
    $sede = Sede::find($id);
    $data = [
            "sede" => $sede
        ];
    return view('sede.edit', $data);
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
      return redirect()->route('dashboard.sede.edit', $id)
                              ->withErrors($validator)
                              ->withInput();

    } else {

      // Actualizando el grupo seleccionado
      $sede = Sede::find($id);
      $sede->nom_sede = $request->get("nom_sede");
      $sede->activo   = $request->get("activo");

      if($sede->save()){

        //Enviando mensaje
        return redirect()->route('dashboard.sede.index')
                                ->with('message', 'La sede se ha actualizado satisfactoriamente');

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
    $sede             = Sede::find($id);
    $sede->deleted    = 1;
    $sede->deleted_at = Carbon::now();

    if($sede->save()){

        //Enviando mensaje
        return redirect()->route('dashboard.sede.index')
                                ->with('message', 'La sede fue eliminado del sistema');

    }
  }

  /* Reglas de validaciones */
  public function validateRules()
  {

    /* Aplicando validación al Request */

    // Reglas de validación
    $rules = [
      'nom_sede'   => 'required',
      'activo'      => 'required'
    ];

    return $rules;

  }

  /* Mensaje personalizado */
  public function validateMessages()
  {

    // Mensaje de validación Personalizado
    $messages = [
      'nom_sede.required' => 'Es necesario ingresar el nombre de la sede',
      'activo.required'   => 'Es necesario indicar si el grupo estará activo o inactivo',
      'activo.integer'    => 'Solo esta permitido que sea números enteros'
    ];

    return $messages;
  }


}
