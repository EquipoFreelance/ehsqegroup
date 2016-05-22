<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulo;
use App\Especializacion;
use App\Http\Requests;
use Validator;

use Illuminate\Http\Response;
use Carbon\Carbon;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $modulos = Modulo::where("deleted", '=', 0)->get();
      return view('modulo.index', array('modulos' => $modulos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['especializacion' => Especializacion::lists('nom_esp', 'id')];
        return view('modulo.create', $data);
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
            'nombre'      => 'required',
            'nom_corto'   => 'required',
            'cod_esp'     => 'required',
            'descripcion' => 'required',
            'activo'      => 'required|integer'//|min:0|min:1
        ];

        // Mensaje de validación Personalizado
        $messages = [
            'nombre.required'      => 'Es necesario ingresar el nombre del módulo',
            'nom_corto.required'   => 'Es necesario ingresar el nombre corto del módulo',
            'cod_esp.required'     => 'Es necesario asignar la especialización',
            'descripcion.required' => 'Es necesario ingresar una descripción breve del módulo',
            'activo.required'      => 'Es necesario indicar si el el módulo estará activo o inactivo',
            'activo.integer'       => 'Solo esta permitido que sea números enteros'
        ];

        // Enviando los parametros necesarios para la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si existen errores el Sistema muestra un mensaje
        if ($validator->fails()){

          // Enviando Mensaje
          return redirect()->route('dashboard.modulo.create')
                                  ->withErrors($validator)
                                  ->withInput();
        } else {

          // Registramos el nuevo módulo
          $obj               = new Modulo;
          $obj->nombre       = $request->get("nombre");
          $obj->nom_corto    = $request->get("nom_corto");
          $obj->cod_esp      = $request->get("cod_esp");
          $obj->descripcion  = $request->get("descripcion");
          $obj->activo       = $request->get("activo");
          $obj->created_at   = Carbon::now();

          if($obj->save()){

              //Enviando mensaje
              return redirect()->route('dashboard.modulo.index')
                                      ->with('message', 'El módulo se ha creado satisfactoriamente');

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
      $modulo = Modulo::find($id);
      $data = [
              "modulo"          => $modulo,
              'especializacion' => Especializacion::lists('nom_esp', 'id')
          ];
      return view('modulo.edit', $data);
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
      /* Aplicando validación al Request */

      // Reglas de validación
      $rules = [
          'nombre'      => 'required',
          'nom_corto'   => 'required',
          'cod_esp'     => 'required',
          'descripcion' => 'required',
          'activo'      => 'required|integer'//|min:0|min:1
      ];

      // Mensaje de validación Personalizado
      $messages = [
          'nombre.required'      => 'Es necesario ingresar el nombre del módulo',
          'nom_corto.required'   => 'Es necesario ingresar el nombre corto del módulo',
          'cod_esp.required'     => 'Es necesario asigna la especialización',
          'descripcion.required' => 'Es necesario ingresar una descripción breve del módulo',
          'activo.required'      => 'Es necesario indicar si el el módulo estará activo o inactivo',
          'activo.integer'       => 'Solo esta permitido que sea números enteros'
      ];

      // Enviando los parametros necesarios para la validación
      $validator = Validator::make($request->all(), $rules, $messages);

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails()){

        // Enviando Mensaje
        return redirect()->route('dashboard.modulo.edit', $id)
                                ->withErrors($validator)
                                ->withInput();
      } else {

        // Actualizando el módulo seleccionado
        $obj               = Modulo::find($id);
        $obj->nombre       = $request->get("nombre");
        $obj->nom_corto    = $request->get("nom_corto");
        $obj->cod_esp      = $request->get("cod_esp");
        $obj->descripcion  = $request->get("descripcion");
        $obj->activo       = $request->get("activo");
        $obj->updated_at   = Carbon::now();

        if($obj->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.modulo.index')
                                    ->with('message', 'El módulo se ha actualizado satisfactoriamente');

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
      $obj             = Modulo::find($id);
      $obj->deleted    = 1;
      $obj->deleted_at = Carbon::now();

      if($obj->save()){

          //Enviando mensaje
          return redirect()->route('dashboard.modulo.index')
                                  ->with('message', 'El Módulo fue eliminado del sistema');

      }
    }
}
