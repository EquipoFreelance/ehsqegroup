<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repositories\Eloquents\AcademicPeriodRepository;
use App\Repositories\Eloquents\EbcRepository;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EpmBecadoRepository;
use App\Repositories\Eloquents\EpmCondicionalRepository;
use App\Repositories\Eloquents\EpmFraccionadoRepository;
use App\Repositories\Eloquents\EpmTotalRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\ModalityRepository;
use App\Repositories\Eloquents\PersonRepository;
use App\Repositories\Eloquents\StudentRepository;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class WSInscriptionController extends Controller
{

    private $e_repo = '';
    private $s_repo = '';
    private $p_repo   = '';
    private $esp_repo = '';
    private $m_repo = '';
    private $ap_repo = '';

    function __construct(
        StudentRepository $s_repo
    )
    {
        $this->e_repo = new EnrollmentRepository();
        $this->s_repo = $s_repo;
        $this->p_repo = new PersonRepository();
        $this->esp_repo = new EspecializationRepository();
        $this->m_repo = new ModalityRepository();
        $this->ap_repo = new AcademicPeriodRepository();

    }

    /**
     * Muestra el detalle de la matricula con la inscripción
     * @param $id_enrollment
     * @return \Illuminate\Http\JsonResponse
     */
    public function showInscription($id_enrollment){

        $epm_repo = new EnrollmentPMRepository();
        $ebc_repo = new EbcRepository();

        $ebc_merge = '';
        $epm_merge = '';

        // Forma de Pago
        $epm = $epm_repo->getByIdEnrollment($id_enrollment);

        if($epm){

            // Pago Total
            if($epm->id_payment_method == 1){
                $epm_type = new EpmTotalRepository();

            // Pago Fraccionado
            } else if ($epm->id_payment_method == 2){
                $epm_type = new EpmFraccionadoRepository();

            // Pago Condicional
            } else if ($epm->id_payment_method == 3){
                $epm_type = new EpmCondicionalRepository();

            // Becado
            } else if($epm->id_payment_method == 4){

                $epm_type = new EpmBecadoRepository();
            }

            $epm->form_pago_detalle = $epm_type->getByIdEpm($epm->id);

            $epm_merge = array('forma_pago' => $epm->toArray());

        }

        // Datos de la facturación
        $ebc = $ebc_repo->getByIdEnrollment($id_enrollment);
        if($ebc){

            $ebc_merge = array('billing_client' => $ebc_repo->getById($ebc->id));

        }

        if($ebc_merge == '' && $epm_merge == '') {

            $response = '';

        }else if($ebc_merge != '' && $epm_merge == ''){

            $response = $ebc_merge;

        }else if($epm_merge != '' && $ebc_merge == ''){

            $response = $epm_merge;

        }else{

            $response = array_merge($epm_merge, $ebc_merge);
        }


        return response()->json($response, 200);

    }

    /**
     * Registra o actualiza los datos de la forma de pago
     * storePaymentMethod
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePaymentMethod(Request $request){

        try {

            $epm_repo = new EnrollmentPMRepository();

            // Buscar forma de pago
            $epm = $epm_repo->getByIdEnrollment($request->get("id_enrollment"));

            // Si Existe el registro, actualizamos
            if($epm){

                $action = $epm_repo->update($epm->id, $request->toArray());

            // Registramos por primera vez
            } else {

                $action = $epm_repo->create($request->toArray());
            }

            return $action;


        } catch (Exception $e) {

            return response()->json(array("data" => $e->getMessage()), 400);
        }

    }

    /**
     * Registra y actualiza los datos de la facturación
     * storeBillingClient
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBillingClient(Request $request){

        $ebc_repo = new EbcRepository();

        // Prepare request
        $p_request = array(
            "id_enrollment"     => $request->get("id_enrollment"),
            "razon_social"      => $request->get("billing_razon_social"),
            "ruc"               => $request->get("billing_ruc"),
            "phone"             => $request->get("billing_phone"),
            "address"           => $request->get("billing_address"),
            "client_firstname"  => $request->get("billing_client_firstname"),
            "client_lastname"   => $request->get("billing_client_lastname")
        );

        $ebc = $ebc_repo->getByIdEnrollment($request->get("id_enrollment"));

        if(!$ebc){

            $action = $ebc_repo->create($p_request);

        } else {

            $action = $ebc_repo->update($ebc->id, $p_request);
        }

        return $action;

    }


    /**
     * Information of inscriptions by the param of created_by
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInscriptionsByCreatedBy(Request $request){

        $list     = '';
        $response = '';

        $validator = Validator::make($request->all(), [
            'created_by'          => 'required',
        ], [
            "created_by.required" => "Es necesario colocar el identificado del creador del registro"
        ]);

        if ( $validator->fails() ){

            return response()->json($list, 404);

        } else {

            $created_by = $request->get('created_by');
            $list = $this->e_repo->getEnrollmentByCreatedBy($created_by, 1);

            if($list){

                foreach ($list as $item) {

                    $student         = $this->s_repo->getById($item->cod_alumno);
                    $person          = $this->p_repo->getById($student->cod_persona);
                    $enrollment      = $this->e_repo->getById($item->id);
                    $especialization = $this->esp_repo->getById($enrollment->cod_esp);
                    $modality        = $this->m_repo->getById($enrollment->cod_modalidad);
                    $academic_period = $this->ap_repo->getById($enrollment->id_academic_period);

                    $response[] = array(
                        "id" => $item->cod_alumno, // Id de la matricula,
                        "student" => array(
                            "firtname"     => $person->nombre,
                            "lastname_pat" => $person->ape_pat,
                            "lastname_mat" => $person->ape_mat,
                            "email"        => $person->correo
                        ),
                            "modality"       => $modality->nom_mod,
                            "especialization" => $especialization->nom_esp,
                            "period_academic" => $academic_period->start_date,
                            "created_at"      => date("d/m/Y H:i:s", strtotime($item->created_at))
                    );

                }

                if(!$response){
                    return response()->json("", 200);
                }

                return response()->json(array("response" => $response), 200);

            }




        }

    }
}
