<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use App\PersonalCargoTipo;
use App\PersonaCargo;
use App\PersonaCorreo;
use Validator;
use Illuminate\Http\Response;
use Carbon\Carbon;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $docentes = Persona::where("deleted", '=', 0)
      ->with(['cargos' => function($query){
          $query->where('cod_personal_cargo_tipo', '=', '1');
      }])
      ->with('correos')
      ->get();

      return view('docente.index', array('docentes' => $docentes));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('docente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $docente = Persona::find($id);
        /*->with(['cargos' => function($query){
            $query->where('cod_personal_cargo_tipo', '=', '1');
        }])*/
        /*->with('cargos')
        ->with('correos')
        ->first();*/

        $data = [
                "docente" => $docente
            ];
        //return response()->json(['message' => $data ]);
        return view('docente.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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
