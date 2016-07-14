<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\Administrativo;

use App\Models\Persona;

class DashBoardController extends Controller
{

    // Validación de tipo de dashboard a mostrar
    public function validateDashBoard(){

        // Secretaria Académica
        if(  Auth::user()->cod_role == 2){
          $personas = Persona::orderBy('created_at', 'desc')->get();
          $data = compact('personas');
          return view('inscription.index', $data);
        }


    }

}
