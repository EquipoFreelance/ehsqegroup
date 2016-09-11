<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicPeriod extends Model
{
    protected $table = 'academic_period';

    protected $fillable = [
        'start_date',
        'finish_date',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];

    protected $visible = ['start_date', 'finish_date', 'id', 'name'];

}
