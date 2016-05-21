<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especializacion;
use App\Http\Requests;
use Validator;

use Illuminate\Http\Response;
use Carbon\Carbon;

class EspecializacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $esps = Especializacion::where("deleted", '=', 0)->get();
      return view('especializacion.index', array('esps' => $esps));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especializacion.create');
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
            'nom_esp'     => 'required',
            'nom_corto'   => 'required',
            'descripcion' => 'required',
            'activo'      => 'required|integer'//|min:0|min:1
        ];

        // Mensaje Personalizado
        $messages = [
            'nom_esp.required'     => 'Es necesario ingresar el nombre de la especialización',
            'nom_corto.required'   => 'Es necesario ingresar el nombre corto de la especialización',
            'descripcion.required' => 'Es necesario ingresar una descripción breve de la especialización',
            'activo.required'      => 'Es necesario indicar si el tipo de especialización estará activo o inactivo',
            'activo.integer'       => 'Solo esta permitido que sea números enteros',
            //'activo.min'           => 'Solo esta permitido valor enteros +',
            //'activo.max'           => 'Solo esta permitido valor enteros +'
        ];

        // Enviando los parametros necesarios para la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si existen errores el Sistema muestra un mensaje
        if ($validator->fails()){

          // Enviando Mensaje
          return redirect('/dashboard/esp/create')
                                  ->withErrors($validator)
                                  ->withInput();

        } else {

          // Registramos la nueva especialización
          $esp              = new Especializacion;
          $esp->nom_esp     = $request->get("nom_esp");
          $esp->nom_corto   = $request->get("nom_corto");
          $esp->descripcion = $request->get("descripcion");
          $esp->activo      = $request->get("activo");
          $esp->created_at  = Carbon::now();

          if($esp->save()){

              //Enviando mensaje
              return redirect('/dashboard/esp')
                                      ->with('message', 'La Especialización se ha creado satisfactoriamente');

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
