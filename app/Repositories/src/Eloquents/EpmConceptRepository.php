<?php
namespace App\Repositories\Eloquents;

use App\Models\EpmConcept;
use App\Models\PaymentConceptType;
use App\Repositories\Contracts\InterfaceRepository;
use Auth;
use Carbon\Carbon;

class EpmConceptRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EpmConcept();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){

        return $this->model->find($id)->first();

    }

    public function getByIdEpm($id_epm){
        return $this->model->where("id_epm", $id_epm )->where("active", 1 )->get();
    }

    public function getByIdEpmTotalMount($id_epm){

        $find_concepts = $this->model->where("id_epm", $id_epm )->where("active", 1 )->where("verified", 1)->get();

        $amount = 0;

        if($find_concepts){
            foreach ($find_concepts as $concept) {

                $amount = $amount + $concept['amount'];

            }
        }
        if($amount == 0){
            return "";
        }
        return $amount;

    }

    // Find Register by Id
    public function getByIdEpmByIdConcept( $id_epm, $id_concept ){

        return $this->model->where("id_epm", $id_epm )->where("id_concept", $id_concept )->first();

    }

    public function deleteByIdEpmByIdConcept( $id_epm, array $id_concepts ){
        return $this->model->where("id_epm", $id_epm )->whereIn('id_concept', $id_concepts)->delete();
    }
    
    // Create Register
    public function create( array $attribute){

        $create = $this->model->create($attribute);
        return $create->toArray();

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $update = $this->model->find($id);
        $update->verified_at = Carbon::now();
        $update->verified_by = \Auth::user()->id;
        $update->update($attribute);

        return $update->toArray();

    }


    // Delete Register by Id
    public function delete( $id ){

    }
}