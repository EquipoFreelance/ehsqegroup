<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPaymentCondicional extends Model
{
    protected $table = 'enrollment_payment_condicional_detail';

    protected $fillable = [
        'id_enrollment_payment',
        'date',
        'num_cuota',
        'amount',
        'created_at',
        'created_by'
    ];
}
