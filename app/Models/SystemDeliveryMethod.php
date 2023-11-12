<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemDeliveryMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


}
