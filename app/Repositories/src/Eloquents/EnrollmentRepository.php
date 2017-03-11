<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:43 AM
 */

namespace App\Repositories\Eloquents;


use App\Models\Enrollment;
use App\Repositories\Contracts\InterfaceRepository;

class EnrollmentRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Enrollment();
    }

    // Get All Register
    public function getAll(){

    }

    public function getEnrollmentByPeriodicAcademic(){

        //if($id_academic_period){

            $list = $this->model
                //->where("id_academic_period", $id_academic_period)
                ->where("activo", 1)
                ->orderBy('created_at', 'desc')
                ->get();
        //}

        return $list;
    }


    public function getEnrollmentByCreatedBy($created_by, $activo){

        $list = $this->model
                ->where("created_by", $created_by)
                ->where("activo", $activo)
                ->orderBy('created_at', 'desc')
                ->get();

        return $list;

    }

    public function getEnrollmentByIdStudent($id_student){

        $esp_repo = new EspecializationRepository();

        $list = $this->model
            ->where("cod_alumno", $id_student)
            ->get();

        foreach ($list as $enrollment) {
            $list_enrollment[] = array("id" => $enrollment["cod_esp"], "name" => $esp_repo->getNameById($enrollment["cod_esp"]));
        }

        return $list_enrollment;

    }

    public function getEnrollmentByCreatedByDateToDateFrom($created_by, $date_from, $date_to){
        $list = $this->model
            ->where("created_by", $created_by)
            ->where("activo", 1)
            ->whereBetween('created_at', [$date_from." 00:00:00", $date_to." 23:59:59"])

            //->where('created_at','>=','2017-01-18 00:00:00')
            //->where('created_at','<=','2017-01-18 00:00:00')

            //->whereRaw("created_at >= ? AND created_at <= ?", array('2017-01-18 00:20:15', '2017-01-18 00:20:15'))

            ->orderBy('created_at', 'desc')
            ->get();

        return $list;
    }

    /*public function getEnrollmentEspecializations($id_enrollment){

        $esp_repo = new EspecializationRepository();

        $enrollments = $this->getById(40);

        $list_enrollment = array();

        foreach ($enrollments as $enrollment) {
            print_r($enrollment->cod_esp);
            //$list_enrollment[] = $enrollment["cod_esp"];
        }

        return $list_enrollment;

    }*/



    // Find Register by Id
    public function getById( $id ){

        return $this->model->find($id);
    }

    public function getValidateDuplicateEnrollment(
        $id_student,
        $id_academic_period,
        $cod_modalidad,
        $cod_esp_tipo,
        $cod_esp
    ){
        $enrollment = $this->model
            ->where("cod_alumno", $id_student)
            ->where("id_academic_period", $id_academic_period)
            ->where("cod_modalidad", $cod_modalidad)
            ->where("cod_esp_tipo", $cod_esp_tipo)
            ->where("cod_esp", $cod_esp)
            ->first();

        return $enrollment;
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

    }

    // Delete Register by Id
    public function delete( $id ){

    }



}