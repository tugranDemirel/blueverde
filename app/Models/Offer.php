<?php

namespace App\Models;

use App\Enum\Offer\OfferTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'offer_type',
        'customer_id',
        'product_tag_id',
        'products',
        'total',
        'discount',
        'tax',
        'delivery_id',
        'term_of_offer',
        'status',
    ];

    protected $casts = [
        'term_of_offer' => 'array',
        'products' => 'array',
        'offer_type' => OfferTypeEnum::class,
        'status' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->belongsTo(SystemDeliveryMethod::class);
    }

    public function productTag()
    {
        return $this->belongsTo(ProductTag::class);
    }
}
