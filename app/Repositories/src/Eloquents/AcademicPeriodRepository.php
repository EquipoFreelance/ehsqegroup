<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 19/11/2016
 * Time: 10:49 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\AcademicPeriod;
use App\Repositories\Contracts\InterfaceRepository;

class AcademicPeriodRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model  = new AcademicPeriod();
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