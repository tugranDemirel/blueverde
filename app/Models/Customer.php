<?php

namespace App\Models;

use App\Enum\Customer\CustomerCurrentTypeEnum;
use App\Enum\Customer\CustomerIndividualEnum;
use App\Enum\Customer\CustomerPersonalTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'current_type',
        'individual',
        'personal_type',
        'address',
        'country',
        'province',
        'district',
        'post_code',
        'phone',
        'email',
        'authorized_person',
        'tax_authority',
        'identity_number',
        'eori_number',
        'bank_info',
        'description',
        'file',
    ];

    protected $casts = [
        'personal_type' => CustomerPersonalTypeEnum::class,
        'current_type' => CustomerCurrentTypeEnum::class,
        'individual' => CustomerIndividualEnum::class,
        'address' => 'array',
        'authorized_person' => 'array',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
