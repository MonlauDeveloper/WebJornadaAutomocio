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
        $this->app->make('Laravel\Socialite\Contracts\Factory')->extend(
            'microsoft',
            function ($app) {
                $config = $app['config']['services.microsoft'];
                return (new \SocialiteProviders\Microsoft\Provider(
                    $app['request'],
                    $config['client_id'],
                    $config['client_secret'],
                    $config['redirect']
                ))->stateless();
            }
        );
    }
}
