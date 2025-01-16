<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_code',
        'site_lang_code',
        'is_main',
        'lang_name',
        'site_name',
    ];
}
