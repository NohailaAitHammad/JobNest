<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Proposition;
use App\Observers\PropositionObserver;

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
        Proposition::observe(PropositionObserver::class);

        View::composer('layouts.NavBar', function ($view) {
            if (Auth::check()) {
                $notifications = Auth::user()->unreadNotifications;
                $view->with('notifications', $notifications);
            }
        });
    }

}
