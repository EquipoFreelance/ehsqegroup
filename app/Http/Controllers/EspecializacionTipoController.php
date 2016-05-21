<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EspecializacionTipo;
use App\Http\Requests;
use Validator;

use Illuminate\Http\Response;
use Carbon\Carbon;

class EspecializacionTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $esps_types = EspecializacionTipo::where("deleted", '=', 0)->get();
        return view('tipo_especializacion.index', array('esps_types' => $esps_types));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tipo_especializacion.create');
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
            'nom_esp_tipo' => 'required',
            'activo'       => 'required|integer|min:0'
        ];

        // Mensaje Personalizado
        $messages = [
            'nom_esp_tipo.required'   => 'Es necesario ingresar el nombre del tipo de especialización',
            'activo.required'         => 'Es necesario indicar si el tipo de especialización estará activo o inactivo',
            'activo.integer'          => 'Solo esta permitido que sea números enteros',
            'activo.min'              => 'Solo esta permitido valor enteros +'
        ];

        // Enviando los parametros necesarios para la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si existen errores el Sistema muestra un mensaje
        if ($validator->fails()){

          // Enviando Mensaje
          return redirect('/dashboard/tesp/create')
                                  ->withErrors($validator)
                                  ->withInput();
        } else {

          // Registramos el nuevo tipo de especialización
          $te               = new EspecializacionTipo;
          $te->nom_esp_tipo = $request->get("nom_esp_tipo");
          $te->activo       = $request->get("activo");
          $te->created_at   = Carbon::now();

          if($te->save()){

              //Enviando mensaje
              return redirect('/dashboard/tesp')
                                      ->with('message', 'Tipo de Especialización creado satisfactoriamente');

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
        //return view('tipo_especializacion.edit', $te);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $te = EspecializacionTipo::find($id);
        return view('tipo_especializacion.edit', array("te" => $te ));
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
          'nom_esp_tipo' => 'required',
          'activo'       => 'required|integer|min:0'
      ];

      // Mensaje Personalizado
      $messages = [
          'nom_esp_tipo.required'   => 'Es necesario ingresar el nombre del tipo de especialización',
          'activo.required'         => 'Es necesario indicar si el tipo de especialización estará activo o inactivo',
          'activo.integer'          => 'Solo esta permitido que sea números enteros',
          'activo.min'              => 'Solo esta permitido valor enteros +'
      ];

      // Enviando los parametros necesarios para la validación
      $validator = Validator::make($request->all(), $rules, $messages);

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails()){

        // Enviando Mensaje
        return redirect('/dashboard/tesp/'.$id.'/edit')
                                ->withErrors($validator)
                                ->withInput();
      } else {

        // Actualizando el tipo de especialización
        $te               = EspecializacionTipo::find($id);
        $te->nom_esp_tipo = $request->get("nom_esp_tipo");
        $te->activo       = $request->get("activo");
        $te->updated_at   = Carbon::now();

        if($te->save()){

            //Enviando mensaje
            return redirect('/dashboard/tesp')
                                    ->with('message', 'Tipo de Especialización fue actualizado satisfactoriamente');

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
        $te             = EspecializacionTipo::find($id);
        $te->deleted    = 1;
        $te->deleted_at = Carbon::now();

        if($te->save()){

            //Enviando mensaje
            return redirect('/dashboard/tesp')
                                    ->with('message', 'El Tipo de especialidad fue eliminado del sistema');

        }
    }
}
