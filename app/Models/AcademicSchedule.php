<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSchedule extends Model
{
    protected $table = 'academic_schedule';

    protected $fillable = [
        'start_date',
        'finish_date',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];
    
}
