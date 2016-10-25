<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentConceptType extends Model
{
    protected $table = 'payment_concept_payment_type';

    public function attr_concept()
    {
        return $this->belongsTo('App\Models\PaymentConcept', 'id_payment_concept', 'id');
    }

}
