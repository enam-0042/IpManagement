<?php

namespace App\Providers;

use App\Repositories\Interfaces\IpListRepositoryInterface;
use App\Repositories\Interfaces\LogHistoryRepositoryInterface;
use App\Repositories\IpListRepository;
use App\Repositories\LogHistoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(IpListRepositoryInterface::class , IpListRepository::class);
        $this->app->bind(LogHistoryRepositoryInterface::class , LogHistoryRepository::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
