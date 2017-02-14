<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 29/01/2017
 * Time: 02:00 PM
 */

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\AcademicPeriodRepository;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EpmConceptRepository;
use App\Repositories\Eloquents\EpmCondicionalRepository;
use App\Repositories\Eloquents\EpmFraccionadoOtrosRepository;
use App\Repositories\Eloquents\EpmFraccionadoRepository;
use App\Repositories\Eloquents\EpmTotalRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\EspecializationTypeRepository;
use App\Repositories\Eloquents\EnrollmentBillingClientRepository;
use App\Repositories\Eloquents\ModalityRepository;
use App\Repositories\Eloquents\PaymentTypeRepository;
use App\Repositories\Eloquents\UserRepository;
use Illuminate\Http\Request;



class ContabilidadResource extends Controller
{
    private $rep;
    private $rmod;
    private $resp;
    private $respt;
    private $rap;
    private $rebr;
    private $epmr;
    private $rpt;
    private $ruser;
    private $rempt;
    private $repmf;
    private $repmc;
    private $repmfo;
    private $rconcept;

    public function __construct(
        EnrollmentRepository $rep,
        ModalityRepository $rmod,
        EspecializationRepository $resp,
        EspecializationTypeRepository $respt,
        AcademicPeriodRepository $rap,
        EnrollmentBillingClientRepository $rebr,
        EnrollmentPMRepository $epmr,
        PaymentTypeRepository $rpt,
        UserRepository $ruser,
        EpmTotalRepository $rempt,
        EpmFraccionadoRepository $repmf,
        EpmCondicionalRepository $repmc,
        EpmFraccionadoOtrosRepository $repmfo,
        EpmConceptRepository $rconcept
    )
    {
        $this->rep   = $rep;
        $this->resp  = $resp;
        $this->respt = $respt;
        $this->rmod  = $rmod;
        $this->rap   = $rap;
        $this->rebr  = $rebr;
        $this->epmr  = $epmr;
        $this->rpt   = $rpt;
        $this->ruser = $ruser;
        $this->rempt = $rempt;
        $this->repmf = $repmf;
        $this->repmc = $repmc;
        $this->repmfo = $repmfo;
        $this->rconcept = $rconcept;

    }

