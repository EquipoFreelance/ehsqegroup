<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPaymentConcept extends Model
{
    protected $table = 'enrollment_payment_concept';

    protected $fillable = [
        "amount",
        "id_enrollment",
        "id_concept_payment_type",
        "active"
    ];
    
}
