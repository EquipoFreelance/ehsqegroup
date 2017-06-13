<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 06/06/2017
 * Time: 10:01 PM
 */

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\EspecializationTypeRepository;
use Illuminate\Http\Request;


class TypeEspecializationResource extends Controller
{
    private $rep_type_esp;

    public function __construct(EspecializationTypeRepository $rep_type_esp)
    {
        $this->rep_type_esp = $rep_type_esp;
    }

    public function index(Request $request){

        return response()->json(
            [
                "response" =>  $this->rep_type_esp->getAll(),
            ], 200 );

    }
}