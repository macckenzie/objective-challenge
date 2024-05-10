<?php

namespace App\Providers;

use App\Http\Repositories\BankAccount\AccountRepository;
use App\Http\Repositories\BankAccount\IAccountReposistory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAccountReposistory::class, AccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
