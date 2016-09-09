<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreHoraryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cod_grupo'   => 'required',
            'cod_mod'     => 'required',
            'cod_docente' => 'required',
            'fec_inicio'  => 'required',
            'h_inicio'    => 'required',
            'fec_fin'     => 'required',
            'h_fin'       => 'required',
            'cod_dia'     => 'required',
            'num_horas'   => 'required',
            'num_taller'  => 'required',
            'activo'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cod_grupo.required'   => 'Es necesario seleccionar el Grupo',
            'cod_mod.required'     => 'Es necesario seleccionar el módulo',
            'cod_docente.required' => 'Es necesario seleccionar el docente',
            'fec_inicio.required'  => 'Es necesario ingresar la fecha de inicio',
            'h_inicio.required'    => 'Es necesario ingresar la hora de inicio',
            'fec_fin.required'     => 'Es necesario ingresar la fecha de finalización',
            'h_fin.required'       => 'Es necesario ingresar la hora de finalización',
            'cod_dia.required'     => 'Seleccione los días de la semana',
            'num_horas.required'   => 'Es necesario indicar el número de horas',
            'num_taller.required'  => 'Es necesario seleccionar el número de talleres',
            'activo.integer'       => 'Solo esta permitido que sea números enteros'
        ];
    }
}
