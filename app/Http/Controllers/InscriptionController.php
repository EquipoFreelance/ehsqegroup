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
    /**
     * Reports
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        $v = Validator::make($request->all(), [
            'created_by' => 'required'
        ]);

        if ($v->fails()) {
            return "Error";
        }

        $data = array("title" => "Ficha de inscripci��n", "created_by" => $request->get("created_by"));
        return view('inscription.create_public', $data);

    }

    public function store(InscriptionStoreRequest $request) {


        return "true";

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

    /**
     * Vista de la ficha de la matricula para contabilidad
     */
    public function viewEnrollmentContabilidad($id_enrollment){

        $enrollment_repo = new EnrollmentRepository();

        // Información de la matricula
        $enrollment = $enrollment_repo->getById($id_enrollment);

        if($enrollment){

            // Info of Student
            $student = Student::with('persona')->find($enrollment->cod_alumno);

            $data = compact('student', 'enrollment');

            return view('inscription.view_contabilidad', $data);

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

}
