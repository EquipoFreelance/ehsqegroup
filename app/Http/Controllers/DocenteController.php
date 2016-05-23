<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use App\PersonalCargoTipo;
use App\PersonaCargo;
use App\PersonaCorreo;
use Validator;
use Illuminate\Http\Response;
use Carbon\Carbon;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $docentes = Persona::where("deleted", '=', 0)
      ->with(['cargos' => function($query){
          $query->where('cod_personal_cargo_tipo', '=', '1');
      }])
      ->with('correos')
      ->get();

      return view('docente.index', array('docentes' => $docentes));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('docente.create');
    }

    /* Reglas de validación */
    function validateRules()
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
        return $rules;

    }

    /* Mensaje personalizado */
    function validateMessage()
    {
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
      return $messages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
        $docente = Persona::find($id);
        $data = [
                "docente" => $docente
            ];
        return view('docente.edit', $data);
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
