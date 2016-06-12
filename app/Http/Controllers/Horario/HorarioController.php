<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;

use App\Http\Requests;
use Carbon\Carbon;

class HorarioController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
     $horarios = Horario::where("deleted", '=', 0)->get();
     return view('horario.index', array('horarios' => $horarios));
   }
   

}
