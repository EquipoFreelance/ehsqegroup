<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreEnrollmentRequest extends Request
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
            'id_academic_period' => 'required',
            'cod_modalidad'      => 'required',
            'cod_esp_tipo'       => 'required',
            'cod_esp'            => 'required',
            'activo'             => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_academic_period.required'   => 'Seleccione el Periódo Académico',
            'cod_modalidad.required'        => 'Es necesario seleccionar la modalidad ',
            'cod_esp_tipo.required'         => 'Es necesario seleccionar el tipo de especialización',
            'cod_esp.required'              => 'Es necesario seleccionar la especialización',
            'activo.required'               => 'Es necesario este campo',
        ];
    }
}
