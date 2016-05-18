<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use App\Http\Requests;

use App\User;

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
        return 'Lista de usuarios';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Registro de usuarios
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User;
        $user->username     = $request->get("username");
        $user->email        = $request->get("email");
        $user->password     = bcrypt($request->get("password"));
        $user->created_at   = Carbon::now();
        $user->id_user_type = $request->get("type_user");
        $user->bloqueado    = 0;
        $user->activo       = 1;

        if($user->save()){
            return response()->json(['message' => "Usuario creado en el sistema"]);
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
        $user = User::find($id);
        $user->username     = $request->get("username");
        $user->email        = $request->get("email");
        $user->password     = bcrypt($request->get("password"));
        $user->updated_at   = Carbon::now();
        $user->bloqueado    = 0;
        $user->activo       = 1;

        if($user->save()){
            return response()->json(['message' => "Usuario actualizado"]);
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
        //
    }
}
