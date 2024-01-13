<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_tag_id',
        'name',
        'slug',
        'code',
        'description',
        'price',
        'system_currency_id',
        'image',
        'meta_keywords',
        'meta_description',
        'type',
        'product_size',
        'material',
        'color',
        'detail',
    ];

    protected $casts = [
        'type' => 'array'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productTag() : BelongsTo
    {
        return $this->belongsTo(ProductTag::class);
    }

    public function medias() : HasMany
    {
        return $this->hasMany(MediaProducts::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(SystemCurrency::class);
    }

}
