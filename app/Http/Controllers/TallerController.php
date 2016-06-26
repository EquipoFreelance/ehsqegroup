<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreTallerRequest;
use Illuminate\Http\Response;

use Validator;
use App\Models\Taller;
use Carbon\Carbon;

class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $talleres = Taller::where("deleted", '=', 0)->get();
      return view('taller.index', array('talleres' => $talleres));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTallerRequest $request)
    {
        Taller::create($request->all());

        //Enviando mensaje
        return redirect()->route('dashboard.taller.index')
        ->with('message', 'Los datos se registraron satisfactoriamente');

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
      $taller = Taller::find($id);
      $data = compact('taller');
      return view('taller.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTallerRequest $request, $id)
    {
        $taller = Taller::find($id);
        $taller->update($request->all());

        //Enviando mensaje
        return redirect()->route('dashboard.taller.index')
        ->with('message', 'Los datos se actualizaron satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taller = Taller::find($id);
        $taller->delete();

        // Ejemplo para restaurar registros
        //$taller = Taller::withTrashed()->find(1);
        //$taller->restore();

        //Enviando mensaje
        return redirect()->route('dashboard.taller.index')
                                ->with('message', 'El taller fue restaurada del sistema');

    }
}
