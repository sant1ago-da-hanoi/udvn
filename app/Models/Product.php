<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'quantity',
        'price',
        'description',
    ];


    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function images(): BelongsToMany {
        return $this->belongsToMany(
            Image::class,
            'product_images',
            'product_id',
            'image_id');
    }
}
