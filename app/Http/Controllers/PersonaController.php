<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use App\PersonalCargoTipo;
use App\PersonaCargo;
use Validator;
use Illuminate\Http\Response;
use Carbon\Carbon;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = ['personal_cargo' => PersonalCargoTipo::lists('cargo', 'id')];
      return view('persona.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Aplicando validación al Request */

        // Reglas de validación
        $rules = [
            'cod_personal_cargo_tipo' => 'required',
            'cod_doc_tip'       => 'required',
            'num_doc'           => 'required',
            'nombre'            => 'required',
            'ape_pat'           => 'required',
            'ape_mat'           => 'required',
            'direccion'         => 'required',
            'fe_nacimiento'     => 'required',
            'cod_sexo'          => 'required',
            'activo'            => 'required'
        ];

        // Mensaje de validación Personalizado
        $messages = [
            'cod_personal_cargo_tipo.required'  => 'Seleccione el tipo de cargo',
            'cod_doc_tip.required'        => 'Seleccione el tipo de documento',
            'num_doc.required'            => 'Es necesario ingresar el número de documento',
            'nombre.required'             => 'Es necesario ingresar el nombre',
            'ape_pat.required'            => 'Es necesario ingresar el apellido paterno',
            'ape_mat.required'            => 'Es necesario ingresar el apellido materno',
            'direccion.required'          => 'Es necesario ingresar la dirección',
            'fe_nacimiento.required'      => 'Es necesario ingresar la fecha de nacimiento',
            'cod_sexo.required'           => 'Es necesario indicar el género',
            'activo.required'             => 'Es necesario indicar si el personal estará activo o inactivo',
            'activo.integer'              => 'Solo esta permitido que sea números enteros'
        ];

        // Enviando los parametros necesarios para la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si existen errores el Sistema muestra un mensaje
        if ($validator->fails()){

          // Enviando Mensaje
          return redirect()->route('dashboard.persona.create')
                                  ->withErrors($validator)
                                  ->withInput();
        } else {

          // Registramos el nuevo módulo
          $obj = new Persona;
          $obj->cod_doc_tip   = $request->get("cod_doc_tip");
          $obj->num_doc       = $request->get("num_doc");
          $obj->nombre        = $request->get("nombre");
          $obj->ape_pat       = $request->get("ape_pat");
          $obj->ape_mat       = $request->get("ape_mat");
          $obj->direccion     = $request->get("direccion");
          $obj->fe_nacimiento = $request->get("fe_nacimiento");
          $obj->cod_sexo      = $request->get("cod_sexo");
          $obj->activo        = $request->get("activo");
          $obj->created_at    = Carbon::now();

          if($obj->save()){

              // Asignando el Cargo al Personal

              $pc = new PersonaCargo;
              $pc->cod_persona              = $obj->id;
              $pc->cod_personal_cargo_tipo  = $request->get("cod_personal_cargo_tipo");
              $pc->activo                   = $request->get("activo");
              $pc->created_at               = Carbon::now();
              $pc->save();

              //Enviando mensaje
              return redirect()->route('dashboard.persona.create')
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
        //
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
        //
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
