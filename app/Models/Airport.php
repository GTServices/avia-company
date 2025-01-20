<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Airport extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['city_id', 'name'];

    public $translatable = ['name'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
