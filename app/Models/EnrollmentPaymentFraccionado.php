<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPaymentFraccionado extends Model
{
    protected $table = 'enrollment_payment_fraccionado_detail';

    protected $fillable = [
        'id_enrollment_payment',
        'num_cuota',
        'created_at',
        'created_by'
    ];
}
