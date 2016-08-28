<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\InscriptionStoreRequest;
use App\Http\Requests\InscriptionUpdateRequest;

use App\Models\Persona;
use App\Models\PersonaCorreo;
use App\Models\PersonaTelefono;
use App\Models\Student;
use App\Models\Enrollment;

use Validator;

class InscriptionController extends Controller
{

  public function index()
  {
      return view('inscription.index');
  }

  public function create()
  {

    $data = array();
    return view('inscription.create', $data);

  }

  public function store(InscriptionStoreRequest $request)
  {

    // Create new Person
    $persona = new Persona(array(
      'nombre'             => $request->get("nombre"),
      'ape_pat'            => $request->get("ape_pat"),
      'ape_mat'            => $request->get("ape_mat"),
      'cod_doc_tip'        => $request->get("cod_doc_tip"),
      'num_doc'            => $request->get("num_doc"),
      'correo'             => $request->get("correo"),
      'cod_pais'           => $request->get("cod_pais"),
      'cod_dpto'           => $request->get("cod_dpto"),
      'cod_prov'           => $request->get("cod_prov"),
      'cod_dist'           => $request->get("cod_dist"),
      'direccion'          => $request->get("direccion"),
      'num_cellphone'      => $request->get("num_cellphone"),
      'num_phone'          => $request->get("num_phone"),
      'proteccion_datos' => ($request->get("proteccion_datos") == '' || $request->get("proteccion_datos") == 0)? 0 : $request->get("proteccion_datos"),
      'activo'           => 1
    ));

    if($persona->save())
    {
      // Create new student
      $student = new Student(array(
        "cod_persona" => $persona->id,
        "cod_sede" => 1
      ));

      if( $student->save() ){

        // Create new enrollment
        $enrollment = new Enrollment( array(
          "cod_alumno"    => $student->id,                  // Code of new student
          "id_academic_period"  => $request->get("id_academic_period"),
          "cod_modalidad" => $request->get("cod_modalidad"),
          "cod_esp_tipo"  => $request->get("cod_esp_tipo"),
          "cod_esp"       => $request->get("cod_esp"),
          "activo"        => ($request->get("activo") == '' || $request->get("activo") == 0)? 0 : $request->get("activo")
        ));

        $student->enrollments()->save($enrollment);

        return redirect()->route('dashboard.inscription.edit', $student->id)
        ->with('message', 'La Inscripción fue registrada satisfactoriamente');

      }


    }
  }

  public function show()
  {
    //$persona = Persona::with('persona_student')->find(32);//->persona_telefonos->toJson();
    //return $persona->persona_student()->first()->id;
  }

  public function edit($id)
  {

    // Info of Student
    $student = Student::with('persona')->find($id);
    $data = compact('student');
    return view('inscription.edit', $data);

  }

  public function update(InscriptionStoreRequest $request, $id)
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
      $student->persona->num_cellphone    = $request->get("num_cellphone");
      $student->persona->num_phone        = $request->get("num_phone");
      $student->persona->num_phone        = $request->get("id_academic_period");
      $student->persona->proteccion_datos = ($request->get("proteccion_datos") == '' || $request->get("proteccion_datos") == 0)? 0 : $request->get("proteccion_datos");

      if( $student->save() )
      {
        $student->persona->save();

        $id_enrollment = $student->enrollments()->first()->id;      // Code of Enrollemnt associate

        $enrollment = Enrollment::find($id_enrollment);
        $enrollment->id_academic_period = $request->get("id_academic_period");
        $enrollment->cod_modalidad      = $request->get("cod_modalidad");
        $enrollment->cod_esp_tipo       = $request->get("cod_esp_tipo");
        $enrollment->cod_esp            = $request->get("cod_esp");

        if( $enrollment->save() ){
          return redirect()->route('dashboard.inscription.edit', $id)
                        ->with('message', 'La Inscripción fue actualizada satisfactoriamente');
        }

      }

  }


}
