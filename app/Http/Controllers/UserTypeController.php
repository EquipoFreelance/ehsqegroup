<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\UserType;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class UserTypeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $users_type = UserType::find(5);//::all();
      return response()->json(['message' => $users_type->users]);
  }


  public function store(Request $request){

      /* Aplicando validación al Request */

      // Reglas de validación
      $rules = [
          'nom_user_type' => 'required|string',
          'activo'        => 'required|integer|min:0'
      ];

      // Mensaje Personalizado
      $messages = [
          'nom_user_type.required'  => 'Campo Obligatorio',
          'nom_user_type.string'    => 'Solo esta permitido strings',
          'activo.required'         => 'Campo Obligatorio',
          'activo.integer'          => 'Solo esta permitido que sea números enteros',
          'activo.min'              => 'Solo esta permitido valor enteros +'
      ];

      // Enviando los parametros necesarios para la validación
      $validator = Validator::make($request->all(), $rules, $messages);

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails()){

          return response()->json(['message' => $validator->messages()]);

      }else{

          // Registramos al nuevo usuario
          $user = new UserType;
          $user->nom_user_type  = $request->get("nom_user_type");
          $user->activo         = $request->get("activo");
          $user->created_at     = Carbon::now();

          if($user->save()){

              //Enviando mensaje
              return response()->json(['message' => "Tipo de Usuario creado satisfactoriamente en el sistema"]);

          }

      }

  }


}
