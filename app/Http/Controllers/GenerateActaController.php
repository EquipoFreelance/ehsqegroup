<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 05/06/2017
 * Time: 03:26 PM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class GenerateActaController extends Controller
{
    public function index(){
        return view('acta.index');
    }

    public function show(Request $request){

        $id_group = $request->get("id_group");

        $cod_esp  = $request->get("cod_esp");

        return view('acta.show', compact('id_group', 'cod_esp'));
    }
}