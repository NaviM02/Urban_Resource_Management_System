<?php

namespace App\Providers;

use App\Domain\Repositories\UserRepository;
use App\Infrastructure\Persistence\Repositories\DbUserRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
