<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EImplementationNote extends Model
{
    protected $table = 'enrollment_note_implementation';

    protected $attributes = array(
       'deleted' => 0,
    );

    protected $fillable = [
        'id',
        'id_enrollment',
        'num_nota',
        'active',
        'id_type',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted'
    ];

    //protected $visible = ['nombre', 'id', 'name'];

}
