<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $table = 'payment_detail';

    // Campos activos
    protected $fillable = [
        'id_payment',
        'id_concept',
        'price',
        'quantity',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'verified',
        'verified_at',
        'verified_by',
        'active'
    ];


    public function attr_concept()
    {
        return $this->belongsTo('App\Models\PaymentConceptType', 'id_concept', 'id');
    }
    
    
}
