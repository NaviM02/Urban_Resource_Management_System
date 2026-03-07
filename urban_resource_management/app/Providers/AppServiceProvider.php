<?php

namespace App\Providers;

use App\Domain\Repositories\RouteRepository;
use App\Domain\Repositories\UserRepository;
use App\Domain\Repositories\ZoneRepository;
use App\Infrastructure\Persistence\Repositories\DbRouteRepository;
use App\Infrastructure\Persistence\Repositories\DbUserRepository;
use App\Infrastructure\Persistence\Repositories\DbZoneRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepository::class,
            DbUserRepository::class
        );

        $this->app->bind(
            ZoneRepository::class,
            DbZoneRepository::class
        );

        $this->app->bind(
            RouteRepository::class,
            DbRouteRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
