<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\TaskService;
use App\Repositories\TaskRepository;
use App\Http\Controllers\Api\TaskController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(TaskController::class)
            ->needs(CrudInterface::class)
            ->give(function() {
                return new TaskRepository();
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultstringLength(191);

        $this->app->singleton('TaskFacade', function() {
            return new TaskService();
        });
    }
}
