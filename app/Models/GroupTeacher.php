<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTeacher extends Model
{
    protected $table = 'group_teacher';

    protected $fillable = [
        'id_group',
        'id_teacher'
    ];

}
