<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();//User::where('activo', '=', '1');

        $users = User::find(8)->with('usertype')->get();

        //$users = User::with('usertype')->get();
        //$users->load('nom_user_type');

        return response()->json(['message' => $users ]);

        //return response()->json(['message' => $users->user['nom_user_type'] ]);

        //return response()->json(['message' => $users->user->nom_user_type ]);

        /*foreach (User::all() as $user)
        {
            echo $user->email."-".$user->usertype->nom_user_type."<br>";

        }*/

    }

    /**
     * Permite activar usuarios
     *
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, $id) { // Request $request,
        $user = User::find($id);
        $user->activo = $request->get('activo');
        if($user->save()){
            return response()->json(['message' => "Cambio realizado"]);
        }
    }

    /**
     * Permite bloquear usuarios
     *
     * @return \Illuminate\Http\Response
     */
    public function toblock(Request $request, $id) {
        $user = User::find($id);
        $user->bloqueado = $request->get("bloqueado");
        if($user->save()){
            return response()->json(['message' => "Cambio realizado"]);
        }
    }

    /**
     * Registro de usuarios
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* Aplicando validación al Request */

        // Reglas de validación
        $rules = [
            'username'      => 'required|alpha_num',
            'email'         => 'required|email',
            'password'      => 'required|min:8|alpha_num',
            'id_user_type'  => 'required|integer|min:0',
            'bloqueado'     => 'required|integer|min:0',
            'activo'        => 'required|integer|min:0'
        ];

        // Mensaje Personalizado
        $messages = [
            'username.required'     => 'Es necesario ingresar un nombre de usuario',
            'username.alpha_num'    => 'Se necesita que el nombre de usuario sea solo sean alfanumericos',
            'email.required'        => 'Es necesario Ingresar un correo eléctronico',
            'email.email'           => 'Es necesario Ingresar un correo eléctronico válido',
            'password.required'     => 'Es necesario Ingresar un password',
            'password.min'          => 'Es necesario Ingresar como mínimo 8 caractéres',
            'password.alpha_num'    => 'Es necesario Ingresar un password alfanuméricos',
            'id_user_type.required' => 'Es necesario indicar el tipo de usuario',
            'id_user_type.integer'  => 'Solo esta permitido que sea números enteros',
            'id_user_type.min'      => 'Solo esta permitido valor enteros +',
            'bloqueado.required'    => 'Es necesario indicar si la cuenta será bloqueda o no',
            'bloqueado.integer'     => 'Soo esta permitido que sea números enteros',
            'bloqueado.min'         => 'Solo esta permitido valor enteros +',
            'activo.required'       => 'Es necesario indicar si la cuenta será activa o no',
            'activo.integer'        => 'Solo esta permitido que sea números enteros',
            'activo.min'            => 'Solo esta permitido valor enteros +'
        ];

        // Enviando los parametros necesarios para la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si existen errores el Sistema muestra un mensaje
        if ($validator->fails()){

            return response()->json(['message' => $validator->messages()]);

        }else{

          // Validación de correos existentes en el Sistema
          $count = User::where('email', '=', $request->get("email"))->count();

          // No existe en la base de datos
          if($count == 0){

            // Registramos al nuevo usuario
            $user = new User;
            $user->username     = $request->get("username");
            $user->email        = $request->get("email");
            $user->password     = bcrypt($request->get("password"));
            $user->id_user_type = $request->get("id_user_type");
            $user->bloqueado    = $request->get("bloqueado");
            $user->activo       = $request->get("activo");
            $user->created_at   = Carbon::now();

            if($user->save()){

                //Enviando mensaje
                return response()->json(['message' => "Usuario creado satisfactoriamente en el sistema"]);

            }

          } else {

            //Enviando mensaje
            return response()->json(['message' => 'El correo electrónico existe en el sistema']);

          }

        }

    }

    /**
     * Detalle de la cuenta de usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['message' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Actualiza la información del Usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        /* Aplicando validación al Request */

        // Reglas de validación
        $rules = [
            'username'      => 'required|alpha_num',
            'email'         => 'required|email',
            'password'      => 'required|min:8|alpha_num',
            'id_user_type'  => 'required|integer|min:0',
            'bloqueado'     => 'required|integer|min:0',
            'activo'        => 'required|integer|min:0'
        ];

        // Mensaje Personalizado
        $messages = [
            'username.required'     => 'Es necesario ingresar un nombre de usuario',
            'username.alpha_num'    => 'Se necesita que el nombre de usuario sea solo sean alfanumericos',
            'email.required'        => 'Es necesario Ingresar un correo eléctronico',
            'email.email'           => 'Es necesario Ingresar un correo eléctronico válido',
            'password.required'     => 'Es necesario Ingresar un password',
            'password.min'          => 'Es necesario Ingresar como mínimo 8 caractéres',
            'password.alpha_num'    => 'Es necesario Ingresar un password alfanuméricos',
            'id_user_type.required' => 'Es necesario indicar el tipo de usuario',
            'id_user_type.integer'  => 'Solo esta permitido que sea números enteros',
            'id_user_type.min'      => 'Solo esta permitido valor enteros +',
            'bloqueado.required'    => 'Es necesario indicar si la cuenta será bloqueda o no',
            'bloqueado.integer'     => 'Soo esta permitido que sea números enteros',
            'bloqueado.min'         => 'Solo esta permitido valor enteros +',
            'activo.required'       => 'Es necesario indicar si la cuenta será activa o no',
            'activo.integer'        => 'Solo esta permitido que sea números enteros',
            'activo.min'            => 'Solo esta permitido valor enteros +'
        ];

        // Enviando los parametros necesarios para la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si existen errores el Sistema muestra un mensaje
        if ($validator->fails()){

            return response()->json(['message' => $validator->messages()]);

        }else{

          // Validación de correos existentes en el Sistema
          $count = User::where('email', '=', $request->get("email"))->count();

          // No existe en la base de datos
          if($count == 0){

            $user = User::find($id);
            $user->username     = $request->get("username");
            $user->email        = $request->get("email");
            $user->password     = bcrypt($request->get("password"));
            $user->id_user_type = $request->get("id_user_type");
            $user->bloqueado    = $request->get("bloqueado");
            $user->activo       = $request->get("activo");
            $user->updated_at   = Carbon::now();

            if($user->save()){
                return response()->json(['message' => "Usuario actualizado satisfactoriamente"]);
            }

          } else {

            //Enviando mensaje
            return response()->json(['message' => 'El correo electrónico existe en el sistema']);

          }



        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->activo       = 0;
        if($user->save()){
            return response()->json(['message' => "Usuario actualizado satisfactoriamente"]);
        }
    }
}
