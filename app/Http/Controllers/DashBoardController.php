<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\Administrativo;
use App\Persona;
use App\User;
//use App\Models\Profile;

class DashBoardController extends Controller
{

    // Validación de tipo de dashboard a mostrar
    public function validateDashBoard(){

        // Secretaria Académica
        if($user_type == 2){

            return view('dashboard.dashboard_sa_index', $data);
        }

    }

}
