<?php

namespace Arpitech\SanctumServiceToken\Providers;

use Illuminate\Support\ServiceProvider;

class SanctumServiceTokenServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Arpitech\SanctumServiceToken\Console\GenerateServiceTokenCommand::class,
            ]);
        }
        
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'service-token-migrations');
    }
}
