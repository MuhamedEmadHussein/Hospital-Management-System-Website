<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulancesRepositoryInterface;
use App\Interfaces\Insurances\InsurancesRepositoryInterface;
use App\Interfaces\Categories\CategoriesRepositoryInterface;
use App\Interfaces\doctor_dashboard\DiagnosticRepositoryInterface;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Interfaces\doctor_dashboard\RaysRepositoryInterface;
use App\Interfaces\Doctors\DoctorsRepositoryInterface;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Interfaces\Patients\PatientsRepositoryInterface;
use App\Interfaces\Services\SingleServicesRepositoryInterface;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Repository\Categories\CategoryRepository;
use App\Repository\doctor_dashboard\DiagnosticRepository;
use App\Repository\doctor_dashboard\InvoicesRepository;
use App\Repository\doctor_dashboard\RaysRepository;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Finance\PaymentRepository;
use App\Repository\Finance\ReceiptRepository;
use App\Repository\Services\SingleServiceRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Insurances\InsuranceRepository;
use App\Repository\Patients\PatientRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CategoriesRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(DoctorsRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(SingleServicesRepositoryInterface::class, SingleServiceRepository::class);
        $this->app->bind(InsurancesRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(AmbulancesRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientsRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(InvoicesRepositoryInterface::class, InvoicesRepository::class);
        $this->app->bind(DiagnosticRepositoryInterface::class, DiagnosticRepository::class);
        $this->app->bind(RaysRepositoryInterface::class, RaysRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
