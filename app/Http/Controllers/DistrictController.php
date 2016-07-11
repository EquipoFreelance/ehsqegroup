<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\District;

class DistrictController extends Controller
{
  public function index()
  {
    return $district = District::all()->toJson();
  }
}
