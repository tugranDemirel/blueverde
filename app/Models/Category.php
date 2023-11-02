<?php

namespace App\Models;

use App\Enum\Category\CategoryTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'description',
        'image',
        'is_active',
        'is_featured',
        'order',
        'type',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'type' => CategoryTypeEnum::class
    ];

}
