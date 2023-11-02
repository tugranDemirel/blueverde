<?php

namespace App\Observers;

use App\Models\ProductTag;
use Illuminate\Support\Str;

class ProductTagObserver
{
    /**
     * Handle the ProductTag "saving" event.
     */
    public function saving(ProductTag $productTag): void
    {
        $productTag->name = strtoupper(turkishToEnglishChars($productTag->name));
        $productTag->slug = Str::slug($productTag->name);
    }
}
