<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTallerRequest extends Request
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
          'nom_taller' => 'required',
          'activo'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_taller.required' => 'Es obligatorio ingresar el nombre del taller',
            'activo.required'  => 'A message is required',
        ];
    }

}
