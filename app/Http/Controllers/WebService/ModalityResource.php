<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 06/06/2017
 * Time: 10:11 PM
 */

namespace App\Http\Controllers\WebService;


use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\ModalityRepository;
use Illuminate\Http\Request;

class ModalityResource extends Controller
{
    private $rep_mod;


    public function __construct(ModalityRepository $rep_mod)
    {
        $this->rep_mod = $rep_mod;
    }

    public function index(Request $request){

        return response()->json(
            [
                "response" =>  $this->rep_mod->getAll(),
            ], 200 );

    }
}