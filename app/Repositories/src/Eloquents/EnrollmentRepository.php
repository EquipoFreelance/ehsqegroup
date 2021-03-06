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

    // Find Register by Id
    public function getById( $id ){

        return $this->model->find($id);
    }

    public function getEnrollmentByStudent($id_student){

        $list = $this->model
            ->where("cod_alumno", $id_student)
            ->where("activo", 1)->get();

        return $list;

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

    public function getGroupStudentEnrollment($ge){

        return $this->model->select("cod_alumno", "id")->whereIn('id', $ge)->get();

    }

    /***
     * @param $id_group
     * @param $id_academic_period
     * @param $id_tipo_esp
     * @param $id_esp
     * @param $id_module
     */
    public function getFilterEnrollments($id_group, $id_academic_period, $id_tipo_esp, $id_esp, $id_module){

        // Obtenemos el id del grupo
        $group = $this->model
            ->where('id', $id_group)->get();
            //->where('id_academic_period', $id_academic_period)->first();

        // Obtenemos la lista de matriculados

        // Obtenemos el detalle de las matriculas

        // Del detalle de matricula obtenemos
            // Código del tipo de la especialización
            // Código de la especialización

        // Aqui debemos realizar un filtro de modulos

        // Con los códigos realizamos un filtro para obtener el codigo el modulo para
        // filtrar las matriculas



        return $group;

    }

}