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

    protected $visible = [
        'id_group',
        'id_teacher',
        'group'
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Grupo', 'id_group', 'id');
    }

}
