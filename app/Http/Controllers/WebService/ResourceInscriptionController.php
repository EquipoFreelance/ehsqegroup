<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Http\Requests\InscriptionStoreRequest;
use App\Repositories\Eloquents\AcademicPeriodRepository;
use App\Repositories\Eloquents\EnrollmentPollRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\EspecializationTypeRepository;
use App\Repositories\Eloquents\ModalityRepository;
use App\Repositories\Eloquents\PersonRepository;
use App\Repositories\Eloquents\StudentRepository;
use Illuminate\Http\Request;
use Auth;


class ResourceInscriptionController extends Controller
{

    private $re;
    private $rs;
    private $rp;
    private $rep;
    private $rap;
    private $rmod;
    private $resp;
    private $respt;

    public function __construct(
        EnrollmentRepository $re,
        StudentRepository $rs,
        PersonRepository $rp,
        EnrollmentPollRepository $rep,
        AcademicPeriodRepository $rap,
        ModalityRepository $rmod,
        EspecializationRepository $resp,
        EspecializationTypeRepository $respt
    )
    {

        $this->re = $re;
        $this->rs = $rs;
        $this->rp = $rp;
        $this->rep = $rep;
        $this->rap = $rap;
        $this->rmod = $rmod;
        $this->resp = $resp;
        $this->respt = $respt;

    }

    /**
     * Store Inscription
     * @param InscriptionStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(InscriptionStoreRequest $request)
    {

        try {

            $num_doc = $request->get("num_doc");
            $created_by = $request->get("created_by");

            $find = $this->rp->getFindByNumDoc( $num_doc );

            if( $find ){

                /**
                 * Update Entity Person
                 */
                $store = $this->rp->getById($find->id);
                $store->fill($request->all())->save();

                /**
                 * Find Student
                 */
                $cod_persona = $store->id;
                if($cod_persona != null){

                    $student = $this->rs->getFindByCodPerson($cod_persona);
                    $id_student = $student->id;

                }


            } else {

                /**
                 * Create Entity Person
                 */
                $store = $this->rp->create( $request->all() );
                $cod_persona = $store->id;

                if($cod_persona != null){

                    /**
                     * Create new student
                     */
                    $student = $this->rs->create(array(
                        "cod_persona" => $cod_persona,
                        "cod_sede"    => "1",
                        "activo"      => "1",
                        "created_by"  => $created_by,
                    ));

                    $id_student = $student->id;

                }

            }

            // Generate the enrollment
            if($id_student != null){

                // Validate Duplicate
                $validate_duplicate = $this->re->getValidateDuplicateEnrollment(
                    $id_student,
                    $request->get("id_academic_period"),
                    $request->get("cod_modalidad"),
                    $request->get("cod_esp_tipo"),
                    $request->get("cod_esp")

                );

                if($validate_duplicate == null){

                    $new_enrollment = $this->re->create(
                        array(
                            "cod_alumno"         => $id_student,
                            "id_academic_period" => $request->get("id_academic_period"),
                            "cod_modalidad"      => $request->get("cod_modalidad"),
                            "cod_esp_tipo"       => $request->get("cod_esp_tipo"),
                            "cod_esp"            => $request->get("cod_esp"),
                            "created_by"         => $created_by,
                            "activo"             => 1
                        )
                    );

                    if($new_enrollment != null){

                        /**
                         * Create New Poll
                         */
                        $this->rep->create(
                            array(
                                "id_enrollment" => $new_enrollment->id,
                                "poll"          => $request->get("poll"),
                                "created_by"    => $created_by,
                            )
                        );

                        return response()->json(
                            [
                                "message"  => "La Inscripción se registró satisfactoriamente",
                                "alert"    => "alert-success",
                                "icon"     => "fa-check",
                                "response" => $new_enrollment,

                            ], 200 );

                    }

                } else {

                    return response()->json(
                        [
                            "message"  => "Error, la inscripción presente duplicado",
                            "alert"    => "alert-warning",
                            "icon"     => "fa-exclamation-circle",
                            "response" => null
                        ], 200 );

                }

            }



        } catch (Exception $e) {

            return Response::json(
                [
                    "message"  => "Error, en el acceso al servidor",
                    "alert"    => "alert-danger",
                    "icon"     => "fa-ban",
                    "response" => null
                ], 400 );

        }

    }



    public function update(InscriptionStoreRequest $request, $id)
    {
        try {

            return response()->json($request->all(), 200);

        } catch (Exception $e) {

            return Response::json([ 'errors' => [ ['message' => $e->getMessage()] ] ], 200);
        }
    }



    public function index(Request $request){

        $created_by = $request->get("created_by");


        if( $created_by ){

            $items = $this->re->getEnrollmentByCreatedBy($created_by, 1);

            $response = array();

            foreach ($items as $item) {

                // Find Person
                $find_enrollment = $this->re->getById($item->id);

                // Find in ref to person
                $ref_student_to_person = $find_enrollment->student->persona;

                $response[] = array(
                    "id"               => $item->id,
                    "student"          => $ref_student_to_person['FullNameUpper'],//." ".$ref_student_to_person['ape_pat']." ".$ref_student_to_person['ape_mat'],
                    "email"            => $ref_student_to_person['correo'],
                    "created_at"       => date("d-m-Y H:i:s", strtotime($item->created_at)),
                    "academic_period"  => $this->rap->getNameById($item->id_academic_period),
                    "type_specialty"   => $this->respt->getNameById($item->cod_esp_tipo),
                    "specialty"        => $this->resp->getNameById($item->cod_esp),
                    "modality"         => $this->rmod->getNameById($item->cod_modalidad)
                );

            }

        }

        return response()->json(["response" => $response], 200);

    }

}