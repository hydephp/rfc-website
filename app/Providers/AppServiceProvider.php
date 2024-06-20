<?php

namespace App\Providers;

use Hyde\Hyde;
use App\RFCService;
use App\CallRFCServiceCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\Console\ClearCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RFCService::class);

        $this->commands([
            CallRFCServiceCommand::class,
            ClearCommand::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Hyde::kernel()->booted(fn () => $this->app->make(RFCService::class)->handle());
    }
}
