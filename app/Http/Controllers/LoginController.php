<?php

namespace App\Http\Controllers;

use App\User;

use Validator;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use App\Http\Requests;

use Auth;

class LoginController extends Controller
{
  /**
   * Permite iniciar sesión
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request){

    $user = array("email" => $request->get("email"), "password" => $request->get("password"));

    Auth::attempt($user);

    if(Auth::check()){

      $user_info = Auth::user();

      $url = 'v1/user/'.$user_info['id']; // Preparando la ruta para ser enviado a su Dashboard

      return response()->json(['message' => 'Bienvenido '.$user_info['username'], 'url_redirect' => $url]);

    } else {

      return response()->json(['message' => 'Usuario no encontrado con los parametros enviados']);

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
