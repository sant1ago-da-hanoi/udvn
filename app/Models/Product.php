<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use function PHPUnit\Framework\isNull;

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
            'image_id'
        );
    }

    public function productTranslations() {
        return $this->hasMany(ProductTranslation::class);
    }

    public function translate($lang = null) {
        if (null == $lang) {
            $lang = app()->getLocale();
        }
        $t = $this->productTranslations()->where('lang', $lang)->first();

        if (isNull($t)) {
            $lang = config('app.fallback_locale');
            $t = $this->productTranslations()->where('lang', $lang)->first();
        }
        return $t;
    }
}
