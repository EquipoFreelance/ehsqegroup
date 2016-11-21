<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:48 AM
 */

namespace App\Repositories\Eloquents;


use App\EmpBecado;
use App\Repositories\Contracts\InterfaceRepository;

class EpmBecadoRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EmpBecado();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){

        return $this->model->find("id", 25)->first();

    }

    // Find Register by Id
    public function getByIdEpm( $id_epm ){

        return $this->model->where("id_epm", $id_epm )->first();

    }
    // Create Register
    public function create( array $attribute){

        $epm = $this->model->create($attribute);
        return $epm->toArray();

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $epm = $this->model->find($id);
        if($epm){
            $epm->update($attribute);
            return $epm->toArray();
        } else {
            return false;
        }

    }


    // Delete Register by Id
    public function delete( $id ){

        $epm = $this->model->findOrFail($id);
        $epm->delete();

    }

    public function deleteIdEpm($id_epm){
        $epm = $this->model->where("id_epm", $id_epm );
        if($epm){
            return $epm->delete();
        }
    }

}