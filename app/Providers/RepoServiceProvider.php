<?php

namespace App\Providers;

use App\Repository\FeesRepository;
use App\Repository\FeesRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(
        //     'App\Repository\TeacherRepository',
        //     'App\Repository\TeacherRepositoryInterface',
        // );
        $this->app->bind(TeacherRepositoryInterface::class , TeacherRepository::class );
        $this->app->bind(FeesRepositoryInterface::class , FeesRepository::class);
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
