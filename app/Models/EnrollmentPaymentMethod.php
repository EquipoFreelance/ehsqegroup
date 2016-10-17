<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPaymentMethod extends Model
{
    protected $table = 'enrollment_payment_method';

    protected $fillable = [
        'id_payment_method',
        'id_enrollment',
        'amount',
        'observation',
        'created_at',
        'created_by'
    ];
    
}
