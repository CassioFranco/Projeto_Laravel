<?php

namespace App\Providers;

use App\Repositories\{SupportEloquentORM};
use App\Repositories\{SupportRepositoryinterface};
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SupportRepositoryinterface::class,
            SupportEloquentORM::class
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
