<?php

namespace App\Providers;

use App\Domain\Repositories\CollectionPointRepository;
use App\Domain\Repositories\CollectionRepository;
use App\Domain\Repositories\IncidenceRepository;
use App\Domain\Repositories\RouteRepository;
use App\Domain\Repositories\TruckRepository;
use App\Domain\Repositories\UserRepository;
use App\Domain\Repositories\ZoneRepository;
use App\Infrastructure\Persistence\Repositories\DbCollectionPointRepository;
use App\Infrastructure\Persistence\Repositories\DbCollectionRepository;
use App\Infrastructure\Persistence\Repositories\DbIncidenceRepository;
use App\Infrastructure\Persistence\Repositories\DbRouteRepository;
use App\Infrastructure\Persistence\Repositories\DbTruckRepository;
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

        $this->app->bind(
            TruckRepository::class,
            DbTruckRepository::class
        );

        $this->app->bind(
            CollectionRepository::class,
            DbCollectionRepository::class
        );

        $this->app->bind(
            CollectionPointRepository::class,
            DbCollectionPointRepository::class
        );

        $this->app->bind(
            IncidenceRepository::class,
            DbIncidenceRepository::class
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
