<?php
namespace App\Providers;

use App\Implementations\AdminImplementation;
use App\Interfaces\AdminInterface;
use App\Implementations\UserImplementation;
use App\Interfaces\UserInterface;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminInterface::class,
            AdminImplementation::class);
        $this->app->bind(UserInterface::class,
            UserImplementation::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
