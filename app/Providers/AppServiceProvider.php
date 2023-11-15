<?php

namespace App\Providers;

use App\Models\Entity;
use App\Models\Site;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $entities = Entity::all();
        $users = User::role(['Supplier', 'Client'])->get();
        $tasks = Task::all();
        $sites = Site::all();
        View::share([
            'entities' => $entities,
            'users' => $users,
            'tasks' => $tasks,
            'sites' => $sites
        ]);
    }
}
