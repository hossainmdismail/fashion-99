<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        // Fetch the first config or create a default one if it doesn't exist
        $data = Config::firstOrNew([], [
            'name'    => 'Default',
            'email'   => 'default@gmail.com',
            'number'  => '01780000000',
            'address' => 'default@gmail.com',
            'url'     => 'synexdigital.com',
            'logo'    => null,
            'fav'     => null,
        ]);

        // Share the $data with all views
        View::share('configData', $data);
    }
}
