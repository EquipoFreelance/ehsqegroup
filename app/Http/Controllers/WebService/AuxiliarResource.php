<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\AuxiliarRepository;
use App\Repositories\Eloquents\PersonRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Psy\Exception\ErrorException;

class AuxiliarResource extends Controller
{
    private $rau;
    private $rpe;

    public function __construct(
        AuxiliarRepository $rau,
        PersonRepository $rpe
    )
    {

        $this->rau = $rau;
        $this->rpe = $rpe;

    }

    public function store( Request $request )
    {

        // Add Person
        $create_person = $this->rpe->create(
            array(
                "num_doc"     => $request->get("num_doc"),
                "cod_doc_tip" => $request->get("cod_doc_tip"),
                "nombre"      => $request->get("nombre"),
                "ape_pat"     => $request->get("ape_pat"),
                "ape_mat"     => $request->get("ape_mat")
            )
        );

        if($create_person){

            $create_auxiliar = $this->rau->create(
                array(
                    "cod_persona" => $create_person->id,
                    "activo"      => "1"
                )
            );

            if($create_auxiliar){

                return response()->json(
                    [
                        "message"  => "La Inscripción se registró satisfactoriamente",
                        "alert"    => "alert-success",
                        "icon"     => "fa-check",
                        "response" => $create_auxiliar,

                    ], 200 );


            }

        }

    }

    public function index(Request $request)
    {
        try{

            $response = "";

            $q = $request->get("q");

            if($q == "all"){


                $items = $this->rau->getAll();

                foreach ($items as $item) {

                    // Find Person
                    $find_auxiliar = $this->rau->getById($item->id);

                    // Find in ref to person
                    $ref_auxiliar_to_person = $find_auxiliar->persona;

                    $response[] = array(
                        "id"               => $item->id,
                        "auxiliar"          => $ref_auxiliar_to_person['FullNameUpper']
                    );

                }

            }

            return response()->json(["response" => $response], 200);

        } catch(ErrorException $e){

            return response()->json(["response" => "error"], 400);

        }


    }

    public function update(Request $request, $id){

        $update = $this->rpe->update($id,
            array(
            "num_doc"     => $request->get("num_doc"),
            "cod_doc_tip" => $request->get("cod_doc_tip"),
            "nombre"      => $request->get("nombre"),
            "ape_pat"     => $request->get("ape_pat"),
            "ape_mat"     => $request->get("ape_mat")
        ));

        if($update){

            return response()->json(
                [
                    "message"  => "La Inscripción se actualizó satisfactoriamente",
                    "alert"    => "alert-success",
                    "icon"     => "fa-check",
                    "response" => $update,

                ], 200 );

        }

    }

}
