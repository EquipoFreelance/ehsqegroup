<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

use App\Models\Persona;
use App\Models\PersonaCorreo;
use App\Models\PersonaTelefono;
use App\Models\Student;
use App\Models\Enrollment;


use Validator;

class StudentController extends Controller
{

  public function index()
  {
      return view('student.index');
  }

  public function create()
  {

    $data = array();
    return view('student.create', $data);

  }
    
    public function getIndexGroup($cod_grupo){
        return view('student.index-group', compact('cod_grupo'));
    }

  public function show()
  {
    //$persona = Persona::with('persona_student')->find(32);//->persona_telefonos->toJson();
    //return $persona->persona_student()->first()->id;
  }

  public function edit($id)
  {

    $student = Student::with('persona.persona_correos')->with('persona.persona_telefonos')->find($id);
    $data = compact('student');
    return view('student.edit', $data);

  }

  public function store(StudentStoreRequest $request)
  {

    $persona = new Persona(array(
      'nombre'           => $request->get("nombre"),
      'ape_pat'          => $request->get("ape_pat"),
      'ape_mat'          => $request->get("ape_mat"),
      'cod_doc_tip'      => $request->get("cod_doc_tip"),
      'num_doc'          => $request->get("num_doc"),
      'correo'           => $request->get("correo"),
      'cod_pais'         => $request->get("cod_pais"),
      'cod_dpto'         => $request->get("cod_dpto"),
      'cod_prov'         => $request->get("cod_prov"),
      'cod_dist'         => $request->get("cod_dist"),
      'direccion'        => $request->get("direccion"),
      'fe_nacimiento'    => $request->get("fe_nacimiento"),
      'cod_sexo'         => $request->get("cod_sexo"),
      'num_cellphone'    => $request->get("num_cellphone"),
      'num_phone'        => $request->get("num_phone"),
      'proteccion_datos' => ($request->get("proteccion_datos") == '' || $request->get("proteccion_datos") == 0)? 0 : $request->get("proteccion_datos")
    ));

    if($persona->save())
    {
      $student = new Student();
      $student->cod_persona = $persona->id;
      $student->cod_sede    = 1;
      $student->activo      = 1;
      $student->save();
      return redirect()->route('dashboard.student.edit', $student->id)
      ->with('message', 'El alumno fue registrado satisfactoriamente');
    }
  }


  public function update(StudentUpdateRequest $request, $id)
  {

      $student = Student::with('persona')->find($id);
      $student->persona->nombre           = $request->get("nombre");
      $student->persona->ape_pat          = $request->get("ape_pat");
      $student->persona->ape_mat          = $request->get("ape_mat");
      $student->persona->cod_doc_tip      = $request->get("cod_doc_tip");
      $student->persona->num_doc          = $request->get("num_doc");
      $student->persona->correo           = $request->get("correo");
      $student->persona->cod_pais         = $request->get("cod_pais");
      $student->persona->cod_dpto         = $request->get("cod_dpto");
      $student->persona->cod_prov         = $request->get("cod_prov");
      $student->persona->cod_dist         = $request->get("cod_dist");
      $student->persona->direccion        = $request->get("direccion");
      $student->persona->fe_nacimiento    = $request->get("fe_nacimiento");
      $student->persona->cod_sexo         = $request->get("cod_sexo");
      $student->persona->num_cellphone    = $request->get("num_cellphone");
      $student->persona->num_phone        = $request->get("num_phone");
      $student->persona->proteccion_datos = ($request->get("proteccion_datos") == '' || $request->get("proteccion_datos") == 0)? 0 : $request->get("proteccion_datos");

      if( $student->save() )
      {
        $student->persona->save();
        //Enviando mensaje
        return redirect()->route('dashboard.student.edit', $id)
                      ->with('message', 'La información del alumnos fue actualizado satisfactoriamente');
      }

  }


}
