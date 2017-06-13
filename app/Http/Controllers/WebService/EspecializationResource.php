<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 06/06/2017
 * Time: 09:56 PM
 */

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\EspecializationRepository;
use Illuminate\Http\Request;

class EspecializationResource extends Controller
{
    private $rep_esp;

    public function __construct(EspecializationRepository $rep_esp)
    {
        $this->rep_esp = $rep_esp;
    }

    public function index(Request $request){

        if( $request->get("id_mod") && $request->get("id_type_esp") ){

            return response()->json(
                [
                    "response" =>  $this->rep_esp->getByIdModAndIdTypeEsp($request->get("id_mod"), $request->get("id_type_esp")),
                ], 200 );

        }

    }

}