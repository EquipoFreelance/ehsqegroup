<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modelos asociados
use App\Models\Especializacion;
use App\Models\EspecializacionTipo;
use App\Models\Modalidad;

use App\Http\Requests;
use Validator;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Str as Str;
use AppHelper;

class EspecializacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $esps = Especializacion::where("deleted", '=', 0)->with('esptipo')->get();
      return view('especializacion.index', array('esps' => $esps));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [
                  'types' => EspecializacionTipo::lists('nom_esp_tipo', 'id'),  // Tipo de especialización
                  'modalidades' => Modalidad::lists('nom_mod','id')             // Modalidades
                ];
        return view('especializacion.create', $data);

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
            'nom_esp'      => 'required',
            'nom_corto'    => 'required',
            'cod_esp_tipo' => 'required',
            'descripcion'  => 'required',
            'activo'       => 'required|integer'
        ];

        // Mensaje Personalizado
        $messages = [
            'nom_esp.required'      => 'Es necesario ingresar el nombre de la especialización',
            'nom_corto.required'    => 'Es necesario ingresar el nombre corto de la especialización',
            'cod_esp_tipo.required' => 'Es necesario indicar el tipo de especialización',
            'descripcion.required'  => 'Es necesario ingresar una descripción breve de la especialización',
            'activo.required'       => 'Es necesario indicar si el tipo de especialización estará activo o inactivo',
            'activo.integer'        => 'Solo esta permitido que sea números enteros'
        ];

        // Enviando los parametros necesarios para la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si existen errores el Sistema muestra un mensaje
        if ( $validator->fails() ){

          // Enviando Mensaje
          return redirect('/dashboard/esp/create')
              ->withErrors($validator)
              ->withInput();

        } else {

          // Registramos la nueva especialización
          $esp               = new Especializacion;
          $esp->nom_esp      = $request->get("nom_esp");
          $esp->nom_corto    = AppHelper::strNomCorto( Str::slug($request->get("nom_corto"), '_') );
          $esp->cod_mod      = $request->get("cod_mod");
          $esp->cod_esp_tipo = $request->get("cod_esp_tipo");
          $esp->descripcion  = $request->get("descripcion");
          $esp->activo       = $request->get("activo");
          $esp->created_at   = Carbon::now();

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
      $esp = Especializacion::find($id);
      $data = [
              "esp"   => $esp,                                              // Información de la especialización
              'types' => EspecializacionTipo::lists('nom_esp_tipo', 'id'),  // Tipo de expecialización
              'modalidades' => Modalidad::lists('nom_mod','id')             // Modalidades
          ];
      return view('especializacion.edit', $data);
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
          'nom_esp'       => 'required',
          'nom_corto'     => 'required',
          'descripcion'   => 'required',
          'cod_esp_tipo'  => 'required',
          'activo'        => 'required|integer'//|min:0|min:1
      ];

      // Mensaje Personalizado
      $messages = [
          'nom_esp.required'     => 'Es necesario ingresar el nombre de la especialización',
          'nom_corto.required'   => 'Es necesario ingresar el nombre corto de la especialización',
          'descripcion.required' => 'Es necesario ingresar una descripción breve de la especialización',
          'cod_esp_tipo.required'=> 'Es necesario indicar el tipo de especialización',
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

        //return redirect('/dashboard/esp/'.$id.'/edit')

        return redirect()->route('dashboard.esp.edit', $id)
                                ->withErrors($validator)
                                ->withInput();

      } else {

        // Actualizando la especialización seleccionada
        $esp                = Especializacion::find($id);
        $esp->nom_esp       = $request->get("nom_esp");
        $esp->nom_corto     = AppHelper::strNomCorto( Str::slug($request->get("nom_corto"), '_') );
        $esp->cod_esp_tipo  = $request->get("cod_esp_tipo");
        $esp->descripcion   = $request->get("descripcion");
        $esp->activo        = $request->get("activo");
        $esp->updated_at    = Carbon::now();

        if($esp->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.esp.index')
                                    ->with('message', 'La Especialización se ha actualizado satisfactoriamente');

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
      $esp             = Especializacion::find($id);
      $esp->deleted    = 1;
      $esp->deleted_at = Carbon::now();

      if($esp->save()){

          //Enviando mensaje
          return redirect()->route('dashboard.esp.index')
                                  ->with('message', 'La especialización fue eliminado del sistema');

      }
    }

    // Metodos Asíncronos
    public function getJsonEspToGrupo($modalidad, $tipo_esp){
        $esp = Especializacion::where("cod_mod", $modalidad)->where("cod_esp_tipo", $tipo_esp)->get();
        return $esp->toJSON();
    }

}
