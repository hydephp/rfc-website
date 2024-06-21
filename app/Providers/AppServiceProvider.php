<?php

namespace App\Providers;

use Hyde\Hyde;
use App\RFCService;
use App\Helpers\SCSS;
use Illuminate\Support\Arr;
use App\CallRFCServiceCommand;
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
            CallRFCServiceCommand::class,
            ClearCommand::class,
        ]);

        // Until/unless https://github.com/laravel/framework/pull/51868 is merged
        Arr::macro('unique', function (array $array): array {
            return array_unique($array);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Hyde::kernel()->booted(fn () => $this->app->make(RFCService::class)->handle());

        Blade::directive('scss', function (string $file, bool $wrapInStyle = false): string {
            $styles = app('scss')->file($file);

            if ($wrapInStyle) {
                return "<style>$styles</style>";
            }

            return "<?php echo $styles ?>";
        });
    }
}
