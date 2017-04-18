<?php

namespace App\Providers;

use App\Repositories\Contracts\InterfaceRepository;
use App\Repositories\Eloquents\AcademicPeriodRepository;
use App\Repositories\Eloquents\EbcRepository;
use App\Repositories\Eloquents\EnrollmentBillingClientRepository;
use App\Repositories\Eloquents\EnrollmentPaymentConceptRepository;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EnrollmentPollRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EpmFraccionadoOtrosRepository;
use App\Repositories\Eloquents\EpmFraccionadoRepository;
use App\Repositories\Eloquents\EpmTotalRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\EspecializationTypeRepository;
use App\Repositories\Eloquents\ModalityRepository;
use App\Repositories\Eloquents\PaymentConceptRepository;
use App\Repositories\Eloquents\PaymentConceptTypeRepository;
use App\Repositories\Eloquents\PaymentDetailRepository;
use App\Repositories\Eloquents\PaymentRepository;
use App\Repositories\Eloquents\AuxiliarRepository;
use App\Repositories\Eloquents\StudentRepository;
use App\Repositories\Eloquents\UserRepository;
use Illuminate\Support\ServiceProvider;
use Validator;
use Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

      Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
        return Hash::check($value, current($parameters));
      });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            InterfaceRepository::class,
            UserRepository::class,
            PaymentConceptRepository::class,
            PaymentConceptTypeRepository::class,
            PaymentDetailRepository::class,
            PaymentRepository::class,
            EnrollmentPaymentConceptRepository::class,
            EnrollmentRepository::class,
            EnrollmentPMRepository::class,
            EpmTotalRepository::class,
            EpmFraccionadoRepository::class,
            EpmFraccionadoOtrosRepository::class,
            EbcRepository::class,
            EspecializationRepository::class,
            EspecializationTypeRepository::class,
            ModalityRepository::class,
            AcademicPeriodRepository::class,
            EpmConceptRepository::class,
            EnrollmentPollRepository::class,
            AuxiliarRepository::class,
            StudentRepository::class,
            EnrollmentBillingClientRepository::class,
            CalificationRepository::class,
            GroupRepository::class
        );
    }
}
