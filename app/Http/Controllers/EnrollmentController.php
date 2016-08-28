<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Modulo;

use App\Models\Enrollment;

use App\Models\ReportCard;


class EnrollmentController extends Controller
{

  public function index()
  {
    return view('enrollment.index');
  }

  public function store(Request $request)
  {

      $enrollment = new Enrollment();
      $enrollment->cod_alumno         = $request->get("cod_alumno");
      $enrollment->id_academic_period = $request->get("id_academic_period");
      $enrollment->cod_modalidad      = $request->get("cod_modalidad");
      $enrollment->cod_esp_tipo       = $request->get("cod_esp_tipo");
      $enrollment->cod_esp            = $request->get("cod_esp");
      $enrollment->activo             = ($request->get("activo") == '' || $request->get("activo") == 0)? 0 : $request->get("activo");

      if( $enrollment->save() )
      {

        // Create Report Cards
        $this->setCreateReportCard($enrollment->cod_modalidad, $enrollment->cod_esp_tipo, $enrollment->cod_esp, $enrollment->id);

        // Sending Message
        return redirect()->route('dashboard.enrollment.edit', $enrollment->id)
                                ->with('message', 'La matricula fue registrada satisfactoriamente');

      }

  }

      public function create()
      {
        return view('enrollment.create');
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
      $enrollment->id_academic_period = $request->get("id_academic_period");
      $enrollment->cod_modalidad      = $request->get("cod_modalidad");
      $enrollment->cod_esp_tipo       = $request->get("cod_esp_tipo");
      $enrollment->cod_esp            = $request->get("cod_esp");
      $enrollment->activo             = ($request->get("activo") == '' || $request->get("activo") == 0)? 0 : $request->get("activo");

      if( $enrollment->save() )
      {
          // Deleted Old Register
          $enrollment->report_card()->delete();

          // Create new Report Cards
          $this->setCreateReportCard($enrollment->cod_modalidad, $enrollment->cod_esp_tipo, $enrollment->cod_esp, $enrollment->id);

          // Sending Message
          return redirect()->route('dashboard.enrollment.edit', $id)
                                ->with('message', 'La matricula fue actualizada satisfactoriamente');
      }

    }


    /*public function show($id)
    {

    }*/

    /**
     * Crea las notas por matricula
     *
     * @param string $cod_modalidad
     * @param string $cod_esp_tipo
     * @param string $cod_esp
     * @return string $response
     */
    public function setCreateReportCard( $cod_modalidad, $cod_esp_tipo, $cod_esp, $cod_matricula ){

        $response = ''; $rs = ''; $count_modulos = '';

        $rs = Modulo::where('cod_modalidad', $cod_modalidad)->
                      where('cod_esp_tipo', $cod_esp_tipo)->
                      where('cod_esp', $cod_esp);

        $count_modulos = $rs->count();

        if($count_modulos > 0){

            $modulo = $rs->get();

            foreach ($modulo as $item => $i) {

                for ($x = 1; $x <= $i->num_taller; $x++) {

                    $report_card                = new ReportCard();
                    $report_card->cod_matricula = $cod_matricula;
                    $report_card->cod_modulo    = $i->id;
                    $report_card->cod_taller    = $x;
                    $report_card->num_nota      = 0;
                    $report_card->save();

                }

            }


        } else {

            $response = false;

        }

        return $response;
    }


}
