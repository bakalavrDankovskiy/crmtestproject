<?php

namespace App\Providers;

use AmoCRM\Client\AmoCRMApiClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AmoCRMApiClient::class, function () {
            return (new AmoCRMApiClient(
                config('services.amocrm.client_id'),
                config('services.amocrm.secret_key'),
                'http://localhost.com/leads/import/save',
            ))->setAccountBaseDomain(config('services.amocrm.sub_domain'));
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
