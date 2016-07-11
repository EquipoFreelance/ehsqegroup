<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Departament;

use App\Models\Province;

use App\Models\District;

class WebServiceController extends Controller
{

    public function wsDepartaments($cod_pais)
    {
      return $departament = Departament::where(compact('cod_pais'))->select('nom_dpto as name', 'id')->get()->toJson();
    }

    public function wsProvinces($cod_dpto)
    {
      return $provinces = Province::where(compact('cod_dpto'))->select('nom_prov as name', 'id')->get()->toJson();
    }

    public function wsDistricts($cod_dpto, $cod_prov)
    {
      return $district = District::where(compact('cod_dpto','cod_prov'))->select('nom_dist as name', 'id')->get()->toJson();
    }

}
