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
        'avatar'   => 'required',
      ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Es obligatorio ingresar su nombre de usuario',
            'avatar.required' => 'Es necesario tener una foto tuya'
        ];
    }
}
