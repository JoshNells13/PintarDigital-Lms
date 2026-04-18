<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Contracts\Repositories\CourseRepositoryInterface::class,
            \App\Repositories\Eloquent\EloquentCourseRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\UserRepositoryInterface::class,
            \App\Repositories\Eloquent\EloquentUserRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\ProgressRepositoryInterface::class,
            \App\Repositories\Eloquent\EloquentProgressRepository::class
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
