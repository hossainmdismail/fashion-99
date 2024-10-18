<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        if (!Schema::hasTable('configs')) {
            return;
        }
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

        View::share('configData', $data);
    }
}
