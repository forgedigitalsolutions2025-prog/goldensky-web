<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register view paths
        $this->loadViewsFrom(resource_path('views'), 'app');
        
        // Register spa views namespace
        $spaViewsPath = base_path('sharadha wellness/resources/views');
        if (file_exists($spaViewsPath)) {
            $this->loadViewsFrom($spaViewsPath, 'spa');
        }
    }
}
