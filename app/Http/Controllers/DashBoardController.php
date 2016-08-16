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
        return view('dashboard.main');
    }

}
