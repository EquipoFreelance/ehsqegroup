<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Auth;

class DashBoardController extends Controller
{

    // Validación de tipo de dashboard a mostrar
    public function validateDashBoard(){

      $user_info = Auth::user();
      $user_type = $user_info->id_user_type;
      return view('dashboard.dash_'.$user_type);

    }

}
