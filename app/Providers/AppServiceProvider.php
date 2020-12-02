<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\{TodoService, UserService};
use App\Repositories\TodoRepository;
use App\Contracts\CrudInterface;
use App\Http\Controllers\Api\TodoController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(TodoController::class)
            ->needs(CrudInterface::class)
            ->give(function() {
                return new TodoRepository();
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

        $this->app->singleton('TodoFacade', function() {
            return new TodoService();
        });

        $this->app->singleton('UserFacade', function() {
            return new UserService();
        });
    }
}
