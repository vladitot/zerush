<?php

namespace App\Providers;

use App\Services\AdviceService;
use App\Services\AdviceServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(AdviceServiceInterface::class, AdviceService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
