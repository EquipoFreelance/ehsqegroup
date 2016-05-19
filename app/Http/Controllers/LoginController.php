<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

  /**
   * Permite iniciar sesión
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request){
    /* Aplicando validación al Request */

    /*
      Listado de validaciones por jerarquias aplicada segun la regla de negocio:
      - Validación de errores
      - Validación de correo existente en el Sistema
      - Validacuón de usuario bloqueado
      - Validación de autentificación
    */


    // Reglas de validación
    $rules = [
        'email'    => 'required|email',
        'password' => 'required|min:8',
    ];

    // Mensaje Personalizado
    $messages = [
        'email.required'    => 'Es necesario Ingresar un correo eléctronico',
        'email.email'       => 'Es necesario Ingresar un correo eléctronico válido',
        'password.required' => 'Es necesario Ingresar un password',
        'password.min'      => 'Es necesario Ingresar como mínimo 8 caractéres'
    ];

    // Enviando los parametros necesarios para la validación
    $validator = Validator::make($request->all(), $rules, $messages);

    // Si existen errores el Sistema muestra un mensaje
    if ($validator->fails()){

      return response()->json(['message' => $validator->messages()]);

    // Caso contrario realizamos el proceso de autenficación
    } else {

      // Validación de correos existentes en el Sistema
      $count = User::where('email', '=', $request->get("email"))->count();

      // Existe en la base de datos
      if($count > 0){

        // Validación de usuario no bloqueados
        $verificar = User::where('email', '=', $request->get("email"))->verificarbloqueo()->count();

        if($verificar == 0){

          // Enviando los parametros necesarios para la autenficación
          $user = array(
                        "email"     => $request->get("email"),
                        "password"  => $request->get("password")
                    );
          Auth::attempt($user);

          // Verificando que la autenficación fue correcta
          if(Auth::check()){

            $user_info = Auth::user(); // Obtenido información del usuario logueado

            $url = 'v1/user/'.$user_info['id']; // Preparando la ruta para ser enviado a su Dashboard

            //Enviando mensaje
            return response()->json(['message' => 'Bienvenido '.$user_info['username'], 'url_redirect' => $url]);

          } else {

            //Enviando mensaje
            return response()->json(['message' => 'Usuario no encontrado con los parametros enviados']);

          }

        } else {

          //Enviando mensaje
          return response()->json(['message' => 'Usuario bloqueado']);

        }

      // Caso contrario mostramos mensaje al sistema
      } else {

        //Enviando mensaje
        return response()->json(['message' => 'El correo electrónico no existe en el sistema']);

      }

    }


  }

  /**
   * Permite Cerrar la sesión de un usuario
   *
   * @return false
   */
  public function logout(Request $request){

    Auth::logout();

    $url = 'https://localhost.com';

    return response()->json(['url_redirect' => $url]);

  }
}
