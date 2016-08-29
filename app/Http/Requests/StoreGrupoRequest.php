<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreGrupoRequest extends Request
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
            'cod_modalidad' => 'required',
            'cod_esp_tipo'  => 'required',
            'cod_esp'       => 'required',
            'nom_grupo'     => 'required',
            'cod_sede'      => 'required',
            'descripcion'   => 'required',
            'fe_inicio'     => 'required',
            'fe_fin'        => 'required',
            'num_min'       => 'required',
            'num_max'       => 'required',
            'activo'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cod_modalidad.required' => 'Es necesario seleccionar la modalidad ',
            'cod_esp_tipo.required'  => 'Es necesario seleccionar el tipo de especialización',
            'cod_esp.required'       => 'Es necesario seleccion la especialización',
            'nom_grupo.required'     => 'Es necesario ingresar el nombre del grupo',
            'cod_sede.required'      => 'Seleccione el la sede',
            'descripcion.required'   => 'Es necesario ingresar la descripción',
            'fe_inicio.required'     => 'Es necesario ingresar la fecha de inicio',
            'fe_fin.required'        => 'Es necesario ingresar la fecha de finalizacion',
            'num_min.required'       => 'Es necesario ingresar el número mínimo de alumnos',
            'num_max.required'       => 'Es necesario ingresar el número máximo de alumnos',
            'activo.required'        => 'Es necesario indicar si el grupo estará activo o inactivo',
        ];
    }
}
