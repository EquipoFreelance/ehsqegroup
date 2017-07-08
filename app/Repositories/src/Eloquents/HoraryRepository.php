<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 19/11/2016
 * Time: 10:49 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\Horario;
use App\Repositories\Contracts\InterfaceRepository;

class HoraryRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model  = new Horario();
    }

    // Get All Register
    public function getAll(){
        return $this->model->where("activo", 1 )->get();
    }

    // Find Register by IdGroup
    public function getById( $id ){
        return $this->model->find($id);
    }

    public function getIdModByIdGroupAndByIdTeacher($id_group, $id_teacher){
        return $this->model->where("cod_grupo", $id_group )->where("cod_docente", $id_teacher )->first();
    }

    public function getIdByGroup($id_group){
        return $this->model->where("cod_grupo", $id_group)->first();
    }

    public function getIdByModule($cod_module){
        return $this->model->where("cod_mod", $cod_module)->first();
    }

    public function getDayWeek($index){
        $week = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        return $week[$index];
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