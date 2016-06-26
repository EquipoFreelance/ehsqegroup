<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UpdateUserRequest extends Request
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
            'old_password' => 'required|old_password:' . Auth::user()->password
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'     => 'Es necesario ingresar su antigua contraseña',
            'old_password.old_password' => 'La contraseña no coincide'
        ];
    }
}
