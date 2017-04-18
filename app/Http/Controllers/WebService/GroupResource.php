<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\AuxiliarRepository;
use App\Repositories\Eloquents\GroupRepository;
use App\Repositories\Eloquents\PersonRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Psy\Exception\ErrorException;

class GroupResource extends Controller
{
    private $rgroup;

    public function __construct(
        GroupRepository $rgroup
    )
    {
        $this->rgroup = $rgroup;
    }

    public function index(Request $request)
    {
        try{

            $response = "";

            $q = $request->get("q");

            if($q == "ALL"){

                $items = $this->rgroup->getAll();

                foreach ($items as $item) {

                    $response[] = array(
                        "id"        => $item->id,
                        "nom_grupo" => $item->nom_grupo
                    );

                }

            }

            return response()->json(["response" => $response], 200);

        } catch(ErrorException $e){

            return response()->json(["response" => "error"], 400);

        }


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
                        "message"  => "El auxiliar se registró satisfactoriamente",
                        "alert"    => "alert-success",
                        "icon"     => "fa-check",
                        "response" => $create_auxiliar,

                    ], 200 );


            }

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
                    "message"  => "El auxiliar se actualizó satisfactoriamente",
                    "alert"    => "alert-success",
                    "icon"     => "fa-check",
                    "response" => $update,

                ], 200 );

        }

    }

}
