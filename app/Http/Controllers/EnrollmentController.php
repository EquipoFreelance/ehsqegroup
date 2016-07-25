<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Enrollment;

class EnrollmentController extends Controller
{

  public function index()
  {
    return view('enrollment.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function edit($id){

      $enrollment = Enrollment::find($id);
      $data = compact('enrollment');
      return view('enrollment.edit', $data);
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


      $enrollment = Enrollment::find($id);
      $enrollment->fecha_inicio   = $request->get("fecha_inicio");
      $enrollment->cod_modalidad  = $request->get("cod_modalidad");
      $enrollment->cod_esp_tipo   = $request->get("cod_esp_tipo");
      $enrollment->cod_esp        = $request->get("cod_esp");
      $enrollment->activo         = ($request->get("activo") == '' || $request->get("activo") == 0)? 0 : $request->get("activo");
      $enrollment->save();

      //Enviando mensaje
      return redirect()->route('dashboard.enrollment.edit', $id)
                              ->with('message', 'La matricula fue actualizada satisfactoriamente');

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function create()
    {

    }
}
