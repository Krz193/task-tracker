<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
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
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        View::composer('layouts.app', function ($view) {
            $user = Auth::user();
            $projects = $user ? Project::where('user_id', $user->id)->get() : collect();
            $view->with('projects', $projects);
        });
        
        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->role === UserRole::ADMIN;
        });

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        });
    }
}
