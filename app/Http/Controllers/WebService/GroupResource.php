<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Models\Enrollment;
use App\Repositories\Eloquents\AuxiliarRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\GroupRepository;
use App\Repositories\Eloquents\GroupTeacherRepository;
use App\Repositories\Eloquents\HoraryRepository;
use App\Repositories\Eloquents\ModuleRepository;
use App\Repositories\Eloquents\PersonRepository;
use App\Repositories\Eloquents\StudentRepository;
use App\Repositories\Eloquents\TeacherRepository;
use App\Repositories\Eloquents\EImplementationNoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Psy\Exception\ErrorException;

class GroupResource extends Controller
{
    private $rgroup;
    private $rgroup_teacher;
    private $rteacher;
    private $rhorary;
    private $rmodule;
    private $re;
    private $rstudent;
    private $rperson;
    private $rein;

    public function __construct(
        GroupRepository $rgroup,
        GroupTeacherRepository $rgroup_teacher,
        TeacherRepository $rteacher,
        HoraryRepository $rhorary,
        ModuleRepository $rmodule,
        EnrollmentRepository $re,
        StudentRepository $rstudent,
        PersonRepository $rperson,
        EImplementationNoteRepository $rein
    )
    {
        $this->rgroup         = $rgroup;
        $this->rgroup_teacher = $rgroup_teacher;
        $this->rteacher       = $rteacher;
        $this->rhorary        = $rhorary;
        $this->rmodule        = $rmodule;
        $this->re             = $re;
        $this->rstudent       = $rstudent;
        $this->rperson        = $rperson;
        $this->rein           = $rein;
    }

    public function index(Request $request)
    {
        try{

            $response = "";

            $q = $request->get("q");

            if($q == "ALL"){

                $items = $this->rgroup->getAll();

                foreach ($items as $item) {

                    $response[] = array(
                        "id"        => $item->id,
                        "nom_grupo" => $item->nom_grupo
                    );

                }

            }

            return response()->json(["response" => $response], 200);

        } catch(ErrorException $e){

            return response()->json(["response" => "error"], 400);

        }


    }


    public function getGroupTeacher(Request $request){

        $id_group       = $request->get("id_group");
        $group_teachers = $this->rgroup_teacher->getByIdGroup($id_group);

        foreach ($group_teachers as $group_teacher) {

            // Get Mod
            $rs_horary = $this->rhorary->getIdModByIdGroupAndByIdTeacher($id_group, $group_teacher->id_teacher);

            $teacher = $this->rteacher->getById($group_teacher->id_teacher);

            $response[] = array(
                "teacher"  => $teacher->persona,
                "module"   => $this->rmodule->getById($rs_horary->cod_mod)
            );

        }

        return response()->json($response, 200 );

    }

    public function getGroupEnrollment(Request $request){

        $id_group   = $request->get("cod_grupo");
        $type       = $request->get("type");

        $ids_enrollment = [];
        $ids_students   = [];

        $items = $this->rgroup->getById($id_group)->first();

        // Grupo de Identificadores de Matriculados
        if($items->group_enrollment){

            foreach ($items->group_enrollment as $item) {

                $enrollment = $this->re->getById($item->id_enrollment);


                $note_project = $this->rein->getByIdEnrollmentAndIdType($item->id_enrollment, 1);
                $note_sustent = $this->rein->getByIdEnrollmentAndIdType($item->id_enrollment, 2);


                if(fmod($note_project['num_nota'], 1) !== 0.00){

                    // your code if its decimals has a value
                    $note_project['num_nota'] = number_format($note_project['num_nota'], 1, '.', '');
                } else {
                    $note_project['num_nota'] = number_format($note_project['num_nota'], 0, '.', '');
                }

                if(fmod($note_sustent['num_nota'], 1) !== 0.00){

                    // your code if its decimals has a value
                    $note_sustent['num_nota'] = number_format($note_sustent['num_nota'], 1, '.', '');
                } else {
                    $note_sustent['num_nota'] = number_format($note_sustent['num_nota'], 0, '.', '');
                }

                $ids_enrollments[] = array(
                    "id_enrollment" => $enrollment->id,
                    "id_student"    => $enrollment->student->id,
                    "id_person"     => $enrollment->student->persona->id,
                    "report"        => array(
                                            "note_project" => $note_project,
                                            "note_sustent" => $note_sustent
                                        ),
                    "prom"          => ($note_project['num_nota'] * 0.5) + ($note_sustent['num_nota'] * 0.5)
                );

            }
        }

        // Group Ids Enrolments
        foreach ($ids_enrollments as $id_enrollment) {
            $id_p[] = $id_enrollment['id_person'];
        }

        $iperson_order = $this->rperson->getGroupPersonOrdeByLastName($id_p);

        foreach ($iperson_order as $ipo) {

            $report = "";

            // Group Id Person
            foreach ($ids_enrollments as $id_enrollment) {

                if($id_enrollment['id_person'] == $ipo['id']){
                    $report = $id_enrollment;
                    break;
                }

            }

            $response[] = array(
                "id"            => $ipo['id'],
                "ape_pat"       => $ipo['ape_pat'],
                "ape_mat"       => $ipo['ape_mat'],
                "nombre"        => $ipo['nombre'],
                "enrollment"    => $report
            );
        }

        return response()->json(array("response" => $response), 200 );

    }

    public function store( Request $request )
    {

        // Add Person
        $create_person = $this->rpe->create(
            array(
                "num_doc"     => $request->get("num_doc"),
                "cod_doc_tip" => $request->get("cod_doc_tip"),
                "nombre"      => $request->get("nombre"),
                "ape_pat"     => $request->get("ape_pat"),
                "ape_mat"     => $request->get("ape_mat")
            )
        );

        if($create_person){

            $create_auxiliar = $this->rau->create(
                array(
                    "cod_persona" => $create_person->id,
                    "activo"      => "1"
                )
            );

            if($create_auxiliar){

                return response()->json(
                    [
                        "message"  => "El auxiliar se registró satisfactoriamente",
                        "alert"    => "alert-success",
                        "icon"     => "fa-check",
                        "response" => $create_auxiliar,

                    ], 200 );


            }

        }

    }

    public function update(Request $request, $id){

        $update = $this->rpe->update($id,
            array(
            "num_doc"     => $request->get("num_doc"),
            "cod_doc_tip" => $request->get("cod_doc_tip"),
            "nombre"      => $request->get("nombre"),
            "ape_pat"     => $request->get("ape_pat"),
            "ape_mat"     => $request->get("ape_mat")
        ));

        if($update){

            return response()->json(
                [
                    "message"  => "El auxiliar se actualizó satisfactoriamente",
                    "alert"    => "alert-success",
                    "icon"     => "fa-check",
                    "response" => $update,

                ], 200 );

        }

    }

}
