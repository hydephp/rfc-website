<?php

namespace App\Providers;

use App\Helpers\SCSS;
use App\RFCService;
use Hyde\Hyde;
use Illuminate\Cache\Console\ClearCommand;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
