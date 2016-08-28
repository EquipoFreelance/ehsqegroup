<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AcademicPeriod;

use App\Http\Requests;

use App\Http\Requests\StoreAcademicPeriodRequest;


class AcademicPeriodController extends Controller
{

    public function index()
    {
        $schedules = AcademicPeriod::orderBy('id', 'desc')->get();
        return view('academic_period.index', array('schedules' => $schedules));
    }

    public function create()
    {
        $data = array();
        return view('academic_period.create', $data);
    }

    public function store(StoreAcademicPeriodRequest $request)
    {
        AcademicPeriod::create($request->all());
        return redirect()->route('dashboard.academic_period.index')
            ->with('message', 'El periodo academico fue registrado satisfactoriamente');
    }

    public function edit($id)
    {
        $schedule = AcademicPeriod::find($id);
        $data = compact('schedule');
        return view('academic_period.edit', $data);
    }

    public function update(StoreAcademicPeriodRequest $request, $id)
    {
        $schedule = AcademicPeriod::findOrFail($id);
        $schedule->fill($request->all())->save();
        return redirect()->route('dashboard.academic_period.edit', $id)
            ->with('message', 'El periodo academico fue actualizado satisfactoriamente');
    }

    public function show()
    {
        //$persona = Persona::with('persona_student')->find(32);//->persona_telefonos->toJson();
        //return $persona->persona_student()->first()->id;
    }
}
