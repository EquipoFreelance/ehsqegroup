<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 05/06/2017
 * Time: 03:26 PM
 */

namespace App\Http\Controllers;


class GenerateActaController extends Controller
{
    public function index(){
        return view('acta.index');
    }

    public function show(){
        return view('acta.show');
    }
}