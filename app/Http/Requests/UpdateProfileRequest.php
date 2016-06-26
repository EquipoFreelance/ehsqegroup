<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
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
        'fullname' => 'required',
        'avatar'   => 'image|mimes:jpeg,jpg,bmp,png|max:1024000'
      ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Es obligatorio ingresar su nombre de usuario',
            'avatar.image'      => 'Es necesario que el archivo image',
            'avatar.mimes'      => 'Solo está permitido las siguientes opciones: jpeg,jpg,bmp,png',
            'avatar.max'        => 'El tamaño maximo es de 1GB'
        ];
    }
}
