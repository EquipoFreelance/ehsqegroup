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
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\PaymentTypeRepository;
use App\Repositories\Eloquents\EpmConceptRepository;
use Illuminate\Http\Request;
use Auth;


class InscriptionResource extends Controller
{

    private $re;
    private $rs;
    private $rp;
    private $rep;
    private $rap;
    private $rmod;
    private $resp;
    private $respt;
    private $remp;
    private $rmp;
    private $rec;

    public function __construct(
        EnrollmentRepository $re,
        StudentRepository $rs,
        PersonRepository $rp,
        EnrollmentPollRepository $rep,
        AcademicPeriodRepository $rap,
        ModalityRepository $rmod,
        EspecializationRepository $resp,
        EspecializationTypeRepository $respt,
        EnrollmentPMRepository $remp,
        PaymentTypeRepository $rmp,
        EpmConceptRepository $rec
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
        $this->remp = $remp;
        $this->rmp = $rmp;
        $this->rec = $rec;

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
                        "cod_sede"    => "4",
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
                            "creation_date"      => $request->get("id_academic_period_txt"),
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
        $date_from  = $request->get("date_from");
        $date_to    = $request->get("date_to");

        $n = 0;

        if( $created_by && !$date_from  && !$date_to){

            $items = $this->re->getEnrollmentByCreatedBy($created_by, 1);

        } else if($created_by && $date_from  && $date_to){

            $items = $this->re->getEnrollmentByCreatedByDateToDateFrom($created_by, $date_from, $date_to);
        }


        $response = array();

        foreach ($items as $item) {

            $n = $n + 1;

            // Find Person
            $find_enrollment = $this->re->getById($item->id);

            // Find in ref to person
            $ref_student_to_person = $find_enrollment->student->persona;

            $periodAcademic = 0;

            if( $item->id_academic_period == 9 ){

                $periodAcademic = $item->creation_date;

            } else{

                $periodAcademic = $this->rap->getNameById($item->id_academic_period);

            }

            // Find Enrollment Payment Method
            $find_epm = $this->remp->getByIdEnrollment($item->id);

            // Fin Name Method Type
            $find_payment_type_name = "";

            $find_concept_amount = "";

            if($find_epm){

                $find_pm = $this->rmp->getById($find_epm['id_payment_method']);

                $find_payment_type_name = $find_pm['payment_type_name'];

                $find_concept_amount = $this->rec->getByIdEpmTotalMount($find_epm['id']);;

            }

            // Find Comercial
            $find_comercial = $this->rp->getById($item->created_by);

            $response[] = array(
                "idx"             => $n,
                "createdAt"       => date("d-m-Y H:i:s", strtotime($item->created_at)),
                "createdBy"       => $find_comercial->NombreUpper." ".$find_comercial->ApellidosUpper,
                "periodAcademic"  => $periodAcademic,
                "dni"             => $ref_student_to_person['num_doc'],
                "firstName"       => $ref_student_to_person['NombreUpper'],
                "lastName"        => $ref_student_to_person['ApellidosUpper'],
                "phoneNumber"     => $ref_student_to_person['num_cellphone'],
                "modality"        => $this->rmod->getNameById($item->cod_modalidad),
                "typeSpecialty"   => $this->respt->getNameById($item->cod_esp_tipo),
                "specialty"       => $this->resp->getNameById($item->cod_esp),
                "formaPago"        => $find_payment_type_name,
                "IngresoEfectibvo" => $find_concept_amount,
                "buttonEditar"     => '<a href="inscription/'.$item->id.'/edit" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a>',
            );

        }


        return response()->json(
            [
                "data" => $response

            ], 200 );

    }

}