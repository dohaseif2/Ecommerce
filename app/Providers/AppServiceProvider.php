<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

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
        Broadcast::routes(); 
        View::composer('layouts.navbar', function ($view) {
            $notifications = Notification::with('user')->where('user_id', auth()->id())->get();
            $view->with('notifications', $notifications);
        });
    }
}
