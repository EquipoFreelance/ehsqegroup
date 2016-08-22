<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreTeacherRequest;
use App\Models\Persona;
use App\Models\Docente;
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

      $docentes = Docente::where("deleted", '=', 0)->get();
      $data = compact('docentes');
      return view('docente.index', $data);

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
    public function store(StoreTeacherRequest $request)
    {

        // Registramos a la persona
        $persona = new Persona;
        $persona->nombre        = $request->get("nombre");
        $persona->ape_pat       = $request->get("ape_pat");
        $persona->ape_mat       = $request->get("ape_mat");
        $persona->cod_doc_tip   = $request->get("cod_doc_tip");
        $persona->num_doc       = $request->get("num_doc");
        $persona->correo        = $request->get("correo");
        $persona->cod_pais      = $request->get("cod_pais");
        $persona->cod_dpto      = $request->get("cod_dpto");
        $persona->cod_prov      = $request->get("cod_prov");
        $persona->cod_dist      = $request->get("cod_dist");
        $persona->direccion     = $request->get("direccion");
        $persona->num_cellphone = $request->get("num_cellphone");
        $persona->num_phone     = $request->get("num_phone");
        $persona->fe_nacimiento = $request->get("fe_nacimiento");
        $persona->cod_sexo      = $request->get("cod_sexo");
        $persona->activo        = $request->get("activo");
        $persona->created_at    = Carbon::now();

        if($persona->save()){

          $cargos = [new Docente([
              'cod_persona' => $persona->id,
              'activo'      => $request->get("activo")
          ])];

          $persona->docente()->saveMany($cargos);

          //Enviando mensaje
          return redirect()->route('dashboard.docente.index')
          ->with('message', 'Los datos se registraron satisfactoriamente');

        }


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

        $docente = Docente::find($id);
        $data = compact('docente');
        return view('docente.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTeacherRequest $request, $id)
    {

        $docente = Docente::with('Persona')->find($id);

        // Actualizamos información personal del docente
        $docente->persona->fill([
          'nombre'        => $request->get("nombre"),
          'ape_pat'       => $request->get("ape_pat"),
          'ape_mat'       => $request->get("ape_mat"),
          'cod_doc_tip'   => $request->get("cod_doc_tip"),
          'num_doc'       => $request->get("num_doc"),
          'correo'        => $request->get("correo"),
          'cod_pais'      => $request->get("cod_pais"),
          'cod_dpto'      => $request->get("cod_dpto"),
          'cod_prov'      => $request->get("cod_prov"),
          'cod_dist'      => $request->get("cod_dist"),
          'direccion'     => $request->get("direccion"),
          'num_cellphone' => $request->get("num_cellphone"),
          'num_phone'     => $request->get("num_phone"),
          'fe_nacimiento' => $request->get("fe_nacimiento"),
          'cod_sexo'      => $request->get("cod_sexo"),
          'updated_at'    => Carbon::now()
        ]);

        if( $docente->push() ){

          return redirect()->route('dashboard.docente.index')
          ->with('message', 'Los datos se actualizaron satisfactoriamente');

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
