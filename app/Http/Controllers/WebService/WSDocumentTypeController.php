<?php

namespace App\Http\Controllers\WebService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\DocumentType;

class WSDocumentTypeController extends Controller
{
    function getIndex(){

        $rs = DocumentType::where('active', 1)->select('document_type_name as name', 'id');
        $response = response()->json($rs->get()->toJson(), 200);
        return $response;

    }
}
