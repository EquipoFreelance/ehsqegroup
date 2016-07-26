<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\Administrativo;
use App\Models\Persona;

class DashBoardController extends Controller
{

    // Validación de tipo de dashboard a mostrar
    public function validateDashBoard(Request $request){

        $user_role = Auth::user()->cod_role;

        switch ($user_role) {

          // Secretaria Académica
          case 2:

            $data = array(
                'title' => 'Dashboard - Sistema Académico',
                'menu'  => 'menu_sistema_academico'
            );

            break;

          // Marketing
          case 6:

            $data = array(
                'title' => 'Dashboard - Marketing',
                'menu'  => 'menu_marketing'
            );

            break;

          default:
            # code...
            break;
        }

        Session::push('menu.dashboard', $data);
        return view('dashboard.main', $data);

    }

}
