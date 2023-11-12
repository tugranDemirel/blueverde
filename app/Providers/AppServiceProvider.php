<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductTag;
use App\Models\SystemCurrency;
use App\Models\SystemDeliveryMethod;
use App\Observers\CurrencyObserver;
use App\Observers\DeliveryObserver;
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
        SystemCurrency::observe(CurrencyObserver::class);
        SystemDeliveryMethod::observe(DeliveryObserver::class);
    }
}
