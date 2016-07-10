<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\InscriptionStoreRequest;

use App\Models\Persona;
use App\Models\PersonaCorreo;
use App\Models\PersonaTelefono;
use App\Models\Student;
use App\Models\Enrollment;


use Validator;

class InscriptionController extends Controller
{

  public function create()
  {

    $data = array();
    return view('inscription.create', $data);

  }

  public function show()
  {

    //$persona = Persona::with('persona_student')->find(32);//->persona_telefonos->toJson();

    //return $persona->persona_student()->first()->id;

  }

  public function store(InscriptionStoreRequest $request)
  {

      $persona = new Persona();
      $persona->num_doc           = $request->get("num_doc");
      $persona->cod_doc_tip       = $request->get("cod_doc_tip");
      $persona->nombre            = $request->get("nombre");
      $persona->ape_pat           = $request->get("ape_pat");
      $persona->ape_mat           = $request->get("ape_mat");
      $persona->direccion         = $request->get("direccion");
      $persona->fe_nacimiento     = $request->get("fe_nacimiento");
      $persona->cod_sexo          = $request->get("cod_sexo");
      $persona->proteccion_datos  = $request->get("proteccion_datos");
      $persona->activo            = 1; // Por defecto

      if($persona->save())
      {
          // Add Telefono Fijo
          $t1 = new PersonaTelefono();
          $t1->tipo_telefono = 1;
          $t1->num_telefono  = $request->get("num_tel_mobile");
          $persona->persona_telefonos()->save($t1);

          // Add Telefono Fijo
          $t2 = new PersonaTelefono();
          $t2->tipo_telefono = 2;
          $t2->num_telefono  = $request->get("num_tel_fijo");
          $persona->persona_telefonos()->save($t2);

          // Add Correo electrónico
          $c1 = new PersonaCorreo();
          $c1->correo = $request->get("correo");
          $persona->persona_correos()->save($c1);

          // Add alumno
          $student = new Student();
          $student->cod_persona = $persona->id;
          $student->cod_sede    = 1;
          $student->activo      = 1;
          $persona->persona_student()->save($student);

          // Add Matrícula (La matricula esta por defecto inactivo debido a que se debe realizar la validación interna)
          $matricula = new Enrollment();
          $matricula->cod_alumno    = $persona->persona_student()->first()->id;
          $matricula->cod_modalidad = 1;
          $matricula->cod_esp_tipo  = 1;
          $matricula->cod_esp       = 1;
          $matricula->fecha_inicio  = 1;
          $matricula->activo        = 0;
          $matricula->save();

          return redirect()->route('dashboard.inscription.create')
          ->with('message', 'Inscripción realizada satisfactoriamente');

      }


  }

}
