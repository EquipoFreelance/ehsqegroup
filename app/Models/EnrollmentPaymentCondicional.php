<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPaymentCondicional extends Model
{
    protected $table = 'student_payment_condicional_detail';

    protected $fillable = [
        'id_payment_method_student',
        'date',
        'num_cuota',
        'created_at',
        'created_by'
    ];
}
