<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 19/11/2016
 * Time: 10:49 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\GroupTeacher;
use App\Repositories\Contracts\InterfaceRepository;

class GroupTeacherRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model  = new GroupTeacher();
    }

    // Get All Register
    public function getAll(){
        return $this->model->where("activo", 1 )->get();
    }

    // Find Register by IdGroup
    public function getById( $id ){

        //return $this->model->where("id_group", $id_group )->get();

    }

    // Find Register by IdGroup
    public function getByIdGroup( $id_group ){

        return $this->model->where("id_group", $id_group )->get();

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