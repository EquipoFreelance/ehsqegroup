<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InscriptionStoreRequest extends Request
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
        'nombre'         => 'required',
        'ape_pat'        => 'required',
        'ape_mat'        => 'required',
        'cod_doc_tip'    => 'required',
        'num_doc'        => 'required',
        'correo'         => 'required',
        'direccion'      => 'required',
        'fe_nacimiento'  => 'required',
        'cod_sexo'       => 'required',
        'num_tel_fijo'   => 'required',
        'num_tel_mobile' => 'required'
      ];
    }

    public function messages()
    {
        return [
            'nombre.required'         => 'Es necesario ingresar el nombre',
            'ape_pat.required'        => 'Es necesario ingresar el apellido paterno',
            'ape_mat.required'        => 'Es necesario ingresar el apellido materno',
            'cod_doc_tip.required'    => 'Es necesario seleccionar el tipo de documento',
            'num_doc.required'        => 'Es necesario ingresar el número de DNI',
            'correo.required'         => 'Es necesario ingresar el correo electrónico',
            'direccion.required'      => 'Es necesario ingresar la dirección',
            'fe_nacimiento.required'  => 'Es necesario ingresar la fecha de nacimiento',
            'cod_sexo.required'       => 'Es necesario ingresar el sexo',
            'num_tel_fijo.required'   => 'Es necesario ingresar el teléfono fijo',
            'num_tel_mobile.required' => 'Es necesario ingresar el teléfono celular',
        ];
    }
}
