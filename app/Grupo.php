<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
      /**
       * Un Grupo pertenece a una Sede
      */
      public function sede()
      {
          return $this->belongsTo('App\Sede');
      }

}
