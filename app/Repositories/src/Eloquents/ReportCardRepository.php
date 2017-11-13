<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 18/11/2016
 * Time: 03:49 PM
 */

namespace App\Repositories\Eloquents;

use App\Models\ReportCard;
use App\Repositories\Contracts\InterfaceRepository;

class ReportCardRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new ReportCard();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){
        $find = $this->model->find($id);
        return $find->toArray();
    }

    public function getByIdEnrollmentAndByIdModule( $id_enrollment, $cod_modulo  ){
        return $this->model->where("cod_matricula", $id_enrollment)->where("cod_modulo", $cod_modulo)->get();
    }

    // Create Register
    public function create( array $attribute){

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $update = $this->model->find($id);

        $update->update($attribute);

        return $update->toArray();

    }

    // Delete Register by Id
    public function delete( $id ){

    }

}