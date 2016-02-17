<?php namespace Rohmadst\Kodegenerator;

use Illuminate\Support\ServiceProvider;

class KodeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/kodegenerator.php' => config_path('kodegenerator.php')]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            'Rohmadst\Kodegenerator\Console\Commands\KodeResource',
        ]);

    }
}
