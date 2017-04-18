<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 19/11/2016
 * Time: 10:49 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\ReportCard;
use App\Repositories\Contracts\InterfaceRepository;

class CalificationRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model  = new ReportCard();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){
        return $this->model->find($id);
    }

    public function getNameById($id){
        $find = $this->getById($id);
        return $find->start_date;
    }

    public function getByIdEnrollmentByEspecialization($id_enrollment){
        return $this->model->where("cod_matricula", $id_enrollment )->get();
    }

    public function getExamByIdModule($cod_taller, $cod_modulo, $id_enrollment){
        return $this->model
            ->where("cod_taller", $cod_taller )
            ->where("cod_modulo", $cod_modulo )
            ->where("cod_matricula", $id_enrollment )

            ->first();
    }

    public function getCalificationByIdModule($cod_modulo, $id_enrollment){
        return $this->model->
                where("cod_taller", "!=", 11 )->
                where("cod_modulo", $cod_modulo )->
                where("cod_matricula", $id_enrollment )
            ->get();
    }

    // Create Register
    public function create( array $attribute){

    }

    // Update Register by Id
    public function update( $id, array $attribute){

    }

    // Delete Register by Id
    public function delete( $id ){

    }
}