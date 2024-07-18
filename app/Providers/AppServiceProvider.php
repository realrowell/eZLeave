<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // if ($this->app->environment('local')) {
        // }
        $this->app->bind('path.public', function() {
            return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Log::info('User with ID '.auth()->user()->id.' | Username: '.auth()->user()->user_name.' with '.auth()->user()->email.' has login successfully');
        LogViewer::auth(function ($request) {
            return $request->user()
            && in_array($request->user()->role_id, [
                "rol-0001"
            ]);
        });
    }
}
