<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:43 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\Auxiliar;
use App\Repositories\Contracts\InterfaceRepository;

class AuxiliarRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Auxiliar();
    }

    // Get All Register
    public function getAll(){

        $list = $this->model->where("activo", 1)->get();

        return $list;

    }

    public function getEnrollmentByCreatedBy($created_by, $activo){

        $list = $this->model->where("created_by", $created_by)->where("activo", $activo)->get();

        return $list;

    }

    // Find Register by Id
    public function getById( $id ){

        return $this->model->find($id);
    }

    /**
     * @param $num_doc
     * @return mixed
     */
    public function getFindByNumDoc( $num_doc ){

        return $this->model->where("num_doc", $num_doc)->first();

    }


    public function getInfoEnrollment($id_enrollment){

        $esp_repo = new EspecializationRepository();
        $mod_repo = new ModalityRepository();
        $ap_repo  = new AcademicPeriodRepository();

        $enrollment     = $this->getById($id_enrollment);
        $ref_enrollment = $enrollment->student->persona;

        $created_at = strtotime( $enrollment->created_at );
        $created_at = date( 'Y-m-d H:i:s', $created_at );

        return array(
                'student'    => $ref_enrollment['nombre']." ".$ref_enrollment['ape_pat']." ".$ref_enrollment['ape_mat'],
                'enrollment' => array(
                    'modality'        => $mod_repo->getNameById($enrollment->cod_modalidad),
                    'especialization' => $esp_repo->getNameById($enrollment->cod_esp),
                    'period_academy'  => $ap_repo->getNameById($enrollment->id_academic_period),
                    'created_at'      => $created_at
                )
        );
    }

    // Create Register
    public function create( array $attribute){

        return $this->model->create($attribute);

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $update = $this->model->findOrFail($id);

        $update->fill($attribute)->save();

        return $update->toArray();

    }

    // Delete Register by Id
    public function delete( $id ){

    }



}