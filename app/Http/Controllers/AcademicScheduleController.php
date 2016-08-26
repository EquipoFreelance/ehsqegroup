<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AcademicSchedule;

use App\Http\Requests;

use App\Http\Requests\StoreAcademicScheduleRequest;


class AcademicScheduleController extends Controller
{

    public function index()
    {
        $schedules = AcademicSchedule::orderBy('id', 'desc')->get();
        return view('academic_schedule.index', array('schedules' => $schedules));
    }

    public function create()
    {
        $data = array();
        return view('academic_schedule.create', $data);
    }

    public function store(StoreAcademicScheduleRequest $request)
    {
        AcademicSchedule::create($request->all());
        return redirect()->route('dashboard.academic_schedule.index')
            ->with('message', 'El periodo academico fue registrado satisfactoriamente');
    }

    public function edit($id)
    {
        $schedule = AcademicSchedule::find($id);
        $data = compact('schedule');
        return view('academic_schedule.edit', $data);
    }

    public function update(StoreAcademicScheduleRequest $request, $id)
    {
        $schedule = AcademicSchedule::findOrFail($id);
        $schedule->fill($request->all())->save();
        return redirect()->route('dashboard.academic_schedule.edit', $id)
            ->with('message', 'El periodo academico fue actualizado satisfactoriamente');
    }

    public function show()
    {
        //$persona = Persona::with('persona_student')->find(32);//->persona_telefonos->toJson();
        //return $persona->persona_student()->first()->id;
    }
}
