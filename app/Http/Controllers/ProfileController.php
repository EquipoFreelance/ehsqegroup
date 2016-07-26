<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Http\Requests;
use Image;
use File;
//use Session;

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

      $upload = $this->uploadFile($request, 'avatar');

      $profile = Profile::find($id);
      $old_avatar = $profile->avatar;
      $profile->avatar = ($upload != false)? $upload : $profile->avatar;
      $profile->fullname = $request->fullname;

      if($profile->save())
      {
        // Eliminando el archivo anterior

        ($upload != false)? File::delete($old_avatar) : '';

        //Enviando mensaje
        return redirect()->route('dashboard.profile.edit', $profile->id)
        ->with('message', 'Los datos se actualizaron satisfactoriamente');
      }

  }

  /**
  * Realizar la subida de archivo avatar
  *
  * @param  string  $inputFile
  * @return string $$inputFileName
  */
  public function uploadFile($inputFile, $inputFileName)
  {
    if( $inputFile->file($inputFileName) ){

      if ($inputFile->file($inputFileName)->isValid())
      {

        $destinationPath = 'assets/images/users/';
        $fileName = str_random(10).'.png';
        $inputFile->file($inputFileName)->move($destinationPath, $fileName);

        $img = Image::make($destinationPath.$fileName);
        $img->resize(200, 200);
        $img->save();

        return $destinationPath.$fileName;

      } else {

        return false;

      }

    } else {

        return false;

    }

  }


}
