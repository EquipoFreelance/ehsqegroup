<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 19/11/2016
 * Time: 10:49 AM
 */

namespace App\Repositories\Eloquents;


use App\Models\Especializacion;
use App\Repositories\Contracts\InterfaceRepository;

class EspecializationRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model  = new Especializacion();
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
        return $find->nom_esp;
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