<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Project::class => \App\Policies\ProjectPolicy::class,
        \App\Models\Task::class => \App\Policies\TaskPolicy::class,
        \App\Models\Comment::class => \App\Policies\CommentPolicy::class,
    ];
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
        //
    }
}
