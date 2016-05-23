<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use App\PersonalCargoTipo;
use App\PersonaCargo;
use App\PersonaCorreo;
use App\PersonaTelefono;
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
    // Enviando los parametros necesarios para la validación
    $validator = Validator::make($request->all(), $this->validateRules(), $this->validateMessage());

    // Si existen errores el Sistema muestra un mensaje
    if ($validator->fails()){

      // Enviando Mensaje
      return redirect()->route('dashboard.docente.index')
      ->withErrors($validator)
      ->withInput();

    } else {

      // Registramos el nuevo módulo
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

        // Agregando correos electrónicos
        $this->setPersonaCorreo($persona, $request);

        // Agregando cargo al docente
        $this->setPersonaCargo($persona, $request);

        // Agregando teléfonos
        $this->setPersonaTelefono($persona, $request);


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

  /* Reglas de validaciones */
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
      'telefono'          => 'required',
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
      'telefono.required'           => 'Es necesario ingresar un número telefónico',
      'direccion.required'          => 'Es necesario ingresar una dirección',
      'fe_nacimiento.required'      => 'Es necesario ingresar una fecha de nacimiento',
      'cod_sexo.required'           => 'Es necesario indicar el género',
      'activo.required'             => 'Es necesario indicar si el personal estará activo o inactivo',
      'activo.integer'              => 'Solo esta permitido que sea números enteros'
    ];

    return $messages;
  }


  /* Aplicando otros metodos para registrar datos en tablas relacionadas */

  // Permite registrar correos electronicos
  function setPersonaCorreo($obj, $request)
  {

    if( isset( $obj->correos[0] )){

      $correo = PersonaCorreo::find($obj->correos[0]->id);
      $correo->cod_persona = $obj->id;
      $correo->correo      = $request->get("correo");
      $correo->activo      = $request->get("activo");
      $correo->updated_at  = Carbon::now();

    } else {

      $correo =  new PersonaCorreo(['correo' => $request->get("correo"), 'cod_persona' => $obj->id]);

    }
    $correos = [$correo];
    $obj->correos()->saveMany($correos);

  }

  // Permite asignar cargos
  function setPersonaCargo($obj, $request)
  {

    if( isset($obj->cargos[0]) ){
      // Asignado un cargo de docente
      $cargo = PersonaCargo::find($obj->cargos[0]->id);
      $cargo->cod_persona              = $obj->id;
      $cargo->cod_personal_cargo_tipo  = $request->get("cod_personal_cargo_tipo");
      $cargo->activo                   = $request->get("activo");
      $cargo->updated_at               = Carbon::now();
    } else {

      $cargo =  new PersonaCargo([
        'cod_persona'             => $obj->id,
        'cod_personal_cargo_tipo' => $request->get("cod_personal_cargo_tipo"),
        'activo'                  => $request->get("activo"),
        'updated_at'              => Carbon::now()
      ]);

    }

    $cargos = [$cargo];

    $obj->cargos()->saveMany($cargos);

  }

  // Permite registrar telefonos
  function setPersonaTelefono($obj, $request)
  {

    if( isset($obj->telefonos[0]) ){

      // Asignado un cargo de docente
      $telefono = PersonaTelefono::find($obj->telefonos[0]->id);
      $telefono->cod_persona = $obj->id;
      $telefono->telefono    = $request->get("telefono");

    } else {

      $telefono =  new PersonaTelefono([
        'cod_persona' => $obj->id,
        'telefono'    => $request->get("cod_personal_cargo_tipo")
      ]);

    }

    $telefonos = [$telefono];

    $obj->cargos()->saveMany($telefonos);

  }


}
