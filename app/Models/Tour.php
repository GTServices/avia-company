<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Tour extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'desc', 'card_description'];

    /**
     * Get all images for the tour.
     */
    public function images(): HasMany
    {
        return $this->hasMany(TourImage::class)->orderBy('order');
    }

    /**
     * Get the main image (first by order).
     */
    public function getMainImageAttribute()
    {
        return $this->images->first();
    }
}
