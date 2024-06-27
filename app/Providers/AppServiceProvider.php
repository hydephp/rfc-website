<?php

namespace App\Providers;

use Hyde\Hyde;
use App\RFCService;
use App\Helpers\SCSS;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
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
        $this->app->singleton('scss', fn () => new SCSS());

        $this->commands([
            ClearCommand::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Hyde::kernel()->booted(fn () => $this->app->make(RFCService::class)->handle());

        Blade::directive('scss', function ($expression) {
            return "<style><?php echo app('scss')->file($expression); ?></style>";
        });
    }
}
