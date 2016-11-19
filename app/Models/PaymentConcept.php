<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentConcept extends Model
{
    protected $table = 'payment_concept';

    // Campos activos
    protected $fillable = [
        'payment_concept_name',
        'active'
    ];
}
