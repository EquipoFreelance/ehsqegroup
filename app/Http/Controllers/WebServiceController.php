<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Departament;

use App\Models\Province;

use App\Models\District;

use App\Models\EspecializacionTipo;

use App\Models\Especializacion;

use App\Models\Modalidad;

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

    public function wsEspecializacionTipos()
    {
      return $tipos_esp = EspecializacionTipo::select('nom_esp_tipo as name', 'id')->get()->toJson();
    }

    public function wsEspecializaciones($cod_esp_tipo)
    {
      return $especializaciones = Especializacion::where(compact('cod_esp_tipo'))->select('nom_esp as name', 'id')->get()->toJson();
    }

    public function wsModalidades()
    {
      return $modalidades = Modalidad::select('nom_mod as name', 'id')->get()->toJson();
    }

}
