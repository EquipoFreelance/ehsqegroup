<?php

namespace App\Http\Controllers\WebService;

use Auth;
use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\EImplementationNoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CalificationController extends Controller
{
    private $einr;

    public function __construct(EImplementationNoteRepository $einr){
        $this->einr = $einr;
    }

    public function index(){

    }

    public function storeCalificationImplementation(Request $request){

        $builder = array();

        $enrollment_ids   = $request->get("id_enrollment_id");     // Id Enrollment

        $note_project     = $request->get("note_project");      // note_project
        $note_project_ids = $request->get("note_project_id");      // note_project_id

        $note_sustent     = $request->get("note_sustent");      // note_sustent
        $note_sustent_ids = $request->get("note_sustent_id");      // note_sustent_id


        if($note_project){
            foreach ($note_project as $key => $value) {

                if($value){

                    // Si el Id Existe
                  if($this->einr->getById($note_project_ids[$key])){

                    $this->einr->update($note_project_ids[$key],
                        array(
                            "num_nota"      => $value,
                            "id_enrollment" => $enrollment_ids[$key],
                            "updated_by"    => Auth::user()->id
                        ));

                  } else {

                     $this->einr->create(
                         array(
                             "num_nota"      => $value,
                             "id_enrollment" => $enrollment_ids[$key],
                             "id_type"       => 1,
                             "active"        => 1,
                             "created_by"    => Auth::user()->id
                         )
                    );

                  }

                }

            }
        }

        if($note_sustent){
            foreach ($note_sustent as $key => $value) {

                if($value){

                    // Si el Id Existe
                    if($this->einr->getById($note_sustent_ids[$key])){

                        $this->einr->update($note_sustent_ids[$key],
                            array(
                                "num_nota"      => $value,
                                "id_enrollment" => $enrollment_ids[$key],
                                "updated_by"    => Auth::user()->id
                            ));

                    } else {

                        $this->einr->create(
                            array(
                                "num_nota"      => $value,
                                "id_enrollment" => $enrollment_ids[$key],
                                "id_type"          => 2,
                                "active"        => 1,
                                "created_by"    => Auth::user()->id
                            )
                        );

                    }

                }

            }
        }


        return response()->json(array("response" => $builder), 200);

    }


}
