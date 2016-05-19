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
   * Listado de Tipos de usuarios
   *
   * @return \Illuminate\Http\Response
  */
  public function index() {

      $users_type = UserType::all();//::find(5);//::all();
      return response()->json(['message' => $users_type]);

  }

  /**
   * Registro de tipo de usuarios
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

      /* Aplicando validación al Request */

      // Reglas de validación
      $rules = [
          'nom_user_type' => 'required|alpha',
          'activo'        => 'required|integer|min:0|max:1'
      ];

      // Mensaje Personalizado
      $messages = [
          'nom_user_type.required'  => 'Campo Obligatorio',
          'nom_user_type.alpha'    => 'Solo esta permitido letras',
          'activo.required'         => 'Campo Obligatorio',
          'activo.integer'          => 'Solo esta permitido que sea números enteros',
          'activo.min'              => 'Solo esta permitido valor enteros +',
          'activo.max'              => 'Solo esta permitido valor enteros +'
      ];

      // Enviando los parametros necesarios para la validación
      $validator = Validator::make($request->all(), $rules, $messages);

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails()){

          return response()->json(['message' => $validator->messages()]);

      }else{

          // Registramos al nuevo usuario
          $user_type = new UserType;
          $user_type->nom_user_type  = $request->get("nom_user_type");
          $user_type->activo         = $request->get("activo");
          $user_type->created_at     = Carbon::now();

          if($user_type->save()){

              //Enviando mensaje
              return response()->json(['message' => "Tipo de Usuario creado satisfactoriamente en el sistema"]);

          }

      }

  }

 /**
   * Actualización del tipo de usuario
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id) {

    /* Aplicando validación al Request */

    // Reglas de validación
    $rules = [
        'nom_user_type' => 'required|alpha',
        'activo'        => 'required|integer|min:0|max:1'
    ];

    // Mensaje Personalizado
    $messages = [
        'nom_user_type.required'  => 'Campo Obligatorio',
        'nom_user_type.alpha'     => 'Solo esta permitido letras',
        'activo.required'         => 'Campo Obligatorio',
        'activo.integer'          => 'Solo esta permitido que sea números enteros',
        'activo.min'              => 'Solo esta permitido valor enteros +',
        'activo.max'              => 'Solo esta permitido valor enteros +'
    ];

    // Enviando los parametros necesarios para la validación
    $validator = Validator::make($request->all(), $rules, $messages);

    // Si existen errores el Sistema muestra un mensaje
    if ($validator->fails()){

        return response()->json(['message' => $validator->messages()]);

    }else{

        // Registramos al nuevo usuario
        $user_type = UserType::find($id);
        $user_type->nom_user_type  = $request->get("nom_user_type");
        $user_type->activo         = $request->get("activo");
        $user_type->updated_at     = Carbon::now();

        if($user_type->save()){

            //Enviando mensaje
            return response()->json(['message' => "El registro fue actualizado"]);

        }

    }

  }

  /**
   * Muestra el detalle del tipo de usuario
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function show($id){
    $user_type = UserType::find($id);
    return response()->json(['message' => $user_type]);
  }

  /**
   * Eliminar el tipo de usuario
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $user_type = UserType::find($id);
      $user_type->activo = 0;
      if($user_type->save()){
          return response()->json(['message' => "Eliminado"]);
      }
  }
}
