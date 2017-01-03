<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPoll extends Model
{
    protected $table = 'enrollment_poll';

    protected $fillable = [
        "id_enrollment",
        "poll"
    ];

}
