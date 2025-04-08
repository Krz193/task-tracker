<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('layouts.app', function ($view) {
            $user = Auth::user();
            $projects = $user ? Project::where('user_id', $user->id)->get() : collect();
            $view->with('projects', $projects);
        });
    }
}
