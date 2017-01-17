<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\AuxiliarRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Psy\Exception\ErrorException;

class AuxiliarResource extends Controller
{
    private $rau;

    public function __construct(
        AuxiliarRepository $rau
    )
    {
        $this->rau = $rau;
    }

    public function store()
    {

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



}
