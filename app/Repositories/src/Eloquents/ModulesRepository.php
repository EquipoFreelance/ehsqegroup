<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 19/11/2016
 * Time: 10:49 AM
 */

namespace App\Repositories\Eloquents;


use App\Models\Modulo;
use App\Repositories\Contracts\InterfaceRepository;

class ModuleRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model  = new Modulo();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){
        return $this->model->find($id);
    }

    public function getModuleByIdEspecialization($id_esp){
        return $this->model->where("cod_esp", $id_esp )->get();
    }

    public function getNameById($id){
        $find = $this->getById($id);
        return $find->nombre;
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