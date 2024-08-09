<?php

namespace App\Providers;

use App\Services\Commerzbank\AccountService;
use App\Services\Commerzbank\PortfolioService;
use App\Services\Commerzbank\TransactionService;

use Illuminate\Support\ServiceProvider;

class CommerzbankServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->singleton(AccountService::class, fn () => new AccountService(
            config('services.commerzbank.access_token'),
            config('services.commerzbank.uri'),
            config('services.commerzbank.timeout'),
        ));

        $this->app->singleton(PortfolioService::class, fn () => new PortfolioService(
            config('services.commerzbank.access_token'),
            config('services.commerzbank.uri'),
            config('services.commerzbank.timeout'),
        ));
		
        $this->app->singleton(TransactionService::class, fn () => new TransactionService(
            config('services.commerzbank.access_token'),
            config('services.commerzbank.uri'),
            config('services.commerzbank.timeout'),
        ));				
    }
}
