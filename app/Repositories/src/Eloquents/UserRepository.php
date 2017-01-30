<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 18/11/2016
 * Time: 03:49 PM
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\InterfaceRepository;
use App\User;

class UserRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }


    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){
        $find = $this->model->find($id);
        return $find;
    }

    // Find Register by Id
    public function getByIdEnrollment( $id_enrollment ){

        //return $this->model->where("id_enrollment", $id_enrollment )->first();

    }

    // Create Register
    public function create( array $attribute){

        /*$create = $this->model->create($attribute);
        return response()->json(array("data" => $create->toArray(), "message" => "Los datos de la facturación fue registrada satisfactoriamente"), 200);*/

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        /*$update = $this->model->findOrFail($id);
        $update->fill($attribute)->save();
        //$update->update($attribute);
        return response()->json(array("data" => $update->toArray(), "message" => "Los datos de la facturación fue actualizados satisfactoriamente"), 200);*/

    }

    // Delete Register by Id
    public function delete( $id ){

    }

}