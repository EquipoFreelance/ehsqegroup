<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Http\Requests;

class ProfileController extends Controller
{

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function edit($id){
    $profile = Profile::find($id);
    $data = compact('profile');
    return view('profile.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateProfileRequest $request, $id)
  {

      if ($request->file('avatar')->isValid())
      {
        $destinationPath = 'assets/images/users/';
        $fileName = $id.'.png';
        $request->file('avatar')->move($destinationPath, $fileName);
      }

      $profile = Profile::find($id);
      $profile->avatar   = $destinationPath.$fileName;
      $profile->fullname = $request->fullname;
      $profile->save();

      //Enviando mensaje
      return redirect()->route('dashboard.profile.edit', $profile->id)
      ->with('message', 'Los datos se actualizaron satisfactoriamente');
  }


}
