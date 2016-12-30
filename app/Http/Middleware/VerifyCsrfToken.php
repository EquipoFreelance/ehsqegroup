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
        '/hsqegroup/services/inscription/store/payment-method',
        '/hsqegroup/services/inscription/store/billing-client',
        '/hsqegroup/api/inscription/concepts/store',
        '/dashboard/creditos/update_pagos/store',
        '/hsqegroup/services/validate-payment/store',
        '/api/*',
    ];
}
