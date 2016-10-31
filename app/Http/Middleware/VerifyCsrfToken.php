<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/hsqegroup/api/student/payment-method/store',
        '/hsqegroup/api/inscription/billing_client/store',
        '/hsqegroup/api/inscription/concepts/store',
        '/dashboard/creditos/update_pagos/store'
    ];
}
