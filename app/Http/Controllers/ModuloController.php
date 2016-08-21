<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Especializacion;
use App\Models\Taller;
use App\Http\Requests;
use App\Http\Requests\StoreModuloRequest;
use Validator;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Str as Str;
use AppHelper;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $modulos = Modulo::where("deleted", '=', 0)->orderBy('id', 'desc')->get();
      return view('modulo.index', array('modulos' => $modulos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
                'especializacion' => Especializacion::lists('nom_esp', 'id'),
                'talleres'        => Taller::lists('nom_taller','id')
                ];
        return view('modulo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModuloRequest $request)
    {

        // Registramos el nuevo módulo
        $obj                = new Modulo;
        $obj->cod_modalidad = $request->get("cod_modalidad");
        $obj->cod_esp_tipo  = $request->get("cod_esp_tipo");
        $obj->cod_esp       = $request->get("cod_esp");
        $obj->nombre        = $request->get("nombre");
        $obj->nom_corto     = AppHelper::strNomCorto( Str::slug($request->get("nom_corto"), '_') );
        $obj->descripcion   = $request->get("descripcion");
        $obj->activo        = $request->get("activo");
        $obj->num_taller    = $request->get("num_taller");
        $obj->created_at    = Carbon::now();

        if($obj->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.modulo.index')->with('message', 'El módulo se ha creado satisfactoriamente');

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
      $modulo = Modulo::find($id);
      $data = [
              "modulo"          => $modulo,
              "especializacion" => Especializacion::lists('nom_esp', 'id'),
              "talleres"        => Taller::lists('nom_taller','id')
          ];
      return view('modulo.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreModuloRequest $request, $id)
    {

        // Actualizando el módulo seleccionado
        $obj                = Modulo::find($id);
        $obj->cod_modalidad = $request->get("cod_modalidad");
        $obj->cod_esp_tipo  = $request->get("cod_esp_tipo");
        $obj->cod_esp       = $request->get("cod_esp");
        $obj->nombre        = $request->get("nombre");
        $obj->nom_corto     = AppHelper::strNomCorto( Str::slug($request->get("nom_corto"), '_') );
        $obj->descripcion   = $request->get("descripcion");
        $obj->activo        = $request->get("activo");
        $obj->num_taller    = $request->get("num_taller");
        $obj->created_at    = Carbon::now();

        if($obj->save()){

            //Enviando mensaje
            return redirect()->route('dashboard.modulo.index')->with('message', 'El módulo se ha actualizado satisfactoriamente');

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
      $obj             = Modulo::find($id);
      $obj->deleted    = 1;
      $obj->deleted_at = Carbon::now();

      if($obj->save()){

          //Enviando mensaje
          return redirect()->route('dashboard.modulo.index')
                                  ->with('message', 'El Módulo fue eliminado del sistema');

      }
    }


}
