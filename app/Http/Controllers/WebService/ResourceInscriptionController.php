<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Http\Requests\InscriptionStoreRequest;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\PersonRepository;
use App\Repositories\Eloquents\StudentRepository;
use Illuminate\Http\Request;
use Auth;


class ResourceInscriptionController extends Controller
{

    private $re;
    private $rs;
    private $rp;

    public function __construct(
        EnrollmentRepository $re,
        StudentRepository $rs,
        PersonRepository $rp
    )
    {

        $this->re = $re;
        $this->rs = $rs;
        $this->rp = $rp;

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
                        "created_by"  => Auth::user()->id,
                    ));

                    $id_student = $student->id;

                }

            }

            // Generate the enrollment
            if($id_student != null){

                // Validate Duplicate
                $validate_duplicate = $this->re->getValidateDuplicateEnrollment(
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
                            "created_by"         => Auth::user()->id,
                            "activo"             => 1
                        )
                    );

                    if($new_enrollment != null){
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

}