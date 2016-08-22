<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTeacherRequest extends Request
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
            'nombre'            => 'required',
            'ape_pat'           => 'required',
            'ape_mat'           => 'required',
            'cod_doc_tip'       => 'required',
            'num_doc'           => 'required',
            'correo'            => 'required',
            'cod_pais'          => 'required',
            'cod_dpto'          => 'required',
            'cod_prov'          => 'required',
            'cod_dist'          => 'required',
            'direccion'         => 'required',
            'num_cellphone'     => 'required',
            'num_phone'         => 'required',
            'fe_nacimiento'     => 'required',
            'cod_sexo'          => 'required',
            'activo'            => 'required'
        ];
    }

    public function messages(){
        return [
            'nombre.required'        => 'Es necesario ingresar el nombre',
            'ape_pat.required'       => 'Es necesario ingresar el apellido paterno',
            'ape_mat.required'       => 'Es necesario ingresar el apellido materno',
            'cod_doc_tip.required'   => 'Seleccione el tipo de documento',
            'num_doc.required'       => 'Es necesario ingresar el número de documento',
            'correo.required'        => 'Es necesario ingresar el correo electrónico',
            'cod_pais.required'      => 'Es necesario seleccionar el país',
            'cod_dpto.required'      => 'Es necesario seleccionar el departamento',
            'cod_prov.required'      => 'Es necesario seleccionar la provincia',
            'cod_dist.required'      => 'Es necesario seleccionar el distrito',
            'telefono.required'      => 'Es necesario ingresar un número telefónico',
            'direccion.required'     => 'Es necesario ingresar una dirección',
            'fe_nacimiento.required' => 'Es necesario ingresar una fecha de nacimiento',
            'cod_sexo.required'      => 'Es necesario indicar el género',
            'num_cellphone.required' => 'Es necesario ingresar el teléfono fijo',
            'num_phone.required'     => 'Es necesario ingresar el teléfono celular',
            'activo.required'        => 'Es necesario indicar si el personal estará activo o inactivo'
        ];
    }

}
