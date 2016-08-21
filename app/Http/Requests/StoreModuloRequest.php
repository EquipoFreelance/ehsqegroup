<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreModuloRequest extends Request
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
            'nombre'        => 'required',
            'nom_corto'     => 'required',
            'cod_modalidad' => 'required',
            'cod_esp_tipo'  => 'required',
            'cod_esp'       => 'required',
            'descripcion'   => 'required',
            'num_taller'    => 'required',
            'activo'        => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'cod_modalidad.required' => 'Es necesario asignar la modalidad',
            'cod_esp_tipo.required'  => 'Es necesario asignar la tipo de especialización',
            'cod_esp.required'       => 'Es necesario asignar la especialización',
            'nombre.required'        => 'Es necesario ingresar el nombre del módulo',
            'nom_corto.required'     => 'Es necesario ingresar el nombre corto del módulo',
            'descripcion.required'   => 'Es necesario ingresar una descripción breve del módulo',
            'num_taller.required'    => 'Es necesario seleccionar el número de tallares',
            'activo.required'        => 'Es necesario indicar si el el módulo estará activo o inactivo',
            'activo.integer'         => 'Solo esta permitido que sea números enteros'
        ];
    }
    
}
