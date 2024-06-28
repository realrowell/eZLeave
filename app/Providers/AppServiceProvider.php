<?php

namespace App\Providers;

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
        LogViewer::auth(function ($request) {
            if(auth()->check()){
                if(auth()->user()->role_id == 'rol-0001'){
                    return true;
                }
                elseif (auth()->user()->role_id == 'rol-0002') {
                    return false;
                }
                elseif (auth()->user()->role_id == 'rol-0003') {
                    return false;
                }
                else {
                    return false;
                }
            }
            else{
                return redirect(route('index'))->with('info','please login first');
            }
        });
    }
}
