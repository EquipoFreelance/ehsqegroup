<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $table = 'student_payment';

    protected $fillable = [
        'id_student',
        'id_enrollment',
        'id_payment',
        'id_payment_method'
    ];

}
