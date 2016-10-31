<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentConceptType extends Model
{
    protected $table = 'payment_concept_payment_type';

    // Campos activos
    protected $fillable = [
        'id_payment_concept',
        'id_payment_type',
        'active'
    ];
    

}
