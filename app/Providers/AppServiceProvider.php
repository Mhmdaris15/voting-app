<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Vite as FacadesVite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
<<<<<<< HEAD
        Schema::defaultStringLength(191);
=======
        // FacadesVite::macro('image', fn ($asset) => FacadesVite::asset($asset)->withQuery(['type' => 'image']));
>>>>>>> 7dad8a21b9abede1af02f70a2d0f835949d1ec7e
    }
}
