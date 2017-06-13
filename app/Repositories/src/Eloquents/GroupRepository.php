<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 19/11/2016
 * Time: 10:49 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\Grupo;
use App\Repositories\Contracts\InterfaceRepository;

class GroupRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model  = new Grupo();
    }

    // Get All Register
    public function getAll(){
        return $this->model->where("activo", 1 )->get();
    }

    // Find Register by Id
    public function getById( $id ){
        return $this->model->find($id);
    }

    public function getByIdGenerateActa($id_mod, $id_type_esp, $id_esp){

        $response = "";
        $items = $this->model
            ->where("cod_modalidad", $id_mod )
            ->where("cod_esp_tipo", $id_type_esp )
            ->where("cod_esp", $id_esp )
            ->where("activo", 1 )
            ->get();

        foreach ($items as $item) {

            $response[] = array(
                "id"        => $item->id,
                "nom_grupo" => $item->nom_grupo,
                "action"    => '<a href="/dashboard/view-acta?id_group='.$item->id.'&cod_esp='.$id_esp.'" target="_blank">Ver</a>'
            );

        }

        return $response;

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