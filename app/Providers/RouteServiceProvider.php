<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot():void
{

    // Sabhi web.php + custom route files ko auto load karna
    $this->mapWebRoutes();
}

protected function mapWebRoutes()
{
    // routes folder ke andar jitni bhi .php files hain, sab load karo
    foreach (glob(base_path('routes/*.php')) as $file) {
        Route::middleware('web')
             ->group($file);
    }

    // Agar sub-folders bhi use karte ho (jaise tut_12, tut_15, etc.)
    foreach (glob(base_path('routes/**/*.php')) as $file) {
        Route::middleware('web')
             ->group($file);
    }
}
}
