<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:48 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\EmpFraccionadoOtros;
use App\Repositories\Contracts\InterfaceRepository;

class EpmFraccionadoOtrosRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EmpFraccionadoOtros();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){

        //return $this->model->find("id", 25)->first();

    }

    /**
     * Find Register by Id
     * @param $id_epm_fra
     * @return mixed
     */
    public function getByIdEpmFra($id_epm_fra){
        return $this->model->where("id_epm_fra", $id_epm_fra)->get();
    }


    // Create Register
    public function create( array $attribute){

        $epm = $this->model->create($attribute);
        return response()->json(array("data" => $epm->toArray(), "message" => "El registro fue creado satisfactoriamente"), 200);

    }

    // Update Register by Id
    public function updateByIdEpmFra( $id_epm_fra, $id_concept, array $attribute){

        try {

            $first = $this->model->where("id_epm_fra", $id_epm_fra)->where("id_concept", $id_concept)->first();

            $epm = $this->model->find($first->id);

            if($epm){

                $epm->update($attribute);

                return response()->json(array("data" => $epm->toArray(), "message" => "El registro fue actualizado satisfactoriamente"), 200);

            }

        } catch (Exception $e) {

            return false;
        }

    }


    // Update Register by Id
    public function update( $id, array $attribute){

        $epm = $this->model->findOrFail($id);
        if($epm){
            $epm->update($attribute);
            return $epm->toArray();
        } else {
            return false;
        }

    }

    // Update Register by Id
    public function updateByIdCuotaAndIdEpm( $id_epm, $num_cuota, array $attribute){

        $epm = $this->model->where("id_epm", $id_epm )->where("num_cuota", $num_cuota)->first();
        $epm->update($attribute);
        return response()->json(array("data" => $epm->toArray(), "message" => "El detalle del medio de pago fue actualizado satisfactoriamente"), 200);

    }

    // Delete Register by Id
    public function delete( $id ){

        $epm = $this->model->findOrFail($id);
        $epm->delete();

    }

    public function deleteIdEpm($id_epm_fra){

        $epm = $this->model->where("id_epm_fra", $id_epm_fra );
        if($epm){
            $epm->delete();
        }
    }


}