    public function index(Request $request){

        $q = $request->get("q");
        $idx = 0;
        $response = array();

        if($q == "ALL"){

            $items = $this->rep->getEnrollmentByPeriodicAcademic();

            foreach ($items as $item) {

                $idx = $idx + 1;

                $cuota_monto      = "";
                $cuota_num_cuotas = "";
                $ruc              = "";
                $razon_social     = "";
                $matricula        = "";
                $certificado      = "";
                $contado          = "";

                // Find Person
                $find_enrollment = $this->rep->getById($item->id);

                // Find Billing Client
                $find_billing_client = $this->rebr->getByIdEnrollment($item->id);

                if($find_billing_client){

                    $ruc            = $find_billing_client->ruc;
                    $razon_social   = $find_billing_client->razon_social;


                } else {

                    $ruc           = "";
                    $razon_social   = "";

                }

                $typeDocPyament = $this->rebr->getValidateTypeDoc($ruc);

                // Find in ref to person
                $person = $find_enrollment->student->persona;

                // Find Enrollment Payment
                $find_epm = $this->epmr->getByIdEnrollment($item->id);

                if($find_epm){

                    $idformaDePago = $find_epm->id_payment_method;

                    $formaDePagoName = $this->rpt->getNameById($idformaDePago);


                    // Al contado
                    $contado = "";

                    if( $idformaDePago == 1){

                        $contado = "";

                        $find_contado = $this->rempt->getByIdEpm($find_epm->id);

                        if($find_contado){


                            $find_rconcept_3 = $this->rconcept->getByIdEpmByIdConcept($find_epm->id, 9);

                            if( $find_rconcept_3['verified'] == 1){

                                $contado = '<span style="border: 1px green solid;background-color: green;padding: 10px;color: #FFFFFF;font-weight: bold;">'.$find_contado->amount.'</span>';

                            } else {

                                $contado = $find_contado->amount;
                            }

                           /*if($find_contado->verified == 1){

                                $contado = '<span style="border: 1px green solid;background-color: green;padding: 10px;color: #FFFFFF;font-weight: bold;">'.$find_contado->amount.'<span></span></span>';

                            } else {

                                $contado = $find_contado->amount;

                            }*/



                        }

                    // Fraccionado
                    } else if( $idformaDePago == 2){

                        $find_repmf = $this->repmf->getByIdEpm($find_epm->id);

                        if($find_repmf){


                            $find_rconcept = $this->rconcept->getByIdEpmByIdConcept($find_epm->id, 3);

                            if( $find_rconcept['verified'] == 1){

                                $cuota_monto = '<span style="border: 1px green solid;background-color: green;padding: 10px;color: #FFFFFF;font-weight: bold;">'.$find_repmf->amount.'</span>';

                            } else {

                                $cuota_monto = $find_repmf->amount;
                            }

                            $cuota_num_cuotas = $find_repmf->num_cuota;

                            // Otros conceptos dentro del la forma de pago fraccionado

                            // Matricula
                            $matricula = "";

                            $find_repmfo = $this->repmfo->getByEpmFraByConcept($find_repmf->id, 1);

                            if($find_repmfo){


                                $find_rconcept_1 = $this->rconcept->getByIdEpmByIdConcept($find_epm->id, 1);

                                if( $find_rconcept_1['verified'] == 1){

                                    $matricula = '<span style="border: 1px green solid;background-color: green;padding: 10px;color: #FFFFFF;font-weight: bold;">'.$find_repmfo->amount.'</span>';

                                } else {

                                    $matricula = $find_repmf->amount;
                                }


                            }

                            // Certificado
                            $certificado = "";


                            $find_repmfo = $this->repmfo->getByEpmFraByConcept($find_repmf->id, 2);

                            if($find_repmfo){
                                $certificado = $find_repmfo->amount;
                            }



                        }else{

                            $cuota_monto      = "";
                            $cuota_num_cuotas = "";
                        }

                    // Condicional
                    } else if( $idformaDePago == 3){

                        $find_repmc = $this->repmc->getByIdEpmFirst($find_epm->id);

                        if($find_repmc){

                            //$cuota_monto      = $find_repmc->amount;

                            $find_rconcept_2 = $this->rconcept->getByIdEpmByIdConcept($find_epm->id, 3);

                            if( $find_rconcept_2['verified'] == 1){

                                $cuota_monto = '<span style="border: 1px green solid;background-color: green;padding: 10px;color: #FFFFFF;font-weight: bold;">'.$find_repmc->amount.'</span>';

                            } else {

                                $cuota_monto = $find_repmc->amount;
                            }

                            $cuota_num_cuotas = $this->repmc->getByIdEpmTotalCuota($find_repmc->id);

                        }else{

                            $cuota_monto      = "";
                            $cuota_num_cuotas = "";
                        }

                    }

                } else {

                    $formaDePagoName = "";

                }

                // Find Created By
                $find_user = $this->ruser->getById($find_enrollment->created_by);

                if( $find_user ) {

                    $createdByName = $find_user->fullname;

                } else {

                    $createdByName =  "";
                }



                if( $item->id_academic_period == 9 ){

                    $periodAcademic = $item->creation_date;

                } else{

                    $periodAcademic = $this->rap->getNameById($item->id_academic_period);

                }

                $response[] = array(
                  "idx"                 => $idx,
                  "creationDate"        => date("d/m/Y", strtotime($find_enrollment->created_at) ),
                  "businessExecutive"   => $createdByName,
                  "firstName"           => $person['NombreUpper'],
                  "lastName"            => $person['ApellidosUpper'],
                  "dni"                 => $person['num_doc'],
                  "email"               => $person['correo'],
                  "cellphone"           => $person['num_cellphone'],
                  "typeDocPyament"      => $typeDocPyament,
                  "ruc"                 => $ruc,
                  "empresa"             => $razon_social,
                  "modality"            => $this->rmod->getNameById($item->cod_modalidad),
                  "type_specialty"      => $this->respt->getNameById($item->cod_esp_tipo),
                  "specialty"           => $this->resp->getNameById($item->cod_esp),
                  "periodAcademic"      => $periodAcademic,
                  "formaDePago"         => $formaDePagoName,
                  "contado"             => $contado,
                  "cuota1"              => $cuota_monto,
                  "matricula"           => $matricula,
                  "certificado"         => $certificado,
                  "numCuotas"           => $cuota_num_cuotas,
                  "button_verify_payment" => '<a href="../creditos/verify-payment/'.$find_enrollment->id.'/show" class="btn btn-5 btn-5a icon-edit edit"><span>Validar Pagos</span></a>',
                  "button_edit_ficha"     => '<a href="../creditos/verify-payment/'.$find_enrollment->id.'/show" class="btn btn-5 btn-5a icon-edit edit"><span>Validar Pagos</span></a>'
                );
            }

            return response()->json(
                [
                    "data" => $response

                ], 200 );

        }

    }

}