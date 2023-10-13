<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulancesRepositoryInterface;
use App\Interfaces\Insurances\InsurancesRepositoryInterface;
use App\Interfaces\Categories\CategoriesRepositoryInterface;
use App\Interfaces\Doctors\DoctorsRepositoryInterface;
use App\Interfaces\Patients\PatientsRepositoryInterface;
use App\Interfaces\Services\SingleServicesRepositoryInterface;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Repository\Categories\CategoryRepository;
use App\Repository\Doctors\DoctorRepository;
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

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
