<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentBillingClient extends Model
{
    protected $table = 'enrollment_billing_client';

    protected $fillable = [
        'id_enrollment',
        'razon_social',
        'ruc',
        'phone',
        'address',
        'client_firstname',
        'client_lastname',
        'created_at',
        'created_by'
    ];
}
