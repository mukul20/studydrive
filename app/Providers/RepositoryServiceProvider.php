<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\{
    CourseRepositoryInterface,
    RegistrationRepositoryInterface,
    StudentRepositoryInterface,
    UniversityRepositoryInterface,
    UniversityCourseRepositoryInterface,
};
use App\Repositories\{
    CourseRepository,
    RegistrationRepository,
    StudentRepository,
    UniversityRepository,
    UniversityCourseRepository,
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Bind course interface with course repository
        $this->app->bind(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );

        // Bind registration interface with registration repository
        $this->app->bind(
            RegistrationRepositoryInterface::class,
            RegistrationRepository::class
        );

        // Bind student interface with student repository
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class
        );

        // Bind university interface with university repository
        $this->app->bind(
            UniversityRepositoryInterface::class,
            UniversityRepository::class
        );

        // Bind university course interface with university course repository
        $this->app->bind(
            UniversityCourseRepositoryInterface::class,
            UniversityCourseRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
