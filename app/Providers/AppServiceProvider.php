<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductTag;
use App\Observers\ProductObserver;
use App\Observers\ProductTagObserver;
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
        ProductTag::observe(ProductTagObserver::class);
        Product::observe(ProductObserver::class);
    }
}
