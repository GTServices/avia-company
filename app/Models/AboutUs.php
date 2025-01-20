<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['content'];

    public $translatable = ['content']; // Tərcümələr üçün istifadə olunur
}
