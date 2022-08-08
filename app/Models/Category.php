<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'image_id',
        'path',
        'description',
    ];


    /**
     * get product of this category
     * @return HasMany
     */
    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }

    public function image(): BelongsTo {
        return $this->belongsTo(Image::class);
    }
}
