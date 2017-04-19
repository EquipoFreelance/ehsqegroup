<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\AuxiliarRepository;
use App\Repositories\Eloquents\GroupRepository;
use App\Repositories\Eloquents\GroupTeacherRepository;
use App\Repositories\Eloquents\HoraryRepository;
use App\Repositories\Eloquents\ModuleRepository;
use App\Repositories\Eloquents\PersonRepository;
use App\Repositories\Eloquents\TeacherRepository;
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

    public function __construct(
        GroupRepository $rgroup,
        GroupTeacherRepository $rgroup_teacher,
        TeacherRepository $rteacher,
        HoraryRepository $rhorary,
        ModuleRepository $rmodule
    )
    {
        $this->rgroup         = $rgroup;
        $this->rgroup_teacher = $rgroup_teacher;
        $this->rteacher       = $rteacher;
        $this->rhorary        = $rhorary;
        $this->rmodule        = $rmodule;
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
