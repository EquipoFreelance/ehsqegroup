<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Persona;
use App\Models\PersonalCargoTipo;
use App\Models\PersonaCargo;
use App\Models\PersonaCorreo;
use App\Models\Docente;
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

      $docentes = Docente::where("deleted", '=', 0)->get();
      $data = compact('docentes');
      return view('docente.index', $data);

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
        return redirect()->route('dashboard.docente.create')->withErrors($validator)
        ->withInput();

      } else {

        // Registramos a la persona
        $persona = new Persona;
        $persona->cod_doc_tip   = $request->get("cod_doc_tip");
        $persona->num_doc       = $request->get("num_doc");
        $persona->nombre        = $request->get("nombre");
        $persona->ape_pat       = $request->get("ape_pat");
        $persona->ape_mat       = $request->get("ape_mat");
        $persona->direccion     = $request->get("direccion");
        $persona->fe_nacimiento = $request->get("fe_nacimiento");
        $persona->cod_sexo      = $request->get("cod_sexo");
        $persona->activo        = $request->get("activo");
        $persona->created_at    = Carbon::now();


        if($persona->save()){

          $cargo =  new Docente([
            'cod_persona' => $persona->id,
            'activo'      => $request->get("activo")
          ]);

          $cargos = [$cargo];
          $persona->docente()->saveMany($cargos);

          //Enviando mensaje
          return redirect()->route('dashboard.docente.index')
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

        $docente = Docente::find($id);
        $data = compact('docente');
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
      // Enviando los parametros necesarios para la validación
      $validator = Validator::make( $request->all(), $this->validateRules(), $this->validateMessages() );

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails())
      {
        // Enviando Mensaje
        return redirect()->route('dashboard.docente.edit', $id)->withErrors($validator)
        ->withInput();

      } else {

        $docente = Docente::with('Persona')->find($id);

        // Actualizamos información personal del docente
        $docente->persona->fill([
          'cod_doc_tip'   => $request->get("cod_doc_tip"),
          'num_doc'       => $request->get("num_doc"),
          'nombre'        => $request->get("nombre"),
          'ape_pat'       => $request->get("ape_pat"),
          'ape_mat'       => $request->get("ape_mat"),
          'direccion'     => $request->get("direccion"),
          'fe_nacimiento' => $request->get("fe_nacimiento"),
          'cod_sexo'      => $request->get("cod_sexo"),
          'updated_at'    => Carbon::now()
        ]);

        if( $docente->push() ){

          return redirect()->route('dashboard.docente.index')
          ->with('message', 'Los datos se actualizaron satisfactoriamente');

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

    /* -- validaciones -- */

    // Reglas definidas
    public function validateRules()
    {

      /* Aplicando validación al Request */

      // Reglas de validación
      $rules = [
        'cod_doc_tip'       => 'required',
        'num_doc'           => 'required',
        'nombre'            => 'required',
        'ape_pat'           => 'required',
        'ape_mat'           => 'required',
        'direccion'         => 'required',
        'telefono'          => 'required',
        'fe_nacimiento'     => 'required',
        'cod_sexo'          => 'required',
        'activo'            => 'required'
      ];

      return $rules;

    }

    // Mensaje personalizado
    public function validateMessages()
    {

      // Mensaje de validación Personalizado
      $messages = [
        'cod_doc_tip.required'        => 'Seleccione el tipo de documento',
        'num_doc.required'            => 'Es necesario ingresar el número de documento',
        'nombre.required'             => 'Es necesario ingresar el nombre',
        'ape_pat.required'            => 'Es necesario ingresar el apellido paterno',
        'ape_mat.required'            => 'Es necesario ingresar el apellido materno',
        'telefono.required'           => 'Es necesario ingresar un número telefónico',
        'direccion.required'          => 'Es necesario ingresar una dirección',
        'fe_nacimiento.required'      => 'Es necesario ingresar una fecha de nacimiento',
        'cod_sexo.required'           => 'Es necesario indicar el género',
        'activo.required'             => 'Es necesario indicar si el personal estará activo o inactivo',
        'activo.integer'              => 'Solo esta permitido que sea números enteros'
      ];

      return $messages;
    }


}
