<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Horario;
use App\Models\Sede;

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
     //$horarios = Horario::where("deleted", '=', 0)->get();
     //return view('horario.index', array('horarios' => $horarios));
     return "Listado de horarios";
   }

   public function getHorarioList($id)
   {
     $data = compact('id');
     return view('horario.index', $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
     $data = [
           'sedes' => Sede::lists('nom_sede', 'id'),                     // Listado de Sedes
         ];
        return view('horario.create', $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function getCreateHorario($id)
   {
     Grupo::
     $data = compact('id');
     //$sedes = Sede::lists('nom_sede', 'id');
     //$data = compact('cod_mod','cod_esp_tipo','cod_esp','sedes');
     return view('horario.create', $data);
   }


}
