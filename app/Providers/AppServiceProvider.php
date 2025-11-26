<?php

namespace App\Providers;

use App\Policies\NotificationPolicy;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'flash' => function () {
                return [
                    'success' => session('success'),
                    'error' => session('error')
                ];
            },
        ]);
        Gate::policy(DatabaseNotification::class, NotificationPolicy::class);
    }
    
}
