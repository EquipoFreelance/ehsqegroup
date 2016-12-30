<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\EnrollmentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\InscriptionStoreRequest;
use App\Http\Requests\InscriptionUpdateRequest;

use App\Models\Persona;
use App\Models\PersonaCorreo;
use App\Models\PersonaTelefono;
use App\Models\Student;
use App\Models\Enrollment;

use Auth;
use Validator;
use Carbon\Carbon;

class InscriptionController extends Controller
{

  public function index()
  {
      return view('inscription.index');
  }

    /**
     * Create Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function create()
    {

        $data = array("title" => "Ficha de inscripción", "created_by" => Auth::user()->id);
        return view('inscription.create', $data);

    }

    /**
     * Create Form Public
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPublicCreate(Request $request){

      $data = array("title" => "Ficha de inscripción", "created_by" => $request->get("created_by"));
      return view('inscription.create_public', $data);

    }

  public function store(InscriptionStoreRequest $request)
  {

    $data = array(
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
        'proteccion_datos'   => ($request->get("proteccion_datos") == '' || $request->get("proteccion_datos") == 0)? 0 : $request->get("proteccion_datos"),
        'activo'             => 1
    );

    // Validando DNI
    $find_person = Persona::where("num_doc", $request->get("num_doc") );

    $created_by = $request->get("created_by");

    // Si la persona existe en la tabla persona, se realiza un update de su información
    if($find_person->get()->count() == 0){

        $person = new Persona($data);
        $person->created_at = Carbon::now();
        $person->created_by = $created_by;
        $person->save();

    } else {

        $person = Persona::findOrFail($find_person->first()->id);
        $person->update($data);
        $person->updated_at = Carbon::now();
        $person->updated_by = $created_by;
    }

    // Si la persona existe en la tabla alumno obtenemos su ID
    $find_student = Student::where("cod_persona", $person->id);

    if( $find_student->get()->count() == 0 ){

        $student = new Student(array(
            "cod_persona" => $person->id,
            "cod_sede"    => 1,
            "activo"      => 1
        ));
        $student->created_at = Carbon::now();
        $student->created_by = $created_by;
        $student->save();

    } else {

        $student = Student::find($find_student->first()->id);
    }

    // Si la persona intenta matricuarlse dos veces en una misma especialidad le mostrarmos el error
    $find_enrollment = Enrollment::where("cod_alumno", $student->id)
                                    ->where("id_academic_period", $request->get("id_academic_period"))
                                    ->where("cod_modalidad", $request->get("cod_modalidad"))
                                    ->where("cod_esp_tipo", $request->get("cod_esp_tipo"))
                                    ->where("cod_esp", $request->get("cod_esp"));

    if( $find_enrollment->get()->count() == 0 ){

        // Create new enrollment
        $enrollment = new Enrollment( array(
            "cod_alumno"          => $student->id,                  // Code of new student
            "id_academic_period"  => $request->get("id_academic_period"),
            "cod_modalidad"       => $request->get("cod_modalidad"),
            "cod_esp_tipo"        => $request->get("cod_esp_tipo"),
            "cod_esp"             => $request->get("cod_esp"),
            "activo"              => ($request->get("activo") == '' || $request->get("activo") == 0)? 0 : $request->get("activo"),
        ));

        $enrollment->created_at = Carbon::now();
        $enrollment->created_by = $created_by;

        $student->enrollments()->save($enrollment);

        return redirect()->route('dashboard.inscription.thankyoupage')
            ->with('message', 'La Inscripción fue registrada satisfactoriamente');

    }else{

        return redirect()->route('dashboard.inscription.index')
            ->with('message', 'La persona ya se encuentra inscrita')
            ->with('class', 'alert-error');

    }


  }

  public function show($id)
  {
    
      return "ddd";
    //$persona = Persona::with('persona_student')->find(32);//->persona_telefonos->toJson();
    //return $persona->persona_student()->first()->id;
  }

  public function edit($id)
  {

    $enrollment_repo = new EnrollmentRepository();

    // Información de la matricula
    $enrollment = $enrollment_repo->getById($id);

    if($enrollment){

        // Info of Student
        $student = Student::with('persona')->find($enrollment->cod_alumno);

        $data = compact('student', 'enrollment');

        return view('inscription.edit', $data);

    }

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

  public function thankYouPage(){

      $data = array("title" => "Gracias por Inscribirte");
      return view('inscription.thank_you', $data);

  }
}
